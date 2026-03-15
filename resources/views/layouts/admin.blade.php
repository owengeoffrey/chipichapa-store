<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin ChipiChapa - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0F172A;
            --sidebar-hover: rgba(79,70,229,0.15);
            --sidebar-active: #4F46E5;
            --gray-50: #F8FAFC;
            --gray-200: #E2E8F0;
            --gray-500: #64748B;
            --radius: 12px;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: var(--gray-50); margin: 0; }
        .sidebar {
            min-height: 100vh; width: 260px; min-width: 260px;
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar .brand {
            padding: 1.5rem 1.25rem; color: #fff; font-weight: 800;
            font-size: 1.25rem; letter-spacing: -0.5px;
            background: linear-gradient(135deg, #818CF8, #C084FC);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .sidebar .nav-link {
            color: #94A3B8; padding: 0.7rem 1.25rem; border-radius: 10px;
            margin: 2px 0.75rem; font-weight: 500; font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover { color: #E2E8F0; background: var(--sidebar-hover); }
        .sidebar .nav-link.active { color: #fff; background: var(--sidebar-active); box-shadow: 0 4px 12px rgba(79,70,229,0.3); }
        .topbar {
            background: #fff; border-bottom: 1px solid var(--gray-200);
            padding: 1rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .topbar .welcome { font-weight: 500; color: var(--gray-500); font-size: 0.95rem; }
        .topbar .welcome strong { color: #0F172A; }
        .card {
            border: 1px solid var(--gray-200); border-radius: var(--radius);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .btn-primary { background: #4F46E5; border-color: #4F46E5; font-weight: 600; border-radius: 8px; }
        .btn-primary:hover { background: #3730A3; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.3); }
        .alert { border-radius: var(--radius); border: none; font-weight: 500; }
        .alert-success { background: #ECFDF5; color: #065F46; }
        .alert-danger { background: #FEF2F2; color: #991B1B; }
        .table { font-size: 0.9rem; }
        .table thead th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; color: var(--gray-500); border-bottom: 2px solid var(--gray-200); }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">
    <div class="sidebar">
        <div class="brand"><i class="bi bi-shield-lock-fill"></i> Admin Panel</div>
        <hr class="border-secondary mx-3 mt-0 opacity-25">
        <ul class="nav flex-column mt-2">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                    <i class="bi bi-box-seam-fill me-2"></i> Kelola Barang
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3">
            <div class="p-3 rounded-3" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
                <div class="d-flex align-items-center mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white me-2" style="width:32px;height:32px;background:#4F46E5;font-size:0.8rem;font-weight:700;">
                        {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
                    </span>
                    <div>
                        <div class="text-white fw-semibold" style="font-size:0.85rem;">{{ session('admin_name', 'Admin') }}</div>
                        <div style="font-size:0.7rem;color:#64748B;">Administrator</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm w-100" style="background:rgba(239,68,68,0.1);color:#EF4444;border:1px solid rgba(239,68,68,0.2);font-weight:600;border-radius:8px;">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex-grow-1" style="min-height:100vh;">
        <div class="topbar">
            <span class="welcome">Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong></span>
            <span style="font-size:0.85rem;color:#94A3B8;">{{ now()->format('l, d F Y') }}</span>
        </div>
        <div class="p-4">
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
