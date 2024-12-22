<!-- slider section -->
<br>
<section class="slider_section mt-3">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner  ml-1 mr-1">
            <div class="carousel-item active">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-box">
                                <h1>
                                    Welcome to Katalindo Medikarya Utama
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="<?= base_url('assets/img/books4.png') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-box">
                                <h1>
                                    Katalindo Medikarya Utama
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="<?= base_url('assets/img/books4.png') ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-box">
                                <h1>
                                    Katalindo Medikarya Utama
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="<?= base_url('assets/img/books4.png') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
    </div>

</section>
<!-- end slider section -->
</div>

<!-- shop section -->

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Produk/Buku Kami
            </h2>
        </div>
        <div class="row">
            <?php if (!empty($recommendedProduct)): ?>
                <div class="col-md-6">
                    <div class="box">
                        <a href="<?= base_url('books/detail/' . $recommendedProduct->encrypted_id); ?>">
                            <div class="img-box">
                                <img src="<?= base_url('public/image/product/' . $recommendedProduct->image); ?>" alt="<?= $recommendedProduct->name ?>">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <?= $recommendedProduct->name ?>
                                </h6>
                                <h6>
                                    Harga
                                    <span>
                                        Rp. <?= number_format($recommendedProduct->price, 0, ',', '.') ?>
                                    </span>
                                </h6>
                            </div>
                            <div class="new">
                                <span>
                                    Best Seller
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ml-3">
                    <p class="text-danger">No best seller product available.</p>
                </div>
            <?php endif; ?>

            <?php foreach ($books1 as $book): ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="box">
                        <a href="<?= base_url('books/detail/' . $book->encrypted_id); ?>">
                            <div class="img-box">
                                <img src="<?= base_url('public/image/product/' . $book->image); ?>" alt="<?= $book->name ?>">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <?= $book->name ?>
                                </h6>
                                <h6>
                                    Harga
                                    <span>
                                        Rp. <?= number_format($book->price, 0, ',', '.') ?>
                                    </span>
                                </h6>
                            </div>
                            <div class="new">
                                <span>
                                    Ready
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>



        </div>
        <!-- Tombol untuk melihat semua produk -->
        <?php if (count($books1) > 0): ?>
            <div class="btn-box mb-5">
                <a href="<?= base_url('books') ?>">Lihat Semua</a>
            </div>
        <?php endif; ?>

        <hr>
        <!-- Rekomendasi Beli -->
        <div class="heading_container heading_center mt-5 ">
            <h2>
                <span class="badge bg-danger text-white">Rekomendasi</span> <span class="badge bg-success text-white">Untuk Anda</span>
            </h2>
        </div>
        <div class="row">

            <?php if (!empty($recommendedProducts)): ?>
                <?php foreach ($recommendedProducts as $b): ?>
                    <div class="col-sm-6 col-xl-3">
                        <div class="box">
                            <a href="<?= base_url('books/detail/' . $b->encrypted_id); ?>">
                                <div class="img-box">
                                    <img src="<?= base_url('public/image/product/' . $b->image); ?>" width="100%" height="100%">
                                </div>
                                <div class="detail-box">
                                    <h7>
                                        <?= $b->name ?>
                                    </h7>

                                    <h7>
                                        <i>Harga</i>
                                        <span>
                                            <strong> <i><?= $b->price ?></i></strong>
                                        </span>
                                    </h7>
                                </div>
                                <div class="new">
                                    <span>
                                        Ready
                                    </span>
                                </div>
                            </a>
                            <!-- Tombol Add to Cart -->
                            <button class="btn btn-outline-primary btn-rounded w-100 mt-3"><i class="fa fa-shopping-cart"></i> Order</button>
                        </div>
                    </div>


                <?php endforeach; ?>
            <?php else: ?>
                <div class="ml-3">
                    <p class="text-danger">No recommendations available.</p>
                </div>
            <?php endif; ?>

            <!-- <?php if (!empty($recommendedProducts)): ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="box">
                        <a href="">
                            <div class="img-box">
                                <img src="assets/images/slider2.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                   Katalindo Medikarya Utama Pria Analog Original Anti Air R 03 Stainless Steel
                                </h6>
                                <h6>
                                    Harga
                                    <span>
                                        Rp. 250.000
                                    </span>
                                </h6>
                            </div>
                            <div class="new">
                                <span>
                                    Ready
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="ml-3">
                    <p class="text-danger">No recommendations available.</p>
                </div>
            <?php endif; ?> -->
        </div>
    </div>
</section>