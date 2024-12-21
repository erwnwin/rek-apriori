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
                                    Welcome!
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="assets/images/sliderkuu.png" alt="">
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
                                    Jam Tangan
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="assets/images/sliderkuu.png" alt="">
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
                                    Jam Tangan
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="img-box">
                                <img src="assets/images/sliderkuu.png" alt="">
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
            <div class="col-md-6 ">
                <div class="box">
                    <a href="">
                        <div class="img-box">
                            <img src="assets/images/jam6.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                                DIGITEC SMART WATCH Jam Tangan Unisex Digital RUNNER SERIES Touchscreen
                            </h6>
                            <h6>
                                Harga
                                <span>
                                    Rp. 659.340
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
            <div class="col-sm-6 col-xl-3">
                <div class="box">
                    <a href="">
                        <div class="img-box">
                            <img src="assets/images/slider2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                                Jam Tangan Pria Analog Original Anti Air R 03 Stainless Steel
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

        </div>
        <div class="btn-box mb-5">
            <a href="<?= base_url('books') ?>">
                Lihat Semua
            </a>
        </div>
        <hr>
        <!-- Rekomendasi Beli -->
        <div class="heading_container heading_center mt-5 ">
            <h2>
                <span class="badge bg-danger text-white">Rekomendasi</span> <span class="badge bg-success text-white">Untuk Anda</span>
            </h2>
        </div>
        <div class="row">
            <?php if (!empty($recommendedProducts)): ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="box">
                        <a href="">
                            <div class="img-box">
                                <img src="assets/images/slider2.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    Jam Tangan Pria Analog Original Anti Air R 03 Stainless Steel
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
            <?php endif; ?>
        </div>
    </div>
</section>