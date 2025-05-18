@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Tambah Penjualan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('penjualans.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_penjualan" class="form-label">Tanggal Penjualan</label>
                            <input type="date" class="form-control @error('tgl_penjualan') is-invalid @enderror"
                                id="tgl_penjualan" name="tgl_penjualan" value="{{ old('tgl_penjualan') }}">
                            @error('tgl_penjualan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_pelanggan" class="form-label">Pelanggan</label>
                            <select class="form-select @error('id_pelanggan') is-invalid @enderror"
                                id="id_pelanggan" name="id_pelanggan">
                                <option value="">Pilih Pelanggan</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" {{ old('id_pelanggan') == $pelanggan->id ? 'selected' : '' }}>
                                        {{ $pelanggan->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_pelanggan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_metode_bayar" class="form-label">Metode Pembayaran</label>
                            <select class="form-select @error('id_metode_bayar') is-invalid @enderror"
                                id="id_metode_bayar" name="id_metode_bayar">
                                <option value="">Pilih Metode Pembayaran</option>
                                @foreach($metodeBayars as $metode)
                                    <option value="{{ $metode->id }}" {{ old('id_metode_bayar') == $metode->id ? 'selected' : '' }}>
                                        {{ $metode->nama_metode }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_metode_bayar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_jenis_kirim" class="form-label">Jenis Pengiriman</label>
                            <select class="form-select @error('id_jenis_kirim') is-invalid @enderror"
                                    id="id_jenis_kirim" name="id_jenis_kirim">
                                <option value="">Pilih Jenis Pengiriman</option>
                                @foreach($jenisPengirimans as $jenisPengiriman)
                                    <option value="{{ $jenisPengiriman->id }}" {{ old('id_jenis_kirim') == $jenisPengiriman->id ? 'selected' : '' }}>
                                        {{ $jenisPengiriman->jenis_kirim }} ({{ $jenisPengiriman->nama_ekspedisi ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ongkos_kirim" class="form-label">Ongkos Kirim</label>
                            <input type="number" class="form-control @error('ongkos_kirim') is-invalid @enderror"
                                id="ongkos_kirim" name="ongkos_kirim" value="{{ old('ongkos_kirim', 0) }}">
                            @error('ongkos_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biaya_app" class="form-label">Biaya Aplikasi</label>
                            <input type="number" class="form-control @error('biaya_app') is-invalid @enderror"
                                id="biaya_app" name="biaya_app" value="{{ old('biaya_app', 0) }}">
                            @error('biaya_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status_order" class="form-label">Status Order</label>
                    <select class="form-select @error('status_order') is-invalid @enderror"
                        id="status_order" name="status_order">
                        <option value="">Pilih Status</option>
                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Menunggu Kurir">Menunggu Kurir</option>
                        <option value="Dibatalkan Pembeli">Dibatalkan Pembeli</option>
                        <option value="Dibatalkan Penjual">Dibatalkan Penjual</option>
                        <option value="Bermasalah">Bermasalah</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    @error('status_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan_status" class="form-label">Keterangan Status</label>
                    <textarea class="form-control @error('keterangan_status') is-invalid @enderror"
                        id="keterangan_status" name="keterangan_status" rows="3">{{ old('keterangan_status') }}</textarea>
                    @error('keterangan_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('penjualans.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
