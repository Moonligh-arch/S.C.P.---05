<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerekRequest;
use App\Models\Merek;
use Illuminate\Http\Request;

class MerekController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $merek = Merek::when($cari, fn ($q) => $q->where('nama', 'like', "%{$cari}%"))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.katalog.merek.index', compact('merek', 'cari'));
    }

    public function create()
    {
        return view('admin.katalog.merek.create');
    }

    public function store(MerekRequest $request)
    {
        Merek::create($request->validated());

        return redirect()->route('admin.merek.index')
            ->with('sukses', 'Merek berhasil ditambahkan.');
    }

    public function edit(Merek $merek)
    {
        return view('admin.katalog.merek.edit', compact('merek'));
    }

    public function update(MerekRequest $request, Merek $merek)
    {
        $merek->update($request->validated());

        return redirect()->route('admin.merek.index')
            ->with('sukses', 'Merek berhasil diperbarui.');
    }

    public function destroy(Merek $merek)
    {
        if (!$merek->bisaDihapus()) {
            return back()->with('gagal', "Merek \"{$merek->nama}\" tidak bisa dihapus karena masih dipakai oleh produk.");
        }

        $merek->delete();

        return redirect()->route('admin.merek.index')
            ->with('sukses', 'Merek berhasil dihapus.');
    }
}
