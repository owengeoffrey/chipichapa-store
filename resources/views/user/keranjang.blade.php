@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary"></i> Keranjang Belanja</h4>

@if(empty($keranjang))
    <div class="text-center py-5">
        <i class="bi bi-cart-x text-muted" style="font-size:4rem;"></i>
        <p class="text-muted mt-3">Keranjang Anda kosong.</p>
        <a href="{{ route('user.catalog') }}" class="btn btn-primary"><i class="bi bi-shop"></i> Belanja Sekarang</a>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keranjang as $id => $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item['nama_barang'] }}</div>
                                    <small class="text-muted">{{ $item['kategori'] }}</small>
                                </td>
                                <td>Rp. {{ number_format($item['harga_barang'], 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.keranjang.update', $id) }}" class="d-flex align-items-center gap-1">
                                        @csrf @method('PATCH')
                                        <input type="number" name="kuantitas" value="{{ $item['kuantitas'] }}"
                                               min="1" class="form-control form-control-sm" style="width:70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="fw-bold text-success">Rp. {{ number_format($item['harga_barang'] * $item['kuantitas'], 0, ',', '.') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.keranjang.remove', $id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header fw-bold">Ringkasan Pesanan</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ count($keranjang) }} item</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total</span>
                        <span class="text-success">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('user.faktur.create') }}" class="btn btn-success w-100">
                        <i class="bi bi-receipt"></i> Buat Faktur
                    </a>
                    <a href="{{ route('user.catalog') }}" class="btn btn-outline-primary w-100 mt-2">
                        <i class="bi bi-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
