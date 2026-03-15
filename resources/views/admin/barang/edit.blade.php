@extends('layouts.admin')
@section('title', 'Edit Barang')
@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0">Edit Barang</h4>
        <p class="text-muted mb-0">{{ $barang->nama_barang }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.barang.update', $barang->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Barang <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ (old('kategori_id', $barang->kategori_id)) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
                               value="{{ old('nama_barang', $barang->nama_barang) }}" minlength="5" maxlength="80" required>
                        @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Harga Barang (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" name="harga_barang" class="form-control @error('harga_barang') is-invalid @enderror"
                                       value="{{ old('harga_barang', $barang->harga_barang) }}" min="0" required>
                            </div>
                            @error('harga_barang') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah Barang <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_barang" class="form-control @error('jumlah_barang') is-invalid @enderror"
                                   value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" min="0" required>
                            @error('jumlah_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Barang</label>
                        @if($barang->foto_barang)
                            <div class="mb-2">
                                <img src="{{ Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}"
                                     class="rounded" style="max-height:120px;" id="currentFoto">
                                <p class="text-muted small mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="foto_barang" class="form-control @error('foto_barang') is-invalid @enderror"
                               accept="image/*" id="fotoInput">
                        @error('foto_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="mt-2" id="previewContainer" style="display:none;">
                            <img id="fotoPreview" src="" alt="Preview" class="rounded" style="max-height:120px;">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-save"></i> Update Barang
                        </button>
                        <a href="{{ route('admin.barang.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('fotoPreview').src = e.target.result;
            document.getElementById('previewContainer').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
