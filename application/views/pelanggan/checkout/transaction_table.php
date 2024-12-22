<?php if (!empty($transactions)) : ?>
    <table class="table table-bordered table-hover table-sm">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Total Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $index => $transaction) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $transaction->id_transaction ?></td>
                    <td>Rp <?= number_format($transaction->total_pembelian, 0, ',', '.') ?></td>
                    <td>
                        <span class="badge text-white <?= $transaction->status === 'pending' ? 'bg-danger' : 'bg-success' ?>">
                            <?= ucfirst($transaction->status) ?>
                        </span> |
                        <span class="">
                            <small>
                                <?php
                                // Tentukan kalimat berdasarkan status_kirim
                                if ($transaction->status_kirim === 'pending') { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13" height="13"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M256 8C119 8 8 119 8 256S119 504 256 504 504 393 504 256 393 8 256 8zm92.5 313h0l-20 25a16 16 0 0 1 -22.5 2.5h0l-67-49.7a40 40 0 0 1 -15-31.2V112a16 16 0 0 1 16-16h32a16 16 0 0 1 16 16V256l58 42.5A16 16 0 0 1 348.5 321z" />
                                    </svg> Belum Dikemas
                                <?php  } elseif ($transaction->status_kirim === 'kirim') { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="13" height="13"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z" />
                                    </svg> Sedang Dikirim
                                <?php } elseif ($transaction->status_kirim === 'selesai') { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="13" height="13"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M488 192H336v56c0 39.7-32.3 72-72 72s-72-32.3-72-72V126.4l-64.9 39C107.8 176.9 96 197.8 96 220.2v47.3l-80 46.2C.7 322.5-4.6 342.1 4.3 357.4l80 138.6c8.8 15.3 28.4 20.5 43.7 11.7L231.4 448H368c35.3 0 64-28.7 64-64h16c17.7 0 32-14.3 32-32v-64h8c13.3 0 24-10.7 24-24v-48c0-13.3-10.7-24-24-24zm147.7-37.4L555.7 16C546.9 .7 527.3-4.5 512 4.3L408.6 64H306.4c-12 0-23.7 3.4-33.9 9.7L239 94.6c-9.4 5.8-15 16.1-15 27.1V248c0 22.1 17.9 40 40 40s40-17.9 40-40v-88h184c30.9 0 56 25.1 56 56v28.5l80-46.2c15.3-8.9 20.5-28.4 11.7-43.7z" />
                                    </svg> Telah Terima
                                <?php } else { ?>
                                    echo 'Status Tidak Diketahui';
                                <?php    }
                                ?>
                            </small>
                        </span>

                    </td>
                    <td>
                        <?php if ($transaction->status === 'pending') : ?>
                            <button
                                class="btn btn-primary btn-xs btn-sm pay-button-continue"
                                data-transaction-id="<?= $transaction->id_transaction ?>">
                                Lanjutkan Pembayaran
                            </button>
                        <?php else : ?>
                            <div class="btn-group" role="group" aria-label="Button group">
                                <button type="button" class="btn btn-secondary btn-sm me-2">
                                    Download Invoice
                                </button>

                                <button class="btn btn-info btn-sm button-cek-status" data-transaction-id="<?= $transaction->id_transaction ?>">
                                    Cek Status Order
                                </button>
                            </div>

                            <!-- <form action="" method="post">
                                                <button type="button" class="btn btn-secondary btn-sm">Download Invoice</button>
                                            </form>
                                            <button
                                                class="btn btn-info btn-xs btn-sm pay-button-delete"
                                                data-transaction-id="<?= $transaction->id_transaction ?>">
                                                Cek Status Order
                                            </button> -->
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <center>
        <img src="<?= base_url('assets/img/no-data.png') ?>" alt="" width="30%">
    </center>
<?php endif; ?>


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