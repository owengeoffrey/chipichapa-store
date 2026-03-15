@extends('layouts.admin')
@section('title', 'Detail Barang')
@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Detail Barang</h4>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center p-4">
                @if($barang->foto_barang)
                    <img src="{{ Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}"
                         class="img-fluid rounded" style="max-height:250px;">
                @else
                    <div class="bg-light rounded p-5 d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="bi bi-image text-muted" style="font-size:4rem;"></i>
                    </div>
                    <p class="text-muted mt-2 small">Tidak ada foto</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Informasi Barang</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-muted" width="35%">Kategori</th>
                        <td><span class="badge bg-info text-dark fs-6">{{ $barang->kategori->nama_kategori }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Nama Barang</th>
                        <td class="fw-bold fs-5">{{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Harga</th>
                        <td class="text-success fw-bold fs-5">Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Stok</th>
                        <td>
                            @if($barang->jumlah_barang <= 0)
                                <span class="badge bg-danger fs-6">Habis</span>
                            @else
                                <span class="badge bg-success fs-6">{{ $barang->jumlah_barang }} unit</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Ditambahkan</th>
                        <td>{{ $barang->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('admin.barang.edit', $barang->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus barang ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
