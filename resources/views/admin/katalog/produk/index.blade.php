@extends('layouts.app')
@section('title', 'Kelola Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-phone"></i> Kelola Produk</h4>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<form method="GET" class="mb-3">
    <div class="input-group input-group-sm" style="max-width:350px">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama produk..." value="{{ $cari }}">
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        @if($cari)
            <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-danger"><i class="bi bi-x"></i></a>
        @endif
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width:60px">#</th>
                <th style="width:70px">Gambar</th>
                <th>Nama Produk</th>
                <th>Merek</th>
                <th>Kategori</th>
                <th class="text-center">Total Varian</th>
                <th style="width:200px" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $i => $p)
                <tr>
                    <td>{{ $produk->firstItem() + $i }}</td>
                    <td>
                        <img src="{{ $p->gambar_url }}" alt="{{ $p->nama }}" class="rounded"
                             style="width:50px;height:50px;object-fit:cover;">
                    </td>
                    <td class="fw-semibold">{{ $p->nama }}</td>
                    <td>{{ $p->merek->nama }}</td>
                    <td><span class="badge bg-secondary">{{ $p->kategori->label() }}</span></td>
                    <td class="text-center">
                        <a href="{{ route('admin.produk.varian.index', $p) }}" class="badge bg-info text-decoration-none">
                            {{ $p->varian_count }} varian
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.produk.show', $p) }}" class="btn btn-info btn-sm" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.produk.edit', $p) }}" class="btn btn-warning btn-sm" title="Ubah">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.produk.destroy', $p) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus produk {{ $p->nama }}? Semua varian produk ini juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $produk->links() }}
@endsection
