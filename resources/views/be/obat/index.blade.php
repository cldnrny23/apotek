@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container" style="margin: 20px;">
    <h2>Daftar Obat</h2>
    <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">Tambah Obat</a>

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
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($obat as $key => $o)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $o->nama_obat }}</td>
                            <td>{{ $o->jenisObat->jenis ?? '-' }}</td>
                            <td>{{ $o->deskripsi_obat }}</td>
                            <td>Rp {{ number_format($o->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $o->stok }}</td>
                            <td>
                                @for($f=1; $f<=3; $f++)
                                    @php $foto = 'foto'.$f; @endphp
                                    @if($o->$foto)
                                        <img src="{{ asset('storage/obat/'.$o->$foto) }}"
                                            alt="Foto {{ $f }}"
                                            style="width: 50px; height: 50px; object-fit: cover; margin-right: 5px; cursor: pointer;"
                                            onclick="showImgPreview('{{ asset('storage/obat/'.$o->$foto) }}')"
                                            class="img-thumbnail">
                                    @endif
                                @endfor
                            </td>
                            <td>
                                <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('obat.destroy', $o->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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

<!-- Modal for image preview -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Preview Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPreviewImage" src="" alt="Preview" style="max-width: 100%;">
            </div>
        </div>
    </div>
</div>

<script>
function showImgPreview(src) {
    document.getElementById('modalPreviewImage').src = src;
    $('#imagePreviewModal').modal('show');
}
</script>
@endsection
