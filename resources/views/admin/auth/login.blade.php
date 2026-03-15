@extends('layouts.auth')
@section('title', 'Admin Login')
@section('content')
<h4 class="fw-bold mb-1"><i class="bi bi-shield-lock text-danger"></i> Admin Login</h4>
<p class="text-muted mb-4">Akses khusus administrator</p>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-semibold">Email Admin</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="admin@gmail.com" required>
        </div>
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="form-label fw-semibold">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold">
        <i class="bi bi-shield-check"></i> Masuk sebagai Admin
    </button>
</form>
<hr>
<p class="text-center mb-0"><a href="{{ route('login') }}" class="text-muted small"><i class="bi bi-arrow-left"></i> Kembali ke halaman User</a></p>
@endsection
