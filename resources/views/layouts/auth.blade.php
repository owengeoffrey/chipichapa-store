<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChipiChapa Store - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background: #0F172A;
            background-image:
                radial-gradient(at 20% 80%, rgba(79,70,229,0.15) 0%, transparent 60%),
                radial-gradient(at 80% 20%, rgba(192,132,252,0.1) 0%, transparent 60%),
                radial-gradient(at 50% 50%, rgba(79,70,229,0.05) 0%, transparent 80%);
        }
        .auth-wrapper {
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem;
        }
        .auth-card {
            background: rgba(255,255,255,0.97);
            border: 1px solid rgba(226,232,240,0.5);
            border-radius: 20px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            max-width: 440px; width: 100%;
        }
        .brand-section { text-align: center; margin-bottom: 1.5rem; }
        .brand-logo {
            font-size: 2.5rem; font-weight: 800; letter-spacing: -1px;
            background: linear-gradient(135deg, #818CF8, #C084FC, #F0ABFC);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-sub { color: #64748B; font-size: 0.9rem; font-weight: 400; }
        .form-control {
            border-radius: 10px; padding: 0.65rem 1rem;
            border: 1.5px solid #E2E8F0; font-size: 0.95rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #4F46E5; box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }
        .form-label { font-weight: 600; font-size: 0.85rem; color: #334155; }
        .btn-primary {
            background: linear-gradient(135deg, #4F46E5, #7C3AED);
            border: none; border-radius: 10px; font-weight: 600;
            padding: 0.65rem 1.5rem; transition: all 0.3s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(79,70,229,0.4); }
        .btn-danger {
            background: linear-gradient(135deg, #DC2626, #B91C1C);
            border: none; border-radius: 10px; font-weight: 600;
            padding: 0.65rem 1.5rem;
        }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(220,38,38,0.4); }
        .input-group-text { border-radius: 10px 0 0 10px; background: #F8FAFC; border: 1.5px solid #E2E8F0; border-right: none; color: #64748B; }
        .input-group .form-control { border-left: none; }
        .alert { border-radius: 12px; border: none; font-weight: 500; font-size: 0.9rem; }
        .alert-danger { background: #FEF2F2; color: #991B1B; }
        a { color: #4F46E5; text-decoration: none; font-weight: 600; }
        a:hover { color: #3730A3; }
        .divider { position: relative; text-align: center; margin: 1.25rem 0; }
        .divider::before { content:''; position:absolute; top:50%; left:0; right:0; height:1px; background:#E2E8F0; }
        .divider span { background:#fff; padding:0 1rem; position:relative; color:#94A3B8; font-size:0.85rem; }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div>
        <div class="brand-section">
            <div class="brand-logo"><i class="bi bi-shop"></i> ChipiChapa</div>
            <div class="brand-sub">Store Management System</div>
        </div>
        <div class="auth-card p-4 p-md-5">
            @yield('content')
        </div>
        <p class="text-center mt-4" style="color:#475569;font-size:0.8rem;">&copy; {{ date('Y') }} PT ChipiChapa</p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
