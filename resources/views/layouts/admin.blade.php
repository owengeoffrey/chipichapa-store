<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin ChipiChapa - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .sidebar { min-height: 100vh; background: #1a1a2e; }
        .sidebar .nav-link { color: #a0aec0; padding: 10px 20px; border-radius: 8px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: #e94560; }
        .sidebar .brand { color: #fff; font-size: 1.3rem; font-weight: 700; padding: 20px; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .navbar-admin { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">
    <div class="sidebar d-flex flex-column" style="width:250px; min-width:250px;">
        <div class="brand"><i class="bi bi-shield-check"></i> Admin Panel</div>
        <hr class="border-secondary mx-3 mt-0">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                    <i class="bi bi-box-seam me-2"></i> Kelola Barang
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <div class="flex-grow-1">
        <nav class="navbar navbar-admin px-4 py-3">
            <span class="fw-semibold text-muted">Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong></span>
        </nav>
        <div class="container-fluid p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
