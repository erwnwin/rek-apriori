<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> : Katalindo Medikarya Utama </title>

    <meta content="WinArtCode" name="Develop by Erwin, S.Kom" />

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/logo/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/logo/logo_kelatra.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/logo/logo_kelatra.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/select2-custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/upload.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/modal.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/avatar.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/pagination.css">
    <style>
        html {
            font-size: .9rem !important;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .blink {
            animation: blink 1s ease-in-out;
        }
    </style>
    <style>
        .alert-custom hr {
            border-top: 1.5px solid #ffffff;
            /* Warna garis pemisah */
        }

        .card-successku {
            background-color: #a2e1b8;
            color: rgb(0, 0, 0);
            border: none;
        }

        .card-successku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-primaryku {
            background-color: rgb(95, 176, 216);
            color: rgb(0, 0, 0);
            border: none;
        }

        .card-primaryku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-dangerku {
            background-color: #ffcccc;
            color: rgb(0, 0, 0);
            border: none;
        }

        .card-dangerku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-infoku {
            background-color: rgb(123, 229, 255);
            color: rgb(0, 0, 0);
            /* Warna teks */
            border: none;
        }

        .card-infoku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-warningku {
            background-color: rgb(253, 255, 151);
            color: rgb(0, 0, 0);
            border: none;
        }

        .card-warningku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-secondaryku {
            background-color: #39cccc;
            color: rgb(0, 0, 0);
            border: none;
        }

        .card-secondaryku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }



        .btn-tool {
            color: black;
        }

        .card-aprioriku .card-body {
            background-color: #ffffff !important;
            color: #000000;
            border: none;
        }

        .card-aprioriku {
            background-color: #3c8dbc;
            color: #ffffff;
            border: none;
        }
    </style>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">