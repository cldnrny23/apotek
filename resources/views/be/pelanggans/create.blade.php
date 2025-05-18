@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container">
    <h2>Tambah Pelanggan</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggans.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="katakunci" class="form-control" required>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Alamat Utama</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat1" class="form-control" required>{{ old('alamat1') }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota1" class="form-control" value="{{ old('kota1') }}" required>
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kodepos1" class="form-control" value="{{ old('kodepos1') }}" required>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Alamat Tambahan 1 (Opsional)</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat2" class="form-control">{{ old('alamat2') }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota2" class="form-control" value="{{ old('kota2') }}">
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kodepos2" class="form-control" value="{{ old('kodepos2') }}">
                </div>
            </div>
        </div>

        <h4 class="mt-4">Alamat Tambahan 2 (Opsional)</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat3" class="form-control">{{ old('alamat3') }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota3" class="form-control" value="{{ old('kota3') }}">
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kodepos3" class="form-control" value="{{ old('kodepos3') }}">
                </div>
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
