@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-plus-lg text-primary"></i> Tambah Produk Smartphone</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                   placeholder="Contoh: Xiaomi 14 Ultra" value="{{ old('nama') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="merek_id" class="form-label">Merek <span class="text-danger">*</span></label>
                            <select name="merek_id" id="merek_id" class="form-select @error('merek_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Merek --</option>
                                @foreach($merek as $m)
                                    <option value="{{ $m->id }}" {{ old('merek_id') == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
                                @endforeach
                            </select>
                            @error('merek_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoriList as $kat)
                                    <option value="{{ $kat->value }}" {{ old('kategori') == $kat->value ? 'selected' : '' }}>
                                        {{ $kat->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">
                            Deskripsi & Spesifikasi
                            <small class="text-muted">(Tuliskan deskripsi ringkas dan rincian spesifikasi)</small>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="8"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tulis deskripsi dan spesifikasi smartphone di sini...&#10;&#10;Contoh format spesifikasi:&#10;Layar: 6.73 inci LTPO AMOLED, 120Hz&#10;Chipset: Qualcomm Snapdragon 8 Gen 3&#10;Kamera: 50 MP (Leica) + 50 MP Ultrawide&#10;Baterai: 5000 mAh, 90W Fast Charging&#10;OS: Android 14, HyperOS">{{ old('deskripsi') }}</textarea>
                        <div class="form-text">Tips: Gunakan format baris <code>Nama Spesifikasi: Nilai</code> untuk memudahkan pembeli membaca spesifikasi.</div>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="form-label">Foto / Gambar Produk</label>
                        <input type="file" name="gambar" id="gambar"
                               class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                        <div class="form-text">Format didukung: JPG, JPEG, PNG, WebP. Maksimal 2 MB.</div>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan Produk</button>
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
