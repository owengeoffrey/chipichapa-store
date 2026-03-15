@extends('layouts.admin')
@section('title', 'Kelola Barang')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-box-seam text-primary"></i> Kelola Barang</h4>
        <p class="text-muted mb-0">Daftar semua barang yang tersedia</p>
    </div>
    <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($barang->foto_barang)
                                <img src="{{ Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}"
                                     class="rounded" style="width:50px;height:50px;object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $barang->nama_barang }}</td>
                        <td><span class="badge bg-info text-dark">{{ $barang->kategori->nama_kategori }}</span></td>
                        <td>Rp. {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                        <td>
                            @if($barang->jumlah_barang <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($barang->jumlah_barang <= 5)
                                <span class="badge bg-warning text-dark">{{ $barang->jumlah_barang }} (Sedikit)</span>
                            @else
                                <span class="badge bg-success">{{ $barang->jumlah_barang }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.barang.show', $barang->id) }}" class="btn btn-outline-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.barang.edit', $barang->id) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" title="Hapus"
                                    onclick="confirmDelete({{ $barang->id }}, '{{ $barang->nama_barang }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $barang->id }}" action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada barang. <a href="{{ route('admin.barang.create') }}">Tambah sekarang</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($barangs->hasPages())
    <div class="card-footer">{{ $barangs->links() }}</div>
    @endif
</div>
@endsection
@push('scripts')
<script>
function confirmDelete(id, nama) {
    if (confirm('Yakin ingin menghapus barang "' + nama + '"?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
