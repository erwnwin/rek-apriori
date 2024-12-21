<br>
<div class="container py-2 mt-4">
    <div class="d-flex justify-content-between align-items-center mt-2 p-3 bg-light shadow rounded-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('myhome') ?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
        </nav>
    </div>
    <?php if ($product): ?>
        <div class="row row-product mt-4">
            <div class="col-lg-5">
                <figure class="figure">
                    <img src="<?= base_url('public/image/product/' . $product->image) ?>" class="figure-img img-fluid product-main rounded-3 shadow-lg" alt="Product Image">
                    <figcaption class="figure-caption d-flex justify-content-evenly mt-3">
                        <a href="">
                            <img src="<?= base_url('public/image/product/' . $product->image) ?>" class="figure-img img-fluid product-sub rounded-3">
                        </a>
                        <a href="">
                            <img src="<?= base_url('public/image/product/' . $product->image) ?>" class="figure-img img-fluid product-sub rounded-3">
                        </a>
                        <a href="">
                            <img src="<?= base_url('public/image/product/' . $product->image) ?>" class="figure-img img-fluid product-sub rounded-3">
                        </a>
                        <a href="">
                            <img src="<?= base_url('public/image/product/' . $product->image) ?>" class="figure-img img-fluid product-sub rounded-3">
                        </a>
                    </figcaption>
                </figure>
            </div>

            <div class="col-lg-7">
                <h4 class="text-dark fw-bold"><?= $product->nama_produk ?></h4>
                <div class="garis-nama mb-3"></div>
                <h3 class="text-muted mb-3">Rp <span id="productPrice"><?= $product->price ?></span></h3>
                <div class="d-flex align-items-center mb-3">
                    <button type="button" class="btn btn-dark btn-sm" id="minCart"><i class="fa fa-minus text-white"></i></button>
                    <span class="mx-3" id="qtyCart">1</span>
                    <button type="button" class="btn btn-warning btn-sm" id="plusCart"><i class="fa fa-plus text-white"></i></button>
                </div>
                <span class="text-muted">Stock: <span id="qtyMax"><?= $product->qty ?></span></span>

                <div class="mt-2 mb-4">
                    <a class="btn btn-primary text-white btn-lg btn-custom w-100" id="addToCart">
                        <i class="fa fa-shopping-cart me-2"></i> Add to Cart
                    </a>
                </div>

                <div class="card shadow-sm mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text"><?= $product->description ?></p>
                    </div>
                </div>
            </div>

        </div>
    <?php else: ?>
        <p>Data produk tidak ditemukan.</p>
    <?php endif; ?>
    <!-- Rekomendasi Produk -->
    <div class="mt-5">
        <h3 class="text-dark fw-bold">Recommended Products</h3>
        <div class="row row-recommended mt-3">
            <?php if (!empty($recommendedProducts)): ?>
                <?php foreach ($recommendedProducts as $recommended): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 rounded-3">
                            <img src="<?= base_url('public/image/product/' . $recommended->image) ?>" class="card-img-top rounded-3" alt="<?= $recommended->name ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $recommended->name ?></h5>
                                <p class="card-text">Rp <?= number_format($recommended->price, 0, ',', '.') ?></p>
                                <a href="<?= base_url('books/detail/' . $recommended->encrypted_id); ?>" class="btn btn-outline-primary btn-sm rounded-pill">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="ml-3">
                    <p class="text-danger">No recommendations available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>