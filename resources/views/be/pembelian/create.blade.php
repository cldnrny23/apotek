@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')
<div class="container py-4">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Tambah Pembelian</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pembelian.store') }}" method="POST" id="form-pembelian">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No Nota</label>
                                <input type="text" name="nonota" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <input type="date" name="tgl_pembelian" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Distributor</label>
                                <select name="id_distributor" class="form-control" required>
                                    <option value="">Pilih Distributor</option>
                                    @foreach($distributors as $distributor)
                                    <option value="{{ $distributor->id }}">{{ $distributor->nama_distributor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detail-table">
                                    <thead>
                                        <tr>
                                            <th>Obat</th>
                                            <th width="150">Jumlah</th>
                                            <th width="200">Harga Beli</th>
                                            <th width="200">Subtotal</th>
                                            <th width="50">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="obat_id[]" class="form-control obat-select" required>
                                                    <option value="">Pilih Obat</option>
                                                    @foreach($obats as $obat)
                                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga_beli }}">{{ $obat->nama_obat }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1" required>
                                            </td>
                                            <td>
                                                <input type="number" name="harga_beli[]" class="form-control harga" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control subtotal" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-row p-0" style="width: 30px; height: 30px; ">
                                                    <i class="bi bi-trash" style="font-size: 15px; margin-left: 5px;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="add-row">
                                <i class="fa fa-plus"></i> Tambah Obat
                            </button>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Bayar</label>
                                <input type="number" name="total_bayar" class="form-control form-control-lg" id="total_bayar" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Fungsi untuk menambahkan row baru
    $('#add-row').click(function() {
        var newRow = `
        <tr>
            <td>
                <select name="obat_id[]" class="form-control obat-select" required>
                    <option value="">Pilih Obat</option>
                    @foreach($obats as $obat)
                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga_beli }}">{{ $obat->nama_obat }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1" required>
            </td>
            <td>
                <input type="number" name="harga_beli[]" class="form-control harga" required>
            </td>
            <td>
                <input type="number" class="form-control subtotal" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`;

        $('#detail-table tbody').append(newRow);

        // Aktifkan semua tombol hapus kecuali yang pertama
        $('#detail-table tbody tr').each(function(index) {
            if (index === 0) {
                $(this).find('.remove-row').prop('disabled', true);
            } else {
                $(this).find('.remove-row').prop('disabled', false);
            }
        });
    });

    // Fungsi untuk menghapus row
    $(document).on('click', '.remove-row', function() {
        if ($('#detail-table tbody tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotal();

            // Jika hanya tersisa 1 row, nonaktifkan tombol hapus
            if ($('#detail-table tbody tr').length === 1) {
                $('#detail-table tbody tr .remove-row').prop('disabled', true);
            }
        }
    });

    // Fungsi untuk menghitung subtotal dan total
    function calculateSubtotal(row) {
        var jumlah = parseFloat(row.find('.jumlah').val()) || 0;
        var harga = parseFloat(row.find('.harga').val()) || 0;
        var subtotal = jumlah * harga;
        row.find('.subtotal').val(subtotal.toFixed(2));
        calculateTotal();
    }

    function calculateTotal() {
        var total = 0;
        $('#detail-table tbody tr').each(function() {
            var subtotal = parseFloat($(this).find('.subtotal').val()) || 0;
            total += subtotal;
        });
        $('#total_bayar').val(total.toFixed(2));
    }

    // Event listener untuk perubahan jumlah dan harga
    $(document).on('input', '.jumlah, .harga', function() {
        var row = $(this).closest('tr');
        calculateSubtotal(row);
    });

    // Event listener untuk perubahan pilihan obat
    $(document).on('change', '.obat-select', function() {
        var selectedOption = $(this).find('option:selected');
        var harga = selectedOption.data('harga');
        var row = $(this).closest('tr');
        row.find('.harga').val(harga || '');
        calculateSubtotal(row);
    });

    // Hitung subtotal awal untuk row pertama
    calculateSubtotal($('#detail-table tbody tr:first'));
});
</script>
@endsection
