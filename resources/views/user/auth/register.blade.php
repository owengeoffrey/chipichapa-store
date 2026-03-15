@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<h4 class="fw-bold mb-1">Buat Akun Baru</h4>
<p class="text-muted mb-4">Daftar untuk mulai berbelanja</p>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
    </div>
@endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
               value="{{ old('nama_lengkap') }}" placeholder="Min. 3 huruf, maks. 40 huruf" minlength="3" maxlength="40" required>
        @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" placeholder="nama@gmail.com" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold">Nomor Handphone <span class="text-danger">*</span></label>
        <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
               value="{{ old('nomor_hp') }}" placeholder="08xxxxxxxxxx" required>
        @error('nomor_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               placeholder="Min. 6, maks. 12 huruf" minlength="6" maxlength="12" required>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="bi bi-person-check"></i> Daftar
    </button>
</form>
<hr>
<p class="text-center mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-semibold">Masuk</a></p>
@endsection
