<h1>Detail Produk</h1>

<!-- Menampilkan Detail Produk -->
<div>
    <h2><?php echo $product->name; ?></h2>
    <p>Deskripsi: <?php echo $product->description; ?></p>
    <p>Harga: <?php echo $product->price; ?></p>
    <p>Stok: <?php echo $product->qty; ?></p>
</div>

<!-- Menampilkan Rekomendasi Produk -->
<h3>Recommended Products</h3>
<div class="row">
    <?php foreach ($recommended_products as $recommended_product) { ?>
        <div class="col-sm-6 col-xl-3">
            <div class="box shadow-sm">
                <a href="<?= base_url('produk/detail/' . $recommended_product->id); ?>">
                    <div class="img-box">
                        <img src="<?= base_url('public/image/product/' . $recommended_product->image); ?>" width="100%" height="100%">
                    </div>
                    <div class="detail-box">
                        <h7><?= $recommended_product->name ?></h7>
                        <h7>
                            <i>Price</i>
                            <span><strong><i><?= $recommended_product->price ?></i></strong></span>
                        </h7>
                    </div>
                    <div class="new">
                        <span>Ready</span>
                    </div>
                </a>
                <button class="btn btn-outline-primary btn-rounded w-100 mt-3">
                    <i class="fa fa-shopping-cart"></i> Order
                </button>
            </div>
        </div>
    <?php } ?>
</div>