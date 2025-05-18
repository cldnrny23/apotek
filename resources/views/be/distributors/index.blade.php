@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Distributor</h5>
                <a href="{{ route('distributors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Distributor
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Distributor</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($distributors as $index => $distributor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $distributor->nama_distributor }}</td>
                            <td>{{ $distributor->telepon }}</td>
                            <td>{{ $distributor->alamat }}</td>
                            <td>
                                <a href="{{ route('distributors.edit', $distributor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('distributors.destroy', $distributor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
