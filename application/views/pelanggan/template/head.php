<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="Modified by Erwins" />
    <meta name="author" content="Erwins" />

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo_kelatra.png" />

    <title>Katalindo Medikarya Utama | <?= $title; ?></title>


    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend-ui/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@1.0.1/css/themify-icons.css">
    <link href="<?= base_url() ?>assets/frontend-ui/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/frontend-ui/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/frontend-ui/css/responsive.css" rel="stylesheet" />
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">



    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            background-color: rgb(230, 234, 238);
        }

        .navbar-nav .nav-link {
            text-transform: capitalize;
        }

        /* Full-page overlay */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Layar gelap */
            z-index: 9999;
            /* Pastikan menutupi elemen lainnya */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Loading bar container */
        #loading-bar {
            width: 50%;
            height: 2px;
            background-color: #fff;
            position: relative;
            overflow: hidden;
            border-radius: 1px;
        }

        /* Animasi garis bergerak */
        #loading-bar::before {
            content: '';
            position: absolute;
            width: 20%;
            height: 100%;
            background-color: #0a3a53;
            animation: loading-animation 2s infinite;
        }

        /* Animasi loading */
        @keyframes loading-animation {
            0% {
                left: -20%;
            }

            50% {
                left: 50%;
            }

            100% {
                left: 100%;
            }
        }

        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: #007bff;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary {
            border-radius: 50px;
            /* Membuat tombol menjadi rounded */
            border: 1.6px solidrgb(17, 59, 104);
            /* Warna border biru */
            color: rgb(50, 102, 157);
            /* Warna teks biru */
            background-color: transparent;
            /* Latar belakang transparan */
            padding: 10px 20px;
            /* Padding tombol */
            font-size: 14px;
            /* Ukuran font */
        }

        .btn-outline-primary:hover {
            background-color: rgb(36, 57, 78);
            /* Efek hover, mengubah latar belakang */
            color: white;
            /* Mengubah warna teks saat hover */
        }

        .btn-primary {
            border-radius: 50px;
            /* Membuat tombol menjadi rounded */
            border: 1.6px solidrgb(17, 59, 104);
            /* Warna border biru */
            /* Warna teks biru */
            background-color: rgb(50, 102, 157);
            /* Latar belakang transparan */
            padding: 10px 20px;
            /* Padding tombol */
            font-size: 14px;
            /* Ukuran font */
        }

        .btn-primary:hover {
            background-color: rgb(36, 57, 78);
            /* Efek hover, mengubah latar belakang */
            color: white;
            /* Mengubah warna teks saat hover */
        }

        #cartCount {
            font-size: 12px;
            padding: 0.2em 0.5em;
        }

        /* Make the navbar take up full width with extra padding */
        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            /* Transparent background */
            padding: 10px 50px;
            /* Adds padding to left and right, increasing navbar width */
            transition: background-color 0.3s, backdrop-filter 0.3s;
            /* Smooth transition */
        }

        /* Add space between logo and user icons */
        .navbar .navbar-brand {
            margin-right: 20px;
            /* Adjust this value for more spacing */
        }

        /* Add space between the user icons and right edge */
        .navbar .user_option-box a {
            margin-left: 15px;
            /* Adds space between each icon */
        }

        /* When scrolling, apply a blur and darker background */
        .navbar.scrolled {
            background-color: rgba(193, 189, 189, 0.7);
            /* Darker background */
            backdrop-filter: blur(5px);
            /* Apply blur effect */
        }

        /* Optional: Make sure navbar stays on top */
        .fixed-top {
            z-index: 1030;
        }

        /* Adjustments for responsive design */
        @media (max-width: 992px) {
            .navbar {
                padding: 10px 20px;
                /* Reduce padding on smaller screens */
            }

            .navbar-brand {
                margin-right: 10px;
                /* Reduce spacing for logo */
            }

            .user_option-box a {
                margin-left: 10px;
                /* Reduce spacing for icons */
            }
        }
    </style>

</head>

<!-- <div id="loading-overlay">
    <div id="loading-bar"></div>
</div> -->

<body class="sub_page">

    <div class="hero_area">

        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">

                <nav class="navbar navbar-expand-lg custom_nav-container fixed-top" id="navbar">
                    <a class="navbar-brand" href="<?= base_url('myhome') ?>">
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
                            <li class="nav-item <?= $this->uri->segment(1) == 'myhome' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= base_url('myhome') ?>" style="text-transform: capitalize;">Beranda <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?= $this->uri->segment(1) == 'books' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= base_url('books') ?>" style="text-transform: capitalize;"> All Books </a>
                            </li>
                            <!-- <li class=" nav-item">
                                <a class="nav-link" href="<?= base_url('help') ?>"> Help </a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="index.php?ref=cart"> Cart </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?ref=auth">Login / Register</a> -->
                            </li>
                        </ul>
                        <div class="user_option-box">
                            <a href="<?= base_url('cart') ?>" class="position-relative">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white"></span>
                            </a>

                            <!-- <a href="<?= base_url('cart') ?>" class="position-relative">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white">
                                    <?= $cartCount ?>
                                </span>
                            </a> -->


                            <a href="<?= base_url('account') ?>" style="text-transform: capitalize;">
                                <i class="fa fa-user" aria-hidden="true"></i> | <?=
                                                                                $this->session->userdata('first_name');
                                                                                ?> <?=
                                                                                    $this->session->userdata('last_name');
                                                                                    ?>
                            </a>
                            <a href="<?= base_url('logout') ?>" style="text-transform: capitalize;">
                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                            </a>
                        </div>

                    </div>
                </nav>



            </div>
        </header>
        <!-- end header section -->
    </div>