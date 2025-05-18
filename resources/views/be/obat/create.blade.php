@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Tambah Obat</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat') }}" required>
                            @error('nama_obat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Jenis Obat</label>
                            <select name="id_jenis" class="form-control @error('id_jenis') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Obat</option>
                                @foreach($jenisObat as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('id_jenis') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}" required>
                            @error('harga_jual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi_obat') is-invalid @enderror" rows="3" required>{{ old('deskripsi_obat') }}</textarea>
                            @error('deskripsi_obat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Foto 1</label>
                            <input type="file" name="foto1" class="form-control @error('foto1') is-invalid @enderror" accept="image/*">
                            @error('foto1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Foto 2</label>
                            <input type="file" name="foto2" class="form-control @error('foto2') is-invalid @enderror" accept="image/*">
                            @error('foto2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold">Foto 3</label>
                            <input type="file" name="foto3" class="form-control @error('foto3') is-invalid @enderror" accept="image/*">
                            @error('foto3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
