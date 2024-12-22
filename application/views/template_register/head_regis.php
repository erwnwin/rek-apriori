<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register : Katalindo Medikarya Utama</title>
    <meta content="TitikBalikTeknologi - Makassar" name="Develop by Erwin, S.Kom" />

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo_kelatra.png" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/css/register.css">
    <style>
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
    </style>
</head>