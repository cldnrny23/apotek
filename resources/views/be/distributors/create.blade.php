@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container">
    <h2>Tambah Distributor</h2>
    <form action="{{ route('distributors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Distributor</label>
            <input type="text" name="nama_distributor" class="form-control @error('nama_distributor') is-invalid @enderror" value="{{ old('nama_distributor') }}">
            @error('nama_distributor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}">
            @error('telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('distributors.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
