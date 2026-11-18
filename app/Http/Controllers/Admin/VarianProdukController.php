<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VarianProdukRequest;
use App\Models\Produk;
use App\Models\VarianProduk;

class VarianProdukController extends Controller
{
    public function index(Produk $produk)
    {
        $varian = $produk->varian()->orderBy('harga')->paginate(10);

        return view('admin.katalog.varian.index', compact('produk', 'varian'));
    }

    public function create(Produk $produk)
    {
        return view('admin.katalog.varian.create', compact('produk'));
    }

    public function store(VarianProdukRequest $request, Produk $produk)
    {
        $produk->varian()->create($request->validated());

        return redirect()->route('admin.produk.varian.index', $produk)
            ->with('sukses', 'Varian berhasil ditambahkan.');
    }

    public function edit(VarianProduk $varian)
    {
        $varian->load('produk');

        return view('admin.katalog.varian.edit', compact('varian'));
    }

    public function update(VarianProdukRequest $request, VarianProduk $varian)
    {
        $varian->update($request->validated());

        return redirect()->route('admin.produk.varian.index', $varian->produk_id)
            ->with('sukses', 'Varian berhasil diperbarui.');
    }

    public function destroy(VarianProduk $varian)
    {
        if (!$varian->bisaDihapus()) {
            return back()->with('gagal', 'Varian tidak bisa dihapus karena sudah pernah dipesan.');
        }

        $produkId = $varian->produk_id;
        $varian->delete();

        return redirect()->route('admin.produk.varian.index', $produkId)
            ->with('sukses', 'Varian berhasil dihapus.');
    }
}
