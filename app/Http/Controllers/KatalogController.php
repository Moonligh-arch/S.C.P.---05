<?php

namespace App\Http\Controllers;

use App\Enums\KategoriProduk;
use App\Models\Merek;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Halaman katalog publik: grid produk dengan pencarian, filter merek & kategori, dan pagination.
     */
    public function index(Request $request)
    {
        $cari = $request->query('cari');
        $merekId = $request->query('merek');
        $kategori = $request->query('kategori');

        // Validasi input kategori dengan enum jika ada
        $validKategori = $kategori ? KategoriProduk::tryFrom($kategori) : null;

        $produk = Produk::with('merek')
            ->withMin('varian', 'harga')
            ->when($cari, function ($query, $cari) {
                $query->where('nama', 'like', "%{$cari}%");
            })
            ->when($merekId, function ($query, $merekId) {
                $query->where('merek_id', $merekId);
            })
            ->when($validKategori, function ($query, $validKategori) {
                $query->where('kategori', $validKategori->value);
            })
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $merekList = Merek::orderBy('nama')->get();
        $kategoriList = KategoriProduk::cases();

        return view('katalog.index', compact(
            'produk',
            'merekList',
            'kategoriList',
            'cari',
            'merekId',
            'kategori'
        ));
    }

    /**
     * Halaman detail produk publik: gambar, deskripsi, spesifikasi, dan daftar varian.
     */
    public function show(Produk $produk)
    {
        $produk->load([
            'merek',
            'varian' => fn ($q) => $q->orderBy('harga'),
        ]);

        return view('katalog.show', compact('produk'));
    }
}
