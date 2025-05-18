@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container" style="margin: 20px;">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                <option value="">Pilih Jabatan</option>
                <option value="admin" {{ $user->jabatan == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="apoteker" {{ $user->jabatan == 'apoteker' ? 'selected' : '' }}>Apoteker</option>
                <option value="karyawan" {{ $user->jabatan == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                <option value="kasir" {{ $user->jabatan == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="pemilik" {{ $user->jabatan == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
            </select>
            @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
