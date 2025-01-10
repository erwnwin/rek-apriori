<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <style>
        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: "Arvo", serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {
            margin-top: 40px;
            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: rgb(24, 71, 86);
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }
    </style>
</head>

<body>

    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <center>
                                <h1 class="text-center " style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">*Sorry Yee!!#</h1>
                            </center>
                            <br>
                            <br>
                        </div>

                        <center>
                            <div class="contant_box_404">
                                <h3 class="h2" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                                    Halaman ini masih dalam tahap Develop
                                </h3>

                                <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">the page you are looking for not avaible!</p>

                                <a href="<?= base_url('beranda') ?>" class="link_404" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Kembali ke Beranda</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Menangani tombol keyboard seperti F12 dan Ctrl+Shift+I
        document.addEventListener('keydown', function(event) {
            // Deteksi apakah tombol F12 atau Ctrl+Shift+I ditekan
            if ((event.key === 'F12') ||
                (event.ctrlKey && event.shiftKey && event.key === 'I')) {
                event.preventDefault(); // Mencegah aksi default (membuka DevTools)
                alert('Developer Tools tidak diizinkan!');
            }
        });

        // Menangani tombol klik kanan (contextmenu)
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault(); // Mencegah menu klik kanan
            alert('Klik kanan tidak diizinkan!');
        });

        // Cegah F12 dan Inspect dari shortcut browser
        (function() {
            let devtools = /./;
            devtools.toString = function() {
                this.open = true;
            };
            setInterval(function() {
                if (devtools.open) {
                    alert('Developer Tools tidak diizinkan!');
                    devtools.open = false; // Reset deteksi
                }
            }, 1000);
        })();
    </script>
</body>

</html>