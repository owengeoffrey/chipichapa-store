@extends('layouts.app')
@section('title', 'Katalog Barang')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-grid text-primary"></i> Katalog Barang</h4>
        <p class="text-muted mb-0">Temukan barang yang Anda butuhkan</p>
    </div>
    <span class="badge bg-primary fs-6">{{ $barangs->total() }} Barang</span>
</div>

@if($barangs->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox text-muted" style="font-size:4rem;"></i>
        <p class="text-muted mt-3">Belum ada barang tersedia.</p>
    </div>
@else
    <div class="row g-4">
        @foreach($barangs as $barang)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100">
                @if($barang->foto_barang)
                    <img src="{{ Storage::url($barang->foto_barang) }}" class="card-img-top" alt="{{ $barang->nama_barang }}"
                         style="height:200px;object-fit:cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-info text-dark mb-2" style="width:fit-content;">{{ $barang->kategori->nama_kategori }}</span>
                    <h6 class="card-title fw-bold">{{ $barang->nama_barang }}</h6>
                    <p class="text-success fw-bold mb-1">Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                    <p class="text-muted small mb-3">
                        @if($barang->jumlah_barang <= 0)
                            <span class="text-danger"><i class="bi bi-x-circle"></i> Stok Habis</span>
                        @else
                            <span class="text-success"><i class="bi bi-check-circle"></i> Stok: {{ $barang->jumlah_barang }}</span>
                        @endif
                    </p>
                    <div class="mt-auto">
                        @if($barang->jumlah_barang <= 0)
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="bi bi-cart-x"></i> Stok Habis
                            </button>
                        @else
                            <form method="POST" action="{{ route('user.keranjang.add', $barang->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $barangs->links() }}</div>
@endif
@endsection
