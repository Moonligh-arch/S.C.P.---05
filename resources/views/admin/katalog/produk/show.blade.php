@extends('layouts.app')
@section('title', 'Detail Produk (Admin)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-eye"></i> Detail Produk: {{ $produk->nama }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i> Ubah Produk
        </a>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama }}" class="card-img-top p-3 rounded" style="max-height:350px;object-fit:contain;">
            <div class="card-body border-top">
                <span class="badge bg-secondary mb-2">{{ $produk->kategori->label() }}</span>
                <h5 class="card-title fw-bold">{{ $produk->nama }}</h5>
                <p class="text-muted mb-1">Merek: <strong>{{ $produk->merek->nama }}</strong></p>
                <p class="text-muted mb-0">Total Stok: <strong>{{ $produk->total_stok }} unit</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-card-text text-primary"></i> Deskripsi & Spesifikasi</h5>
            </div>
            <div class="card-body">
                @if($produk->deskripsi)
                    <div class="p-3 bg-light rounded text-break" style="line-height: 1.7;">
                        {!! nl2br(e($produk->deskripsi)) !!}
                    </div>
                @else
                    <p class="text-muted fst-italic">Belum ada deskripsi dan spesifikasi untuk produk ini.</p>
                @endif
            </div>
        </div>

        {{-- Daftar Varian Produk --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-collection text-info"></i> Daftar Varian Produk ({{ $produk->varian->count() }})</h5>
                <a href="{{ route('admin.produk.varian.create', $produk) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Varian
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>RAM</th>
                                <th>Penyimpanan</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produk->varian as $v)
                                <tr>
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
                                            <button class="btn btn-danger btn-sm" title="Hapus Varian"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada varian untuk produk ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
