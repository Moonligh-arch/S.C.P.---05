@extends('layouts.app')
@section('title', 'Kelola Merek')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-bookmark-star"></i> Kelola Merek</h4>
    <a href="{{ route('admin.merek.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Merek
    </a>
</div>

{{-- Pencarian --}}
<form method="GET" class="mb-3">
    <div class="input-group input-group-sm" style="max-width:350px">
        <input type="text" name="cari" class="form-control" placeholder="Cari merek..." value="{{ $cari }}">
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        @if($cari)
            <a href="{{ route('admin.merek.index') }}" class="btn btn-outline-danger"><i class="bi bi-x"></i></a>
        @endif
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width:60px">#</th>
                <th>Nama Merek</th>
                <th style="width:160px" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($merek as $i => $m)
                <tr>
                    <td>{{ $merek->firstItem() + $i }}</td>
                    <td>{{ $m->nama }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.merek.edit', $m) }}" class="btn btn-warning btn-sm" title="Ubah">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.merek.destroy', $m) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus merek {{ $m->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada data merek.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $merek->links() }}
@endsection
