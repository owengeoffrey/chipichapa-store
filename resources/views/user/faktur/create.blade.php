@extends('layouts.app')
@section('title', 'Buat Faktur')
@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('user.keranjang') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><i class="bi bi-receipt text-primary"></i> Buat Faktur</h4>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header fw-bold"><i class="bi bi-box-seam"></i> Ringkasan Pesanan</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Barang</th><th>Kategori</th><th>Qty</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $item)
                        <tr>
                            <td>{{ $item['nama_barang'] }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item['kategori'] }}</span></td>
                            <td>{{ $item['kuantitas'] }}</td>
                            <td>Rp. {{ number_format($item['harga_barang'] * $item['kuantitas'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total:</td>
                            <td class="text-success">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header fw-bold"><i class="bi bi-geo-alt"></i> Informasi Pengiriman</div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.faktur.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Pengiriman <span class="text-danger">*</span></label>
                        <textarea name="alamat_pengiriman" class="form-control @error('alamat_pengiriman') is-invalid @enderror"
                                  rows="3" placeholder="Min. 10, maks. 100 huruf" minlength="10" maxlength="100" required>{{ old('alamat_pengiriman') }}</textarea>
                        @error('alamat_pengiriman') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Kode Pos <span class="text-danger">*</span></label>
                        <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror"
                               value="{{ old('kode_pos') }}" placeholder="5 digit angka" maxlength="5" pattern="\d{5}" required>
                        @error('kode_pos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                        <i class="bi bi-receipt"></i> Buat & Simpan Faktur
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
