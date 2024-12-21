<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                All Books
            </h2>
        </div>
        <div class="row">
            <!-- <div class="col-md-6 col-xl-3">
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
            </div> -->
            <?php foreach ($books as $b) { ?>



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


            <?php } ?>


        </div>
    </div>
</section>