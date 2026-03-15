@extends('layouts.app')
@section('title', 'Faktur Saya')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-receipt text-primary"></i> Faktur Saya</h4>

@if($fakturs->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-receipt text-muted" style="font-size:4rem;"></i>
        <p class="text-muted mt-3">Belum ada faktur.</p>
        <a href="{{ route('user.catalog') }}" class="btn btn-primary"><i class="bi bi-shop"></i> Mulai Belanja</a>
    </div>
@else
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>No. Invoice</th>
                        <th>Tanggal</th>
                        <th>Alamat</th>
                        <th>Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fakturs as $faktur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold text-primary">{{ $faktur->nomor_invoice }}</td>
                        <td>{{ $faktur->created_at->format('d M Y') }}</td>
                        <td>{{ Str::limit($faktur->alamat_pengiriman, 40) }}</td>
                        <td class="fw-bold text-success">Rp. {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('user.faktur.show', $faktur->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail / Cetak
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
