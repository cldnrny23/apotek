@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Penjualan</h5>
                <a href="{{ route('penjualans.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Penjualan
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
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Metode Bayar</th>
                            <th>Status</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualans as $index => $penjualan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $penjualan->tgl_penjualan }}</td>
                            <td>{{ $penjualan->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $penjualan->metodeBayar->nama_metode }}</td>
                            <td>{{ $penjualan->status_order }}</td>
                            <td>Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('penjualans.edit', $penjualan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data penjualan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
