@extends('layouts.app')
@section('title', 'Detail Faktur')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('user.faktur.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h4 class="fw-bold mb-0" style="letter-spacing:-0.5px;">Faktur Pembelian</h4>
            <span style="color:#64748B;font-size:0.85rem;">{{ $faktur->nomor_invoice }}</span>
        </div>
    </div>
    <button onclick="window.print()" class="btn btn-primary px-4" style="border-radius:10px;">
        <i class="bi bi-printer me-1"></i> Cetak Faktur
    </button>
</div>

<div class="card" id="faktur-print" style="border:none;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
    <div class="card-body p-5">
        {{-- Header --}}
        <div class="row align-items-start mb-4">
            <div class="col-6">
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.5px;background:linear-gradient(135deg,#4F46E5,#7C3AED);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                    <i class="bi bi-shop" style="-webkit-text-fill-color:#4F46E5;"></i> ChipiChapa Store
                </h3>
                <p class="mb-0" style="color:#64748B;font-size:0.9rem;">PT ChipiChapa</p>
                <p style="color:#94A3B8;font-size:0.85rem;">Aplikasi Pendataan Barang</p>
            </div>
            <div class="col-6 text-end">
                <div class="d-inline-block text-start px-4 py-3 rounded-3" style="background:#F8FAFC;border:1px solid #E2E8F0;">
                    <div class="fw-800 mb-2" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:1px;color:#64748B;">INVOICE</div>
                    <p class="mb-1 fw-semibold" style="color:#4F46E5;font-size:0.9rem;">{{ $faktur->nomor_invoice }}</p>
                    <p class="mb-1" style="font-size:0.85rem;color:#334155;">{{ $faktur->created_at->format('d F Y') }}</p>
                    <span class="badge px-2 py-1" style="background:#ECFDF5;color:#059669;font-size:0.75rem;border-radius:6px;">Selesai</span>
                </div>
            </div>
        </div>

        <hr style="border-color:#E2E8F0;">

        {{-- Buyer & Shipping --}}
        <div class="row mb-4">
            <div class="col-6">
                <div class="fw-700 mb-2" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;color:#94A3B8;">Ditagihkan kepada</div>
                <p class="fw-bold mb-1">{{ $faktur->user->nama_lengkap }}</p>
                <p class="mb-1" style="color:#64748B;font-size:0.9rem;">{{ $faktur->user->email }}</p>
                <p class="mb-0" style="color:#64748B;font-size:0.9rem;">{{ $faktur->user->nomor_hp }}</p>
            </div>
            <div class="col-6">
                <div class="fw-700 mb-2" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.5px;color:#94A3B8;">Alamat Pengiriman</div>
                <p class="mb-1" style="font-size:0.9rem;">{{ $faktur->alamat_pengiriman }}</p>
                <p class="mb-0" style="font-size:0.9rem;"><strong>Kode Pos:</strong> {{ $faktur->kode_pos }}</p>
            </div>
        </div>

        {{-- Items Table --}}
        <div class="rounded-3 overflow-hidden" style="border:1px solid #E2E8F0;">
            <table class="table mb-0">
                <thead>
                    <tr style="background:#F8FAFC;">
                        <th class="ps-4 py-3" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">#</th>
                        <th style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">Kategori</th>
                        <th style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">Nama Barang</th>
                        <th class="text-center" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">Qty</th>
                        <th class="text-end" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">Harga</th>
                        <th class="text-end pe-4" style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;border:none;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faktur->fakturItems as $i => $item)
                    <tr>
                        <td class="ps-4" style="color:#94A3B8;">{{ $i + 1 }}</td>
                        <td><span class="badge" style="background:#EEF2FF;color:#4F46E5;font-size:0.75rem;">{{ $item->barang->kategori->nama_kategori }}</span></td>
                        <td class="fw-semibold">{{ $item->barang->nama_barang }} <span style="color:#94A3B8;">&times;{{ $item->kuantitas }}</span></td>
                        <td class="text-center">{{ $item->kuantitas }}</td>
                        <td class="text-end" style="color:#64748B;">Rp. {{ number_format($item->barang->harga_barang, 0, ',', '.') }}</td>
                        <td class="text-end pe-4 fw-bold">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end p-4" style="background:#F8FAFC;border-top:2px solid #E2E8F0;">
                <div class="text-end">
                    <div style="font-size:0.8rem;color:#94A3B8;text-transform:uppercase;letter-spacing:0.5px;">Total Harga</div>
                    <div class="fw-800" style="font-size:1.5rem;color:#4F46E5;">Rp. {{ number_format($faktur->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-5 pt-4" style="border-top:1px dashed #E2E8F0;">
            <p class="fw-semibold mb-1" style="color:#334155;">Terima kasih telah berbelanja di ChipiChapa Store!</p>
            <p class="mb-0" style="font-size:0.8rem;color:#94A3B8;">Faktur dicetak pada {{ now()->format('d F Y, H:i') }} WIB</p>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
@media print {
    nav, footer, .btn, .alert, .section-header { display: none !important; }
    .container { max-width: 100% !important; padding: 0 !important; }
    .card { box-shadow: none !important; border: none !important; }
    #faktur-print { border: none !important; }
}
</style>
@endpush
