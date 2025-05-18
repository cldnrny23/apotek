@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container" style="margin: 20px;">
    <h2>Edit Obat</h2>
    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
            @error('nama_obat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
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

        <div class="form-group mb-3">
            <label class="form-label fw-bold">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}" required>
            @error('harga_jual')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi_obat" class="form-control @error('deskripsi_obat') is-invalid @enderror" required>{{ old('deskripsi_obat', $obat->deskripsi_obat) }}</textarea>
            @error('deskripsi_obat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $obat->stok) }}" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label fw-bold">Foto 1</label>
            <input type="file" name="foto1" class="form-control @error('foto1') is-invalid @enderror" accept="image/*">
            @error('foto1')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label fw-bold">Foto 2</label>
            <input type="file" name="foto2" class="form-control @error('foto2') is-invalid @enderror" accept="image/*">
            @error('foto2')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label fw-bold">Foto 3</label>
            <input type="file" name="foto3" class="form-control @error('foto3') is-invalid @enderror" accept="image/*">
            @error('foto3')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
