@extends('layouts.app')
@section('title', $produk->nama . ' - Spesifikasi & Harga')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('katalog.index') }}">Katalog</a></li>
        <li class="breadcrumb-item"><a href="{{ route('katalog.index', ['merek' => $produk->merek_id]) }}">{{ $produk->merek->nama }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
    </ol>
</nav>

<div class="row g-4 mb-5">
    {{-- Gambar Produk --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm sticky-top" style="top: 2rem;">
            <div class="p-4 text-center bg-white rounded">
                <img src="{{ $produk->gambar_url }}" alt="{{ $produk->nama }}" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>

    {{-- Info, Deskripsi, dan Varian --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-dark">{{ $produk->merek->nama }}</span>
                <span class="badge bg-primary">{{ $produk->kategori->label() }}</span>
            </div>
            <h2 class="fw-bold text-dark mb-2">{{ $produk->nama }}</h2>
            <div class="text-muted small mb-3">
                Harga mulai dari:
                <span class="text-primary fs-3 fw-bold ms-1">{{ formatRupiah($produk->harga_mulai) }}</span>
            </div>

            <hr>

            {{-- Deskripsi & Spesifikasi --}}
            <h5 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary"></i> Deskripsi & Spesifikasi</h5>
            @if($produk->deskripsi)
                <div class="p-3 bg-light rounded text-secondary mb-4" style="line-height: 1.8;">
                    {!! nl2br(e($produk->deskripsi)) !!}
                </div>
            @else
                <p class="text-muted fst-italic mb-4">Belum ada keterangan spesifikasi untuk produk ini.</p>
            @endif

            {{-- Slot Integrasi Modul Review --}}
            <div class="mb-4">
                @includeIf('review.partials.daftar', ['produk' => $produk])
            </div>

            {{-- Pilihan Varian Smartphone & Tombol Beli --}}
            <h5 class="fw-bold mb-3"><i class="bi bi-phone-fill text-success"></i> Pilihan Varian & Pembelian</h5>
            <p class="text-muted small">Pilih salah satu varian smartphone di bawah ini untuk melakukan checkout:</p>

            <div class="d-flex flex-column gap-3">
                @forelse($produk->varian as $v)
                    <div class="border rounded p-3 d-flex flex-wrap justify-content-between align-items-center bg-white shadow-xs {{ $v->stok === 0 ? 'opacity-75 bg-light' : '' }}">
                        <div class="me-3 mb-2 mb-md-0">
                            <div class="fw-bold fs-6">
                                {{ $v->ram }} / {{ $v->penyimpanan }}
                                <span class="text-muted fw-normal">| Warna: {{ $v->warna }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="badge bg-{{ $v->badge_stok }}">
                                    {{ $v->label_stok }} (Sisa {{ $v->stok }})
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="text-end">
                                <span class="text-muted small d-block">Harga Varian</span>
                                <span class="text-primary fw-bold fs-5">{{ formatRupiah($v->harga) }}</span>
                            </div>

                            {{-- Tombol Beli: Menghubungkan ke Modul Transaksi --}}
                            @if(Route::has('checkout.create'))
                                @if($v->stok > 0)
                                    <a href="{{ route('checkout.create', ['varian' => $v->id]) }}" class="btn btn-primary px-3">
                                        <i class="bi bi-cart-check"></i> Beli
                                    </a>
                                @else
                                    <button class="btn btn-secondary px-3" disabled>
                                        <i class="bi bi-x-circle"></i> Habis
                                    </button>
                                @endif
                            @else
                                {{-- Placeholder saat modul Transaksi belum di-merge --}}
                                @if($v->stok > 0)
                                    <button class="btn btn-outline-primary px-3" disabled title="Fitur Checkout akan aktif saat modul Transaksi terpasang">
                                        <i class="bi bi-cart-plus"></i> Beli
                                    </button>
                                @else
                                    <button class="btn btn-outline-secondary px-3" disabled>
                                        <i class="bi bi-x-circle"></i> Habis
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-exclamation-triangle"></i> Belum ada varian yang tersedia untuk produk smartphone ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
