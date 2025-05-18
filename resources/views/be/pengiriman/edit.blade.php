@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Edit Pengiriman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_penjualan" class="form-label">ID Penjualan</label>
                            <select name="id_penjualan" class="form-select @error('id_penjualan') is-invalid @enderror">
                                <option value="">Pilih Penjualan</option>
                                @foreach($penjualans as $penjualan)
                                    <option value="{{ $penjualan->id }}" {{ old('id_penjualan', $pengiriman->id_penjualan) == $penjualan->id ? 'selected' : '' }}>
                                        {{ $penjualan->no_invoice }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_penjualan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_invoice" class="form-label">No Invoice</label>
                            <input type="text" class="form-control @error('no_invoice') is-invalid @enderror"
                                name="no_invoice" value="{{ old('no_invoice', $pengiriman->no_invoice) }}">
                            @error('no_invoice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_kirim" class="form-label">Tanggal Kirim</label>
                            <input type="datetime-local" class="form-control @error('tgl_kirim') is-invalid @enderror"
                                name="tgl_kirim" value="{{ old('tgl_kirim', $pengiriman->tgl_kirim) }}">
                            @error('tgl_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status_kirim" class="form-label">Status Pengiriman</label>
                            <select name="status_kirim" class="form-select @error('status_kirim') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                <option value="Sedang Dikirim" {{ old('status_kirim', $pengiriman->status_kirim) == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                <option value="Tiba Ditujuan" {{ old('status_kirim', $pengiriman->status_kirim) == 'Tiba Ditujuan' ? 'selected' : '' }}>Tiba Ditujuan</option>
                            </select>
                            @error('status_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kurir" class="form-label">Nama Kurir</label>
                            <input type="text" class="form-control @error('nama_kurir') is-invalid @enderror"
                                name="nama_kurir" value="{{ old('nama_kurir', $pengiriman->nama_kurir) }}">
                            @error('nama_kurir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telpon_kurir" class="form-label">Telpon Kurir</label>
                            <input type="text" class="form-control @error('telpon_kurir') is-invalid @enderror"
                                name="telpon_kurir" value="{{ old('telpon_kurir', $pengiriman->telpon_kurir) }}">
                            @error('telpon_kurir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="bukti_foto" class="form-label">Bukti Foto</label>
                            @if($pengiriman->bukti_foto)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/pengiriman/'.$pengiriman->bukti_foto) }}"
                                        alt="Bukti Foto" class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('bukti_foto') is-invalid @enderror"
                                name="bukti_foto">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB</small>
                            @error('bukti_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" rows="3">{{ old('keterangan', $pengiriman->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

