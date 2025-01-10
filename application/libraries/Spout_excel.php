<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

class Spout_excel
{
    public function __construct()
    {
        // Tidak perlu memuat autoload.php lagi karena sudah dimuat di atas
    }

    public function export_excel($data, $start_date, $end_date)
    {
        // Create a new spreadsheet writer
        $writer = WriterEntityFactory::createXLSXWriter();

        // Create a temporary file to store the excel data
        $fileName = 'Laporan_Transaksi_' . date('YmdHis') . '.xlsx';
        $filePath = FCPATH . 'downloads/' . $fileName; // Simpan file di folder `downloads` di root aplikasi

        // Check if the directory exists, if not, create it
        if (!is_dir(FCPATH . 'downloads/')) {
            mkdir(FCPATH . 'downloads/', 0777, true);
        }

        // Open file for writing
        $writer->openToFile($filePath);

        // Add header informasi perusahaan
        $companyInfo = [
            'Nama Perusahaan: PT. Contoh Perusahaan',
            'Alamat: Jl. Contoh No. 123, Kota Contoh',
            'Telepon: (021) 123-4567 | Email: info@perusahaan.com'
        ];
        foreach ($companyInfo as $info) {
            $writer->addRow(WriterEntityFactory::createRowFromArray([$info]));
        }

        // Add judul laporan
        $titleRow = WriterEntityFactory::createRowFromArray(['Laporan Transaksi']);
        $writer->addRow($titleRow);

        // Add range tanggal
        $rangeDate = 'Periode: ' . date('d-m-Y', strtotime($start_date)) . ' hingga ' . date('d-m-Y', strtotime($end_date));
        $writer->addRow(WriterEntityFactory::createRowFromArray([$rangeDate]));

        // Add tanggal cetak
        $printDate = 'Tanggal Cetak: ' . date('d-m-Y H:i:s');
        $writer->addRow(WriterEntityFactory::createRowFromArray([$printDate]));

        // Add empty row untuk spacing
        $writer->addRow(WriterEntityFactory::createRowFromArray(['']));

        // Add header kolom
        $headerRow = WriterEntityFactory::createRowFromArray([
            'Kode Transaksi',
            'Tipe Bayar',
            'Status Transaksi',
            'Status Kirim',
            'Total Pembelian',
            'Tanggal Transaksi'
        ]);
        $writer->addRow($headerRow);

        // Add data rows
        foreach ($data as $row) {
            // Pastikan $row adalah array numerik
            if (is_array($row)) {
                $writer->addRow(WriterEntityFactory::createRowFromArray($row));
            }
        }

        // Add empty row untuk spacing
        $writer->addRow(WriterEntityFactory::createRowFromArray(['']));

        // Add tanda tangan dan atas nama
        $signatureRow1 = WriterEntityFactory::createRowFromArray(['Tanda Tangan:']);
        $writer->addRow($signatureRow1);

        $signatureRow2 = WriterEntityFactory::createRowFromArray(['(__________________________)']);
        $writer->addRow($signatureRow2);

        $signatureRow3 = WriterEntityFactory::createRowFromArray(['Atas Nama: John Doe']);
        $writer->addRow($signatureRow3);

        // Close the file
        $writer->close();

        return $filePath;
    }
}
