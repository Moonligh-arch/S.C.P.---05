@extends('layouts.app')
@section('title', 'Ubah Varian - ' . $varian->produk->nama)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-pencil text-warning"></i> Ubah Varian: {{ $varian->produk->nama }}</h5>
                <small class="text-muted">{{ $varian->label }}</small>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.varian.update', $varian) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ram" class="form-label">RAM <span class="text-danger">*</span></label>
                            <input type="text" name="ram" id="ram" class="form-control @error('ram') is-invalid @enderror"
                                   value="{{ old('ram', $varian->ram) }}" required autofocus>
                            @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="penyimpanan" class="form-label">Penyimpanan Internal <span class="text-danger">*</span></label>
                            <input type="text" name="penyimpanan" id="penyimpanan" class="form-control @error('penyimpanan') is-invalid @enderror"
                                   value="{{ old('penyimpanan', $varian->penyimpanan) }}" required>
                            @error('penyimpanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                        <input type="text" name="warna" id="warna" class="form-control @error('warna') is-invalid @enderror"
                               value="{{ old('warna', $varian->warna) }}" required>
                        @error('warna') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" step="1000" min="0" name="harga" id="harga"
                                       class="form-control @error('harga') is-invalid @enderror"
                                       value="{{ old('harga', (int)$varian->harga) }}" required>
                            </div>
                            @error('harga') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="stok" id="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', $varian->stok) }}" required>
                            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Perbarui Varian</button>
                        <a href="{{ route('admin.produk.varian.index', $varian->produk_id) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
