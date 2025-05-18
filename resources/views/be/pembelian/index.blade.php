@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Pembelian</h5>
                <a href="{{ route('pembelian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Pembelian
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Tanggal Pembelian</th>
                            <th>Distributor</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembelians as $pembelian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembelian->nonota }}</td>
                            <td>{{ date('d/m/Y', strtotime($pembelian->tgl_pembelian)) }}</td>
                            <td>{{ $pembelian->distributor->nama_distributor }}</td>
                            <td>Rp {{ number_format($pembelian->total_bayar, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pembelian</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
