<!-- breadcrumb part start-->
<section class="breadcrumb_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <h2>Detail Produk</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb part end-->

<!-- product detail part start -->
<section class="product_detail section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product_detail_img">
                    <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_obat }}" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product_detail_content">
                    <h3>{{ $product->nama_obat }}</h3>
                    <p class="product-category">Kategori: {{ $product->jenisObat->nama_jenis }}</p>
                    <p class="product-price">Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="product-stock {{ $product->stok > 0 ? 'in-stock' : 'out-stock' }}">
                        Stok: {{ $product->stok > 0 ? 'Tersedia' : 'Habis' }}
                    </p>

                    <div class="product_info">
                        <h4>Deskripsi:</h4>
                        <p>{{ $product->deskripsi }}</p>

                        <h4>Komposisi:</h4>
                        <p>{{ $product->komposisi }}</p>

                        <h4>Indikasi:</h4>
                        <p>{{ $product->indikasi }}</p>

                        <h4>Aturan Pakai:</h4>
                        <p>{{ $product->aturan_pakai }}</p>
                    </div>

                    @if($product->stok > 0)
                    <div class="product_add_to_cart">
                        <div class="quantity">
                            <span class="qty-minus" onclick="decreaseQuantity()"><i class="ti-minus"></i></span>
                            <input type="number" class="qty-text" id="quantity" value="1" min="1" max="{{ $product->stok }}">
                            <span class="qty-plus" onclick="increaseQuantity({{ $product->stok }})"><i class="ti-plus"></i></span>
                        </div>
                        <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                            Tambah ke Keranjang
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-12">
                <h3 class="related-title">Produk Terkait</h3>
            </div>

            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-sm-6">
                <div class="single_product_item">
                    <img src="{{ asset('storage/'.$related->gambar) }}" alt="{{ $related->nama_obat }}" class="img-fluid">
                    <h3>
                        <a href="{{ route('products.show', $related->id) }}">{{ $related->nama_obat }}</a>
                    </h3>
                    <p class="product-price">Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- product detail part end -->

<script>
function increaseQuantity(max) {
    const quantityInput = document.getElementById('quantity');
    let value = parseInt(quantityInput.value);
    if (value < max) {
        quantityInput.value = value + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    let value = parseInt(quantityInput.value);
    if (value > 1) {
        quantityInput.value = value - 1;
    }
}

// Tambahkan event listener untuk tombol tambah ke keranjang
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        const quantity = document.getElementById('quantity').value;

        // Kirim data ke server menggunakan AJAX
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Produk berhasil ditambahkan ke keranjang');
                // Update jumlah item di keranjang
                updateCartCount(data.cartCount);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(element => {
        element.textContent = count;
    });
}
</script>
