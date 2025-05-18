<div class="col-lg-6 col-xl-4">
    <div class="card rounded-4 border-0 shadow-sm">
        <div class="card-body">
            <img src="{{ asset('images/product.jpg') }}" class="img-fluid rounded-4" alt="product">
            <h5 class="mt-3">{{ $item->nama_obat }}</h5>
            <p class="text-muted">{{ $item->deskripsi }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Rp. {{ number_format($item->harga, 0, ',', '.') }}</h6>
                <a href="{{ route('productDetail', ['id' => $item->id]) }}" class="btn btn-primary rounded-3">Detail</a>
            </div>
        </div>
    </div>
</div>
