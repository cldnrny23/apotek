@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container" style="margin: 20px;">
    <h2>Daftar Jenis Obat</h2>
    <a href="{{ route('jenis_obats.create') }}" class="btn btn-primary mb-3">Tambah Jenis Obat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Jenis</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenisObats as $key => $jenis)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ asset($jenis->image_url) }}" alt="Gambar" style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td>{{ $jenis->jenis }}</td>
                            <td>{{ $jenis->deskripsi_jenis ?? '-' }}</td>
                            <td>
                                <a href="{{ route('jenis_obats.edit', $jenis->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('jenis_obats.destroy', $jenis->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
