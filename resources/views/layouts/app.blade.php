<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ChipiChapa Store - @yield('title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #3730A3;
            --primary-light: #818CF8;
            --accent: #F59E0B;
            --accent-dark: #D97706;
            --dark: #0F172A;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-300: #CBD5E1;
            --gray-500: #64748B;
            --gray-700: #334155;
            --gray-900: #0F172A;
            --success: #10B981;
            --danger: #EF4444;
            --radius: 12px;
            --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 24px rgba(0,0,0,0.04);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.1);
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: var(--gray-50); color: var(--gray-900); }
        .navbar-main {
            background: linear-gradient(135deg, var(--dark) 0%, #1E293B 100%);
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .navbar-main .navbar-brand {
            font-weight: 800; font-size: 1.35rem; letter-spacing: -0.5px;
            background: linear-gradient(135deg, #818CF8, #C084FC);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .navbar-main .nav-link {
            color: var(--gray-300) !important; font-weight: 500; font-size: 0.9rem;
            padding: 0.5rem 1rem; border-radius: 8px; transition: all 0.2s;
        }
        .navbar-main .nav-link:hover { color: #fff !important; background: rgba(255,255,255,0.08); }
        .navbar-main .nav-link.active { color: #fff !important; background: var(--primary); }
        .cart-badge {
            position: relative; top: -8px; right: 4px;
            background: var(--danger); font-size: 0.65rem;
            padding: 2px 6px; border-radius: 10px;
        }
        .card {
            border: 1px solid var(--gray-200); border-radius: var(--radius);
            box-shadow: var(--shadow); transition: all 0.25s ease;
        }
        .card:hover { box-shadow: var(--shadow-lg); transform: translateY(-2px); }
        .btn-primary {
            background: var(--primary); border-color: var(--primary);
            font-weight: 600; border-radius: 8px; transition: all 0.2s;
        }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.4); }
        .btn-success { background: var(--success); border-color: var(--success); font-weight: 600; border-radius: 8px; }
        .btn-success:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16,185,129,0.4); }
        .btn-outline-secondary { border-radius: 8px; font-weight: 500; }
        .badge { font-weight: 500; border-radius: 6px; }
        .section-header { margin-bottom: 2rem; }
        .section-header h4 { font-weight: 800; letter-spacing: -0.5px; font-size: 1.5rem; }
        .section-header p { color: var(--gray-500); }
        .page-link { border-radius: 8px !important; margin: 0 2px; font-weight: 500; }
        .alert { border-radius: var(--radius); border: none; font-weight: 500; }
        .alert-success { background: #ECFDF5; color: #065F46; }
        .alert-danger { background: #FEF2F2; color: #991B1B; }
        .dropdown-menu { border: 1px solid var(--gray-200); border-radius: var(--radius); box-shadow: var(--shadow-lg); padding: 0.5rem; }
        .dropdown-item { border-radius: 8px; font-weight: 500; padding: 0.5rem 1rem; }
        footer { background: var(--dark); color: var(--gray-500); }
        footer a { color: var(--primary-light); }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-main">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.catalog') }}">
            <i class="bi bi-shop"></i> ChipiChapa
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.catalog') ? 'active' : '' }}" href="{{ route('user.catalog') }}">
                        <i class="bi bi-grid-3x3-gap me-1"></i> Katalog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.faktur.*') ? 'active' : '' }}" href="{{ route('user.faktur.index') }}">
                        <i class="bi bi-receipt-cutoff me-1"></i> Faktur
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.keranjang') ? 'active' : '' }}" href="{{ route('user.keranjang') }}">
                        <i class="bi bi-bag me-1"></i> Keranjang
                        @php $keranjangCount = count(session('keranjang', [])); @endphp
                        @if($keranjangCount > 0)
                            <span class="badge cart-badge">{{ $keranjangCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white me-1" style="width:26px;height:26px;font-size:0.75rem;">
                            {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                        </span>
                        {{ auth()->user()->nama_lengkap }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

<footer class="py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1 fw-semibold" style="color:#94A3B8;">&copy; {{ date('Y') }} ChipiChapa Store</p>
        <p class="mb-0 small">PT ChipiChapa &middot; Aplikasi Pendataan Barang</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
