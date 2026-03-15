@extends('layouts.app')
@section('title', 'Detail Faktur')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
        <a href="{{ route('user.faktur.index') }}" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h4 class="fw-bold mb-0"><i class="bi bi-receipt text-success"></i> Faktur Pembelian</h4>
    </div>
    <button onclick="window.print()" class="btn btn-primary">
        <i class="bi bi-printer"></i> Cetak Faktur
    </button>
</div>

<div class="card" id="faktur-print">
    <div class="card-body p-5">
        <div class="row mb-4">
            <div class="col-6">
                <h3 class="fw-bold text-primary"><i class="bi bi-shop"></i> ChipiChapa Store</h3>
                <p class="text-muted mb-0">Aplikasi Pendataan Barang</p>
                <p class="text-muted">PT ChipiChapa</p>
            </div>
            <div class="col-6 text-end">
                <h5 class="fw-bold">FAKTUR / INVOICE</h5>
                <p class="mb-1"><strong>No. Invoice:</strong> <span class="text-primary">{{ $faktur->nomor_invoice }}</span></p>
                <p class="mb-1"><strong>Tanggal:</strong> {{ $faktur->created_at->format('d F Y') }}</p>
                <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Selesai</span></p>
            </div>
        </div>
        <hr>
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold text-muted">PEMBELI</h6>
                <p class="mb-1"><strong>{{ $faktur->user->nama_lengkap }}</strong></p>
                <p class="mb-1 text-muted">{{ $faktur->user->email }}</p>
                <p class="mb-0 text-muted">{{ $faktur->user->nomor_hp }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold text-muted">ALAMAT PENGIRIMAN</h6>
                <p class="mb-1">{{ $faktur->alamat_pengiriman }}</p>
                <p class="mb-0"><strong>Kode Pos:</strong> {{ $faktur->kode_pos }}</p>
            </div>
        </div>
        <hr>
        <h6 class="fw-bold text-muted mb-3">DETAIL BARANG</h6>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-end">Harga Satuan</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faktur->fakturItems as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge bg-info text-dark">{{ $item->barang->kategori->nama_kategori }}</span></td>
                    <td>{{ $item->barang->nama_barang }} x{{ $item->kuantitas }}</td>
                    <td class="text-center">{{ $item->kuantitas }}</td>
                    <td class="text-end">Rp. {{ number_format($item->barang->harga_barang, 0, ',', '.') }}</td>
                    <td class="text-end fw-bold">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end fw-bold fs-5">Total Harga:</td>
                    <td class="text-end fw-bold fs-5 text-success">Rp. {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center text-muted mt-4">
            <p class="mb-0">Terima kasih telah berbelanja di ChipiChapa Store!</p>
            <small>Faktur ini dicetak pada {{ now()->format('d F Y, H:i') }} WIB</small>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
@media print {
    nav, footer, .btn, .alert { display: none !important; }
    .container { max-width: 100% !important; }
    .card { box-shadow: none !important; }
}
</style>
@endpush
