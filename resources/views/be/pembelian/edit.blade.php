@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Pembelian</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" id="form-pembelian">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Nota</label>
                            <input type="text" name="nonota" class="form-control" value="{{ $pembelian->nonota }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembelian</label>
                            <input type="date" name="tgl_pembelian" class="form-control" value="{{ $pembelian->tgl_pembelian }}" required>
                        </div>
                        <div class="form-group">
                            <label>Distributor</label>
                            <select name="id_distributor" class="form-control" required>
                                <option value="">Pilih Distributor</option>
                                @foreach($distributors as $distributor)
                                <option value="{{ $distributor->id }}" {{ $pembelian->id_distributor == $distributor->id ? 'selected' : '' }}>
                                    {{ $distributor->nama_distributor }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Detail Obat</h4>
                        <table class="table table-bordered" id="detail-table">
                            <thead>
                                <tr>
                                    <th>Obat</th>
                                    <th>Jumlah</th>
                                    <th>Harga Beli</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembelian->detailPembelian as $detail)
                                <tr>
                                    <td>
                                        <select name="obat_id[]" class="form-control obat-select" required>
                                            <option value="">Pilih Obat</option>
                                            @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" {{ $detail->id_obat == $obat->id ? 'selected' : '' }}>
                                                {{ $obat->nama_obat }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control jumlah" value="{{ $detail->jumlah_beli }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="harga_beli[]" class="form-control harga" value="{{ $detail->harga_beli }}" required>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control subtotal" value="{{ $detail->subtotal }}" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" id="add-row">Tambah Obat</button>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="number" name="total_bayar" class="form-control" id="total_bayar" value="{{ $pembelian->total_bayar }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
