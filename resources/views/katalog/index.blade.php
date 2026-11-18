@extends('layouts.app')
@section('title', 'S.C.P.-05 Katalog')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="bg-primary bg-gradient text-white p-4 rounded-3 shadow-sm mb-4">
            <h2 class="fw-bold mb-1"><i class="bi bi-phone"></i> S.C.P.-05 Katalog</h2>
            <p class="mb-0 text-white-50">Temukan smartphone terbaik dari berbagai merek ternama dengan penawaran harga menarik.</p>
        </div>
    </div>
</div>

{{-- Filter & Pencarian --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('katalog.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted">Cari Nama Smartphone</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="cari" class="form-control" placeholder="Contoh: Xiaomi, Galaxy..." value="{{ $cari }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Filter Merek</label>
                    <select name="merek" class="form-select">
                        <option value="">Semua Merek</option>
                        @foreach($merekList as $m)
                            <option value="{{ $m->id }}" {{ $merekId == $m->id ? 'selected' : '' }}>
                                {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Filter Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat->value }}" {{ $kategori == $kat->value ? 'selected' : '' }}>
                                {{ $kat->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    @if($cari || $merekId || $kategori)
                        <a href="{{ route('katalog.index') }}" class="btn btn-outline-danger" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Grid Produk --}}
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4">
    @forelse($produk as $p)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm card-produk">
                <div class="position-relative">
                    <img src="{{ $p->gambar_url }}" class="card-img-top p-3" alt="{{ $p->nama }}" style="height:220px;object-fit:contain;">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75">
                        {{ $p->merek->nama }}
                    </span>
                    <span class="position-absolute top-0 end-0 m-2 badge bg-primary">
                        {{ $p->kategori->label() }}
                    </span>
                </div>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold mb-1 text-truncate" title="{{ $p->nama }}">
                        <a href="{{ route('katalog.show', $p) }}" class="text-decoration-none text-dark">
                            {{ $p->nama }}
                        </a>
                    </h6>
                    <div class="mt-auto pt-2">
                        <div class="text-muted small">Mulai dari</div>
                        <div class="text-primary fw-bold fs-5">
                            {{ formatRupiah($p->harga_mulai) }}
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0 pb-3">
                    <a href="{{ route('katalog.show', $p) }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                <i class="bi bi-phone-vibrate display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">Tidak ada smartphone yang cocok</h5>
                <p class="text-muted small">Coba ubah kata kunci pencarian atau sesuaikan filter merek dan kategori.</p>
                <a href="{{ route('katalog.index') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Tampilkan Semua
                </a>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {{ $produk->links() }}
</div>
@endsection
