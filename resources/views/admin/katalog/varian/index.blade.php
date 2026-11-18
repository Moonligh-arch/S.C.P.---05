@extends('layouts.app')
@section('title', 'Kelola Varian - ' . $produk->nama)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1"><i class="bi bi-collection"></i> Kelola Varian: {{ $produk->nama }}</h4>
        <small class="text-muted">Merek: {{ $produk->merek->nama }} | Kategori: {{ $produk->kategori->label() }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.produk.varian.create', $produk) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Varian
        </a>
        <a href="{{ route('admin.produk.show', $produk) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Produk
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>RAM</th>
                        <th>Penyimpanan</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center" style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($varian as $i => $v)
                        <tr>
                            <td>{{ $varian->firstItem() + $i }}</td>
                            <td>{{ $v->ram }}</td>
                            <td>{{ $v->penyimpanan }}</td>
                            <td>{{ $v->warna }}</td>
                            <td class="fw-semibold text-primary">{{ formatRupiah($v->harga) }}</td>
                            <td>
                                <span class="badge bg-{{ $v->badge_stok }}">
                                    {{ $v->label_stok }} ({{ $v->stok }})
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.varian.edit', $v) }}" class="btn btn-warning btn-sm" title="Ubah Varian">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.varian.destroy', $v) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus varian {{ $v->label }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada varian untuk produk ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $varian->links() }}
</div>
@endsection
