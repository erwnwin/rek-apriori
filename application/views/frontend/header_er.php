<body class="sub_page">

    <div class="hero_area">

        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container fixed-top" id="navbar">
                    <a class="navbar-brand" href="<?= base_url('beranda') ?>">
                        <img src="<?= base_url() ?>assets/img/logo_kelatra.png" alt="Logo" style="height: 40px; margin-right: 10px;">
                        <span>
                            Katalindo Medikarya Utama
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item <?= $this->uri->segment(1) == 'beranda' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= base_url('beranda') ?>" style="text-transform: capitalize;">Beranda <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?= $this->uri->segment(1) == 'produk' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= base_url('produk') ?>" style="text-transform: capitalize;"> Produk </a>
                            </li>
                            <li class=" nav-item <?= $this->uri->segment(1) == 'help' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= base_url('help') ?>" style="text-transform: capitalize;"> Help </a>
                            </li>
                        </ul>
                        <div class="user_option-box">
                            <a href="<?= base_url('cart') ?>">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <a href="<?= base_url('login') ?>">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </nav>

            </div>
        </header>
        <!-- end header section -->
    </div>