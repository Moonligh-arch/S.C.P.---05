@extends('layouts.app')
@section('title', 'Ubah Merek')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h4 class="mb-3"><i class="bi bi-pencil"></i> Ubah Merek</h4>

        <form action="{{ route('admin.merek.update', $merek) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Merek <span class="text-danger">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $merek->nama) }}" autofocus required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.merek.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
