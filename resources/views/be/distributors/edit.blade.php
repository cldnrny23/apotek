@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container">
    <h2>Edit Distributor</h2>
    <form action="{{ route('distributors.update', $distributor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Distributor</label>
            <input type="text" name="nama_distributor" class="form-control @error('nama_distributor') is-invalid @enderror" value="{{ old('nama_distributor', $distributor->nama_distributor) }}">
            @error('nama_distributor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $distributor->telepon) }}">
            @error('telepon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $distributor->alamat) }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('distributors.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
