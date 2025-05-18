@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container" style="margin: 20px;">
    <h2>Daftar Pelanggan</h2>
    <a href="{{ route('pelanggans.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Telepon</th>
                            <th>Alamat 1</th>
                            <th>Kota</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggans as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $p->nama_pelanggan }}</td>
                            <td>{{ $p->no_telp }}</td>
                            <td>{{ $p->alamat1 }}</td>
                            <td>{{ $p->kota1 }}</td>
                            <td>{{ $p->kodepos1 }}</td>
                            <td>
                                <a href="{{ route('pelanggans.edit', $p->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('pelanggans.destroy', $p->id) }}" method="POST" class="d-inline">
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
