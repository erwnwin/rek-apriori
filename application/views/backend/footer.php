<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        Anything you want
    </div>
    <strong>Copyright &copy; 2022-<?php echo date('Y'); ?> <a href="">Titik Balik Teknologi</a>.</strong>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script src="<?= base_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url() ?>public/assets/dist/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>public/assets/js/add-notif.js"></script>
<!-- <script src="<?= base_url() ?>public/assets/js/notifikasi.js"></script> -->
<script src="<?= base_url() ?>public/assets/js/upload.js"></script>
<script src="<?= base_url() ?>public/assets/js/jadwalku.js"></script>
<script src="<?= base_url() ?>public/assets/js/edit-guru.js"></script>
<script src="<?= base_url() ?>public/assets/js/add-guru.js"></script>
<script src="<?= base_url() ?>public/assets/js/filter-mapel.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>public/assets/dist/js/pages/dashboard3.js"></script>
<!-- <script src="<?= base_url() ?>public/assets/js/edit-kelas.js"></script> -->
<!-- <script src="<?= base_url() ?>public/assets/js/drag.js"></script> -->
<!-- <script src="<?= base_url() ?>public/assets/js/update-kategori.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
    $(document).ready(function() {
        $('#search_input').on('keyup', function() {
            let search_query = $(this).val();

            // Kirim permintaan AJAX
            $.ajax({
                url: '<?= base_url("transaksi/filter-name") ?>', // Ubah URL sesuai controller Anda
                method: 'POST',
                data: {
                    query: search_query
                },
                success: function(data) {
                    $('#transaction_table').html(data); // Update tabel dengan hasil pencarian
                },
                error: function() {
                    console.error('Gagal mengambil data');
                },
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Fungsi untuk memuat data berdasarkan filter
        function loadFilteredData() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var statusFilter = $('#status_filter').val();

            $.ajax({
                url: "<?= base_url('transaksi/filter') ?>", // Endpoint untuk filter
                type: "POST",
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    status_filter: statusFilter,
                    csrf_token_name: "<?= $this->security->get_csrf_hash(); ?>" // CSRF token
                },
                success: function(response) {
                    $('tbody').html(response); // Ganti isi tabel dengan hasil dari server
                }
            });
        }

        // Event listener untuk input tanggal dan status
        $('#start_date, #end_date, #status_filter').on('change', function() {
            loadFilteredData();
        });
    });
</script>



<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>

<script>
    // Fungsi untuk menampilkan notifikasi Toast dengan pesan kustom
    function showToast(message, icon = 'success') {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
        });

        Toast.fire({
            icon: icon,
            title: message
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada flashdata untuk 'sukses'
        <?php if ($this->session->flashdata('sukses')): ?>
            var successMessage = <?php echo json_encode($this->session->flashdata('sukses')); ?>;
            showToast(successMessage);
        <?php endif; ?>


        <?php if ($this->session->flashdata('edit')): ?>
            var successMessage = <?php echo json_encode($this->session->flashdata('edit')); ?>;
            showToast(successMessage);
        <?php endif; ?>


        <?php if ($this->session->flashdata('gagal')): ?>
            var successMessage = <?php echo json_encode($this->session->flashdata('gagal')); ?>;
            showToast(successMessage);
        <?php endif; ?>


        // Cek jika ada flashdata untuk 'error'
        <?php if ($this->session->flashdata('error')): ?>
            var errorMessage = <?php echo json_encode($this->session->flashdata('error')); ?>;
            showToast(errorMessage, 'error');
        <?php endif; ?>


    });
</script>





</body>

</html>