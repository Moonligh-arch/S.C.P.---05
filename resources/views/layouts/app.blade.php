<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SCP-05') - Smartphone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .card-produk { transition: transform .2s; }
        .card-produk:hover { transform: translateY(-4px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.12); }
        .card-produk img { height: 220px; object-fit: cover; }
        .navbar-brand { font-weight: 700; }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-phone"></i> SCP-05 Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('katalog.*') ? 'active' : '' }}"
                           href="{{ route('katalog.index') }}">
                            <i class="bi bi-grid"></i> Katalog
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->is('admin/*') ? 'active' : '' }}"
                                   href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-gear"></i> Admin Katalog
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.produk.index') }}">Produk</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.merek.index') }}">Merek</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-grow-1 py-4">
        <div class="container">
            {{-- Flash messages --}}
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('gagal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>&copy; {{ date('Y') }} SCP-05 Smartphone Store. Kelompok Tugas.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
