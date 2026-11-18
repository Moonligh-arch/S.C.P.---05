@extends('layouts.app')
@section('title', 'Tambah Varian - ' . $produk->nama)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-plus-lg text-primary"></i> Tambah Varian: {{ $produk->nama }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.produk.varian.store', $produk) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ram" class="form-label">RAM <span class="text-danger">*</span></label>
                            <input type="text" name="ram" id="ram" class="form-control @error('ram') is-invalid @enderror"
                                   placeholder="Contoh: 8 GB" value="{{ old('ram') }}" required autofocus>
                            @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="penyimpanan" class="form-label">Penyimpanan Internal <span class="text-danger">*</span></label>
                            <input type="text" name="penyimpanan" id="penyimpanan" class="form-control @error('penyimpanan') is-invalid @enderror"
                                   placeholder="Contoh: 256 GB" value="{{ old('penyimpanan') }}" required>
                            @error('penyimpanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                        <input type="text" name="warna" id="warna" class="form-control @error('warna') is-invalid @enderror"
                               placeholder="Contoh: Titanium Black" value="{{ old('warna') }}" required>
                        @error('warna') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" step="1000" min="0" name="harga" id="harga"
                                       class="form-control @error('harga') is-invalid @enderror"
                                       placeholder="Contoh: 5999000" value="{{ old('harga') }}" required>
                            </div>
                            @error('harga') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="stok" id="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   placeholder="Contoh: 10" value="{{ old('stok', 0) }}" required>
                            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan Varian</button>
                        <a href="{{ route('admin.produk.varian.index', $produk) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
