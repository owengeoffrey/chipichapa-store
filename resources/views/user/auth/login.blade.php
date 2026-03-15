@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<h4 class="fw-bold mb-1">Selamat Datang!</h4>
<p class="text-muted mb-4">Masuk ke akun Anda</p>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="nama@gmail.com" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label fw-semibold">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="bi bi-box-arrow-in-right"></i> Masuk
    </button>
</form>
<hr>
<p class="text-center mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-semibold">Daftar</a></p>
<p class="text-center mt-2 mb-0"><small><a href="{{ route('admin.login') }}" class="text-muted">Login sebagai Admin</a></small></p>
@endsection
