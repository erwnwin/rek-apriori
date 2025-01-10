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
                                <div class="btn-box">
                                    <a href="<?= base_url('register') ?>" class="btn1">
                                        <i class="fa fa-send" aria-hidden="true"></i> Buruan Daftar!!
                                    </a>
                                </div>
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
                                    Welcome to Katalindo Medikarya Utama
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>
                                <div class="btn-box">
                                    <a href="<?= base_url('register') ?>" class="btn1">
                                        <i class="fa fa-send" aria-hidden="true"></i> Buruan Daftar!!
                                    </a>
                                </div>
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
                                    Welcome to Katalindo Medikarya Utama
                                </h1>
                                <p>
                                    Tersedia berbagai macam buku berkualitas, original dan harga terjangkau
                                    <br><br>Ayoooo!! Buruan order produk kami dengan klik tombol Buruan Daftar dan Nikmati transaksi pembelian di KATALINDO MEDIKARYA UTAMA.
                                </p>
                                <div class="btn-box">
                                    <a href="<?= base_url('register') ?>" class="btn1">
                                        <i class="fa fa-send" aria-hidden="true"></i> Buruan Daftar!!
                                    </a>
                                </div>
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
                Produk yang Kami Tawarkan
            </h2>
        </div>
        <div class="row">
            <?php foreach ($books1 as $book): ?>
                <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="box">
                        <a href="<?= base_url('produk/detail/' . $book->encrypted_id); ?>">
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
        <?php if (count($books1) > 0): ?>
            <div class="btn-box mb-5">
                <a href="<?= base_url('produk') ?>">Lihat Semua</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- end shop section -->

<!-- about section -->

<section class="about_section layout_padding">
    <div class="container  ">
        <div class="row">
            <div class="col-md-6 col-lg-5">
                <div class="img-box">
                    <dotlottie-player src="https://lottie.host/0c97eeb9-aac5-4646-b2ad-c4f7e0a3da4e/GGPyO6qut4.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                </div>
            </div>

            <div class="col-md-6 col-lg-7">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            Tentang Produk
                        </h2>
                    </div>
                    <p>
                        Temukan koleksi buku berkualitas yang akan memperkaya wawasan dan memenuhi kebutuhan bacaan Anda.
                    </p>
                    <a href="">
                        Baca Selengkapnya
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->

<!-- feature section -->

<!-- <section class="feature_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Features Of Our Watches
        </h2>
        <p>
          Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="assets/images/f1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Fitness Tracking
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                   Baca Selengkapnya
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="assets/images/f2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Alerts & Notifications
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                   Baca Selengkapnya
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="assets/images/f3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Messages
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                   Baca Selengkapnya
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="assets/images/f4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Bluetooth
              </h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              </p>
              <a href="">
                <span>
                  Baca Selengkapnya
                </span>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          Lihat Semua
        </a>
      </div>
    </div>
  </section> -->

<!-- end feature section -->
<div>
    <br>
    <br>
</div>
<!-- contact section -->

<section class="contact_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <div class="heading_container">
                        <h2>
                            Hubungi Kami
                        </h2>
                    </div>
                    <form action="">
                        <div>
                            <input type="text" placeholder="Full Name " />
                        </div>
                        <div>
                            <input type="email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" placeholder="Phone number" />
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message" />
                        </div>
                        <div class="d-flex">
                            <button>
                                KIRIM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-box" style="margin-top: 20px;">
                    <dotlottie-player
                        src="https://lottie.host/3b0a98b2-7f07-4362-8577-639309254905/se6tBJwxOU.lottie"
                        background="transparent"
                        speed="1"
                        style="width: 550px; height: 550px;"
                        loop
                        autoplay>
                    </dotlottie-player>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- end contact section -->

<div>
    <br>
</div>