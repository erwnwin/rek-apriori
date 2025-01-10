<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        h3 {
            text-align: center;
            margin-top: 0;
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-info h1 {
            margin: 0;
            font-size: 24px;
        }

        .company-info p {
            margin: 5px 0;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature p {
            margin: 5px 0;
        }

        .signature-line {
            width: 200px;
            border-bottom: 1px solid black;
            margin: 0 auto;
        }

        /* CSS untuk mengulang header di setiap halaman */
        @page {
            margin-top: 150px;
            /* Sesuaikan margin atas untuk header */
        }

        .header {
            position: fixed;
            top: -100px;
            /* Sesuaikan posisi header */
            left: 0;
            right: 0;
            text-align: center;
        }

        .header h2 {
            margin-bottom: 5px;
        }

        .header h3 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <!-- Header yang akan diulang di setiap halaman -->
    <div class="header">
        <div class="company-info">
            <h1>Nama Perusahaan</h1>
            <p>Alamat: Jl. Contoh No. 123, Kota Contoh</p>
            <p>Telepon: (021) 123-4567 | Email: info@perusahaan.com</p>
        </div>
        <h2>Laporan Transaksi</h2>
        <!-- <h3>Periode: <?= date('l, d-m-Y', strtotime($start_date)) ?> hingga <?= date('l, d-m-Y', strtotime($end_date)) ?></h3> -->
    </div>

    <!-- Tabel Transaksi -->
    <table>
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Type Bayar</th>
                <th>Status Transaksi</th>
                <th>Status Kirim</th>
                <th>Total Pembelian</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $trx): ?>
                    <tr>
                        <td><?= $trx['id_transaction'] ?></td>
                        <td><?= $trx['type_bayar'] ?></td>
                        <td><?= $trx['status'] ?></td>
                        <td><?= ucfirst($trx['status_kirim']) ?></td>
                        <td class="text-right">Rp <?= number_format($trx['total_pembelian'], 0, ',', '.') ?></td>
                        <td><?= date('l, d-m-Y', strtotime($trx['tgl_transaksi'])) ?></td> <!-- Format tanggal diubah -->
                    </tr>
                <?php endforeach; ?>
                <!-- Baris Total -->
                <tr class="total-row">
                    <td colspan="4" class="text-right">Total:</td>
                    <td class="text-right">Rp <?= number_format($total_pembelian, 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Footer: Lokasi dan Tanggal Sekarang -->
    <div class="footer">
        <p>Dicetak di: Kota Contoh</p>
        <p>Tanggal: <?= date('l, d-m-Y') ?></p> <!-- Format tanggal diubah -->
    </div>

    <!-- Bagian Tanda Tangan -->
    <div class="signature">
        <p>Mengetahui,</p>
        <div class="signature-line"></div>
        <p>(__________________________)</p>
        <p>Nama: John Doe</p>
        <p>Jabatan: Manager</p>
    </div>
</body>

</html>