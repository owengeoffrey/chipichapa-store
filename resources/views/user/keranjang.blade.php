@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<div class="section-header">
    <h4><i class="bi bi-bag text-primary"></i> Keranjang Belanja</h4>
    <p>Periksa pesanan Anda sebelum checkout</p>
</div>

@if(empty($keranjang))
    <div class="text-center py-5">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width:80px;height:80px;background:#F1F5F9;">
            <i class="bi bi-bag-x" style="font-size:2.5rem;color:#94A3B8;"></i>
        </div>
        <h5 class="fw-bold mt-2">Keranjang Kosong</h5>
        <p class="text-muted">Mulai tambahkan barang dari katalog</p>
        <a href="{{ route('user.catalog') }}" class="btn btn-primary px-4"><i class="bi bi-grid-3x3-gap me-1"></i> Lihat Katalog</a>
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr style="background:#F8FAFC;">
                                <th class="ps-4 py-3" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;">Barang</th>
                                <th style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;">Harga</th>
                                <th style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;">Qty</th>
                                <th style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keranjang as $id => $item)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-semibold" style="font-size:0.95rem;">{{ $item['nama_barang'] }}</div>
                                    <span class="badge" style="background:#EEF2FF;color:#4F46E5;font-size:0.7rem;">{{ $item['kategori'] }}</span>
                                </td>
                                <td style="color:#64748B;font-size:0.9rem;">Rp. {{ number_format($item['harga_barang'], 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.keranjang.update', $id) }}" class="d-flex align-items-center gap-1">
                                        @csrf @method('PATCH')
                                        <input type="number" name="kuantitas" value="{{ $item['kuantitas'] }}"
                                               min="1" class="form-control form-control-sm text-center" style="width:60px;border-radius:8px;font-weight:600;">
                                        <button type="submit" class="btn btn-sm" style="background:#EEF2FF;color:#4F46E5;border-radius:8px;font-weight:600;">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="fw-bold" style="color:#4F46E5;">Rp. {{ number_format($item['harga_barang'] * $item['kuantitas'], 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.keranjang.remove', $id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background:#FEF2F2;color:#EF4444;border-radius:8px;" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="border:2px solid #E2E8F0;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="font-size:0.85rem;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;">
                        <i class="bi bi-receipt me-1"></i> Ringkasan Pesanan
                    </h6>
                    <div class="d-flex justify-content-between mb-2" style="font-size:0.9rem;">
                        <span class="text-muted">{{ count($keranjang) }} item</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr style="border-color:#E2E8F0;">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-800 fs-5" style="color:#4F46E5;">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('user.faktur.create') }}" class="btn btn-success w-100 py-2 mb-2" style="font-weight:600;border-radius:10px;">
                        <i class="bi bi-receipt-cutoff me-1"></i> Checkout & Buat Faktur
                    </a>
                    <a href="{{ route('user.catalog') }}" class="btn btn-outline-secondary w-100 py-2" style="border-radius:10px;">
                        <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
