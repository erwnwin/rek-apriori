<script src="<?= base_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url() ?>assets/ajax/login.js"></script>

<!-- <script src="public/css/login.js"></script> -->
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

</html>