@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Edit Jenis Pengiriman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_pengirimans.update', $jenisPengiriman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="jenis_kirim" class="form-label">Jenis Pengiriman</label>
                    <select class="form-select @error('jenis_kirim') is-invalid @enderror" name="jenis_kirim">
                        <option value="">Pilih Jenis</option>
                        @foreach(['ekonomi', 'kargo', 'regular', 'same day', 'standard'] as $jenis)
                            <option value="{{ $jenis }}"
                                {{ old('jenis_kirim', $jenisPengiriman->jenis_kirim) == $jenis ? 'selected' : '' }}>
                                {{ ucfirst($jenis) }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_kirim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_ekspedisi" class="form-label">Nama Ekspedisi</label>
                    <input type="text" class="form-control @error('nama_ekspedisi') is-invalid @enderror"
                        name="nama_ekspedisi" value="{{ old('nama_ekspedisi', $jenisPengiriman->nama_ekspedisi) }}">
                    @error('nama_ekspedisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo_ekspedisi" class="form-label">Logo Ekspedisi</label>
                    @if($jenisPengiriman->logo_ekspedisi)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $jenisPengiriman->logo_ekspedisi) }}"
                                alt="Current Logo" height="50">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('logo_ekspedisi') is-invalid @enderror"
                        name="logo_ekspedisi">
                    <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB. Biarkan kosong jika tidak ingin mengubah logo.</small>
                    @error('logo_ekspedisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('jenis_pengirimans.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
