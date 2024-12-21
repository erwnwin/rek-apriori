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
                                class="btn btn-primary btn-xs btn-sm pay-button-delete"
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
    <div class="alert alert-info text-center">
        Tidak ada transaksi yang ditemukan.
    </div>
<?php endif; ?>