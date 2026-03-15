@extends('layouts.app')
@section('title', 'Katalog Barang')
@section('content')
<div class="section-header d-flex justify-content-between align-items-end">
    <div>
        <h4><i class="bi bi-grid-3x3-gap text-primary"></i> Katalog Barang</h4>
        <p class="mb-0">Temukan barang yang Anda butuhkan</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="px-3 py-2 rounded-3 fw-semibold" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;font-size:0.85rem;">
            <i class="bi bi-box-seam me-1"></i> {{ $barangs->total() }} Barang
        </span>
    </div>
</div>

@if($barangs->isEmpty())
    <div class="text-center py-5">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width:80px;height:80px;background:#F1F5F9;">
            <i class="bi bi-inbox" style="font-size:2.5rem;color:#94A3B8;"></i>
        </div>
        <p class="text-muted mt-2">Belum ada barang tersedia.</p>
    </div>
@else
    <div class="row g-4">
        @foreach($barangs as $barang)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 product-card" style="overflow:hidden;">
                <div class="position-relative">
                    @if($barang->foto_barang)
                        <img src="{{ Storage::url($barang->foto_barang) }}" class="card-img-top" alt="{{ $barang->nama_barang }}"
                             style="height:200px;object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height:200px;background:linear-gradient(135deg,#F1F5F9,#E2E8F0);">
                            <i class="bi bi-image" style="font-size:2.5rem;color:#CBD5E1;"></i>
                        </div>
                    @endif
                    <span class="position-absolute top-0 start-0 m-3 badge px-2 py-1" style="background:rgba(15,23,42,0.75);backdrop-filter:blur(8px);font-size:0.75rem;border-radius:6px;">
                        {{ $barang->kategori->nama_kategori }}
                    </span>
                    @if($barang->jumlah_barang <= 0)
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-danger px-2 py-1" style="font-size:0.7rem;">Habis</span>
                        </div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <h6 class="fw-bold mb-1" style="font-size:0.95rem;line-height:1.3;">{{ $barang->nama_barang }}</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-800" style="color:#4F46E5;font-size:1.1rem;">Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</span>
                    </div>
                    <div class="mb-3">
                        @if($barang->jumlah_barang <= 0)
                            <span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-2" style="background:#FEF2F2;color:#DC2626;font-size:0.78rem;font-weight:600;">
                                <i class="bi bi-x-circle-fill"></i> Stok Habis
                            </span>
                        @elseif($barang->jumlah_barang <= 5)
                            <span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-2" style="background:#FFFBEB;color:#D97706;font-size:0.78rem;font-weight:600;">
                                <i class="bi bi-exclamation-circle-fill"></i> Sisa {{ $barang->jumlah_barang }}
                            </span>
                        @else
                            <span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-2" style="background:#ECFDF5;color:#059669;font-size:0.78rem;font-weight:600;">
                                <i class="bi bi-check-circle-fill"></i> Stok {{ $barang->jumlah_barang }}
                            </span>
                        @endif
                    </div>
                    <div class="mt-auto">
                        @if($barang->jumlah_barang <= 0)
                            <button class="btn btn-secondary btn-sm w-100 py-2" disabled style="border-radius:8px;font-weight:600;opacity:0.6;">
                                <i class="bi bi-bag-x"></i> Stok Habis
                            </button>
                        @else
                            <form method="POST" action="{{ route('user.keranjang.add', $barang->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm w-100 py-2">
                                    <i class="bi bi-bag-plus me-1"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4 d-flex justify-content-center">{{ $barangs->links() }}</div>
@endif
@endsection
@push('styles')
<style>
.product-card { border: 1px solid #E2E8F0; }
.product-card:hover { border-color: #C7D2FE; box-shadow: 0 10px 40px rgba(79,70,229,0.1); }
.product-card:hover .card-img-top { transform: scale(1.03); }
.product-card .card-img-top { transition: transform 0.4s ease; }
.product-card .position-relative { overflow: hidden; }
</style>
@endpush
