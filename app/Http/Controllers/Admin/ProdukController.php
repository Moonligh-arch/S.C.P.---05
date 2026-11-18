<?php

namespace App\Http\Controllers\Admin;

use App\Enums\KategoriProduk;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Merek;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $produk = Produk::with('merek')
            ->withCount('varian')
            ->when($cari, fn ($q) => $q->where('nama', 'like', "%{$cari}%"))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.katalog.produk.index', compact('produk', 'cari'));
    }

    public function create()
    {
        $merek = Merek::orderBy('nama')->get();
        $kategoriList = KategoriProduk::cases();

        return view('admin.katalog.produk.create', compact('merek', 'kategoriList'));
    }

    public function store(ProdukRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')
            ->with('sukses', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load(['merek', 'varian']);

        return view('admin.katalog.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $merek = Merek::orderBy('nama')->get();
        $kategoriList = KategoriProduk::cases();

        return view('admin.katalog.produk.edit', compact('produk', 'merek', 'kategoriList'));
    }

    public function update(ProdukRequest $request, Produk $produk)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $produk->hapusGambar();
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('sukses', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('sukses', 'Produk berhasil dihapus.');
    }
}
