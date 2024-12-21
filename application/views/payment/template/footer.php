<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_detail">
                    <h4>
                        Tentang Kami
                    </h4>
                    <p>
                        Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
                    </p>

                </div>
            </div>
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Offline Store Kami
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Lokasi :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            <span>
                                HP/WA. 0821xxxxxxxx
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <span>
                                IG :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                            <span>
                                Youtube :
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 footer-col">
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27526.67500364611!2d119.48654453933393!3d-5.139787562051907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefdd01a7a1e75%3A0x8831aee4b19747ae!2sperintis%20kemerdekaan%2012!5e1!3m2!1sen!2sid!4v1726069488274!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="footer-info">
            <p>
                &copy; <span id="displayYear"></span> Copyright by ~ 2024
                <a href="#"><b>Titik Balik Teknologi - Makassar</b></a>
            </p>
        </div>
    </div>
</footer>
<!-- footer section -->

<script src="<?= base_url() ?>assets/frontend-ui/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="<?= base_url() ?>assets/frontend-ui/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-482qQn-QWNCrxd1D"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: '<?= base_url() ?>/snap/token', // URL untuk mendapatkan token
            cache: false,
            method: 'GET', // Metode HTTP GET untuk mengambil token
            success: function(response) {
                // Pastikan response berupa JSON
                var data = JSON.parse(response);
                var snapToken = data.token; // Ambil token dari response
                var orderId = data.order_id; // Ambil order_id dari response

                console.log('Token = ' + snapToken);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type); // Simpan jenis hasil (success, pending, error)
                    $("#result-data").val(JSON.stringify(data)); // Simpan data hasil transaksi
                }

                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        changeResult('success', result); // Transaksi berhasil
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit(); // Submit form ke server untuk update
                    },
                    onPending: function(result) {
                        changeResult('pending', result); // Transaksi menunggu
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit(); // Submit form ke server untuk update
                    },
                    onError: function(result) {
                        changeResult('error', result); // Transaksi gagal
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit(); // Submit form ke server untuk update
                    },
                    onClose: function() {
                        // User menutup pembayaran sebelum selesai
                        Swal.fire({
                            icon: 'info',
                            title: 'Lanjutkan Pembayaran',
                            text: 'Transaksi belum selesai. Anda menutup jendela pembayaran.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error); // Log jika ada error pada permintaan AJAX
                Swal.fire({
                    icon: 'error',
                    title: 'Opss!!',
                    text: 'Terjadi kesalahan tidak diduga. Mohon reload!',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.pay-button-delete').click(function() {
            // Ambil transaction_id dari data attribute tombol
            var transaction_id = $(this).data('transaction-id');

            // Kirim ke controller menggunakan AJAX atau form
            $.ajax({
                url: '<?= base_url('snap/cancelAndContinuePayment') ?>', // Ganti dengan URL yang sesuai
                type: 'POST',
                data: {
                    transaction_id: transaction_id
                },
                success: function(response) {
                    // Redirect ke halaman cart atau tampilkan pesan sukses
                    window.location.href = '<?= base_url('cart') ?>'; // Redirect ke halaman cart
                },
                error: function(xhr, status, error) {
                    // Tangani error jika ada
                    alert('Terjadi kesalahan, coba lagi nanti.');
                }
            });
        });
    });
</script>



<script>
    $(document).on('click', '.button-cek-status', function() {
        var transaction_id = $(this).data('transaction-id'); // Ambil transaction_id dari tombol

        // Kirim request AJAX untuk cek status_order
        $.ajax({
            url: '<?= base_url('snap/cekStatusOrder') ?>', // URL untuk controller yang sesuai
            type: 'POST',
            data: {
                transaction_id: transaction_id
            },
            dataType: 'json',
            success: function(response) {
                // Jika status_order ditemukan
                if (response.status_kirim === 'pending') {
                    Swal.fire({
                        title: 'Pengiriman Belum Dilakukan',
                        text: 'Order Anda belum dikirim. Silakan tunggu proses pengiriman.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                } else if (response.status_kirim === 'kirim') {
                    Swal.fire({
                        title: 'Order Telah Dikirim',
                        text: 'Order Anda telah dikirim dan sedang dalam perjalanan.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                } else if (response.status_kirim === 'selesai') {
                    Swal.fire({
                        title: 'Order Telah Diterima',
                        text: 'Terima kasih atas orderan anda.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Status Tidak Diketahui',
                        text: 'Status pengiriman tidak ditemukan.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan saat memeriksa status order.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>

<!-- <script>
    // Ketika tombol "Lanjutkan Pembayaran" diklik
    $(document).on('click', '.pay-button-delete', function() {
        var transaction_id = $(this).data('transaction-id'); // Ambil transaction_id

        $.ajax({
            url: '<?= base_url('snap/cancelAndContinuePayment') ?>', // URL yang akan memanggil method PHP
            type: 'POST',
            data: {
                transaction_id: transaction_id
            },
            dataType: 'json', // Harus json agar bisa menerima response json
            success: function(response) {
                // Jika transaksi kedaluwarsa
                if (response.status === 'expired') {
                    Swal.fire({
                        title: 'Transaksi Kedaluwarsa',
                        text: 'Transaksi ini telah kedaluwarsa, silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        // Redirect kembali ke halaman cart setelah notifikasi
                        window.location.href = '<?= base_url('cart') ?>';
                    });
                }
                // Jika transaksi berhasil
                else if (response.status === 'success') {
                    window.location.href = '<?= base_url('cart') ?>';
                }
            },
            error: function() {
                // Jika terjadi kesalahan dalam proses AJAX
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memproses transaksi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script> -->




<script type="text/javascript">
    $('.pay-button-continue').click(function(event) {
        event.preventDefault();

        var transactionId = $(this).data('transaction-id'); // Ambil transaction_id dari tombol

        $.ajax({
            url: '<?= base_url() ?>snap/resumePayment', // URL untuk request token pembayaran
            method: 'POST',
            data: {
                order_id: transactionId // Kirim order_id ke server
            },
            success: function(response) {
                var data = JSON.parse(response);

                var snapToken = data.token; // Ambil token dari response
                var orderId = data.order_id; // Ambil order_id dari response

                console.log('Token = ' + snapToken);

                function changeResult(type, data) {
                    $("#result-type").val(type); // Simpan jenis hasil (success, pending, error)
                    $("#result-data").val(JSON.stringify(data)); // Simpan data hasil transaksi
                }

                // Jika ada error dalam response, tampilkan pesan error
                if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error,
                    }).then(() => {
                        location.reload(); // Reload halaman setelah alert
                    });
                    return;
                }

                // Lakukan proses pembayaran menggunakan Snap Token
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        console.log('Pembayaran berhasil:', result);

                        // Kirimkan status pembayaran berhasil ke server
                        $.ajax({
                            url: '<?= base_url() ?>snap/updateTransactionStatus', // Endpoint untuk update status
                            method: 'POST',
                            data: {
                                order_id: transactionId,
                                status: 'settlement', // Update status transaksi menjadi 'settlement'
                                payment_result: result // Kirim hasil pembayaran
                            },
                            success: function(updateResponse) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Transaksi berhasil diperbarui!',
                                }).then(() => {
                                    location.reload(); // Reload halaman setelah transaksi berhasil
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan dalam memperbarui status transaksi.',
                                }).then(() => {
                                    location.reload(); // Reload halaman jika terjadi error
                                });
                            }
                        });
                    },
                    onPending: function(result) {
                        console.log('Pembayaran pending:', result);
                        Swal.fire({
                            icon: 'info',
                            title: 'Pending',
                            text: 'Segera lakukan pembayaran sebelum batas waktu yang ditentukan agar order anda bisa diselesaikan.',
                        }).then(() => {
                            location.reload(); // Reload halaman setelah alert
                        });
                    },
                    onError: function(result) {
                        console.log('Pembayaran gagal:', result);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Transaksi gagal, silakan coba lagi.',
                        }).then(() => {
                            location.reload(); // Reload halaman setelah alert
                        });
                    },
                    onClose: function() {
                        Swal.fire({
                            icon: 'info',
                            title: 'Lanjutkan Pembayaran',
                            text: 'Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.',
                        }).then(() => {
                            location.reload(); // Reload halaman setelah jendela Snap ditutup
                        });
                    }
                });
            },
            error: function(xhr, status, error) {
                // Menangani kesalahan jika AJAX gagal
                Swal.fire({
                    icon: 'error',
                    title: 'Opss!',
                    text: 'Terjadi kesalahan dalam proses. Silakan coba lagi nanti.',
                }).then(() => {
                    location.reload(); // Reload halaman setelah alert
                });
            },
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Ketika ada perubahan pada filter (status atau tanggal)
        $('#filter-form').on('change', function() {
            // Ambil nilai status dan tanggal filter
            var status = $('#status-filter').val();
            var date = $('#date-filter').val();

            // Kirimkan filter menggunakan AJAX
            $.ajax({
                url: '<?= base_url('history') ?>', // Ganti dengan URL yang sesuai
                type: 'GET',
                data: {
                    status: status,
                    date: date
                },
                beforeSend: function() {
                    // Tampilkan loading atau spinner jika diperlukan
                    $('#transactions-table').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
                },
                success: function(response) {
                    // Update konten table dengan hasil filter yang baru
                    $('#transactions-table').html(response);
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        });
    });
</script>



<!-- <script type="text/javascript">
    $(document).on('click', '.pay-button-continue', function(event) {
        event.preventDefault();

        var transactionId = $(this).data('transaction-id'); // Ambil transaction_id dari atribut data
        console.log('Melanjutkan pembayaran untuk transaction_id:', transactionId);

        // Kirim AJAX request untuk mendapatkan token Snap berdasarkan transaction_id
        $.ajax({
            url: '<?= base_url() ?>snap/token_continue', // Endpoint untuk mendapatkan token pembayaran
            method: 'POST', // Gunakan POST untuk mengirimkan data
            data: {
                transaction_id: transactionId
            }, // Kirim transaction_id
            success: function(response) {
                var data = JSON.parse(response);
                var snapToken = data.token; // Ambil token Snap dari respons
                var orderId = data.order_id; // Ambil order_id untuk keperluan log/debug

                console.log('Snap Token:', snapToken);
                console.log('Order ID:', orderId);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type); // Simpan jenis hasil
                    $("#result-data").val(JSON.stringify(data)); // Simpan data hasil transaksi
                }

                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        changeResult('success', result); // Transaksi berhasil
                        console.log(result.status_message);
                        console.log(result);
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil',
                            text: 'Terima kasih, pembayaran Anda telah selesai!',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload halaman untuk memperbarui status
                        });
                    },
                    onPending: function(result) {
                        changeResult('pending', result); // Transaksi menunggu
                        console.log(result.status_message);
                        console.log(result);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Menunggu Pembayaran',
                            text: 'Transaksi Anda sedang menunggu pembayaran.',
                            confirmButtonText: 'OK'
                        });
                    },
                    onError: function(result) {
                        changeResult('error', result); // Transaksi gagal
                        console.log(result.status_message);
                        console.log(result);
                        Swal.fire({
                            icon: 'error',
                            title: 'Pembayaran Gagal',
                            text: result.status_message || 'Terjadi kesalahan dalam pembayaran.',
                            confirmButtonText: 'OK'
                        });
                    },
                    onClose: function() {
                        // User menutup pembayaran sebelum selesai
                        Swal.fire({
                            icon: 'info',
                            title: 'Lanjutkan Pembayaran',
                            text: 'Transaksi belum selesai. Anda menutup jendela pembayaran.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Tidak dapat melanjutkan pembayaran. Silakan coba lagi.',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });
</script> -->



<!-- <script>
    $(document).ready(function() {
        // Event listener untuk tombol "Lanjutkan Pembayaran"
        $('.pay-button-cont').click(function(event) {
            event.preventDefault();

            // Ambil ID transaksi dari atribut data
            var transactionId = $(this).data('transaction-id');

            // AJAX request untuk mendapatkan token pembayaran
            $.ajax({
                url: '<?= base_url("snap/resumePayment") ?>', // Endpoint untuk melanjutkan pembayaran
                method: 'POST',
                data: {
                    order_id: transactionId
                }, // Kirim ID transaksi ke server
                success: function(response) {
                    console.log('Snap Token: ', response);

                    // Buka halaman Snap untuk melanjutkan pembayaran
                    snap.pay(response, {
                        onSuccess: function(result) {
                            console.log('Payment success:', result);
                            window.location.href = '<?= base_url("success") ?>'; // Arahkan ke halaman sukses
                        },
                        onPending: function(result) {
                            console.log('Payment pending:', result);
                            Swal.fire({
                                icon: 'info',
                                title: 'Transaksi Menunggu',
                                text: 'Pembayaran Anda masih menunggu konfirmasi.',
                                confirmButtonText: 'OK'
                            });
                        },
                        onError: function(result) {
                            console.log('Payment error:', result);
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.',
                                confirmButtonText: 'OK'
                            });
                        },
                        onClose: function() {
                            Swal.fire({
                                icon: 'info',
                                title: 'Lanjutkan Pembayaran',
                                text: 'Transaksi belum selesai. Anda menutup jendela pembayaran.',
                                confirmButtonText: 'OK'
                            });
                        },
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Tidak dapat melanjutkan pembayaran. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script> -->


<!-- <script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        // $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?= base_url() ?>/snap/token',
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script> -->
<script>
    function updateCartCount() {
        fetch('cart/getCartCount')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cartCount');
                cartCountElement.textContent = data.count; // Perbarui angka di badge
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>