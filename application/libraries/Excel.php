<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
require_once APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

class Excel extends PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ekspor data transaksi ke Excel
     *
     * @param array $data Data transaksi
     * @param string $start_date Tanggal awal
     * @param string $end_date Tanggal akhir
     * @param string $filename Nama file output
     * @return void
     */
    public function export_transaksi($data, $start_date, $end_date, $filename = 'laporan_transaksi.xlsx')
    {
        // Buat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        // Set sheet aktif
        $sheet = $objPHPExcel->getActiveSheet();

        // Tambahkan informasi perusahaan
        $sheet->setCellValue('A1', 'Nama Perusahaan: PT. Contoh Perusahaan');
        $sheet->mergeCells('A1:F1'); // Merge cell dari A1 hingga F1
        $sheet->setCellValue('A2', 'Alamat: Jl. Contoh No. 123, Kota Contoh');
        $sheet->mergeCells('A2:F2'); // Merge cell dari A2 hingga F2
        $sheet->setCellValue('A3', 'Telepon: (021) 123-4567 | Email: info@perusahaan.com');
        $sheet->mergeCells('A3:F3'); // Merge cell dari A3 hingga F3

        // Tambahkan judul laporan
        $sheet->setCellValue('A5', 'Laporan Transaksi');
        $sheet->mergeCells('A5:F5'); // Merge cell dari A5 hingga F5

        // Tambahkan range tanggal
        $rangeDate = 'Periode: ' . date('d-m-Y', strtotime($start_date)) . ' hingga ' . date('d-m-Y', strtotime($end_date));
        $sheet->setCellValue('A6', $rangeDate);
        $sheet->mergeCells('A6:F6'); // Merge cell dari A6 hingga F6

        // Tambahkan tanggal cetak
        $printDate = 'Tanggal Cetak: ' . date('d-m-Y H:i:s');
        $sheet->setCellValue('A7', $printDate);
        $sheet->mergeCells('A7:F7'); // Merge cell dari A7 hingga F7

        // Tambahkan baris kosong untuk jarak
        $sheet->setCellValue('A9', ''); // Baris kosong

        // Tambahkan header kolom
        $header = ['Kode Transaksi', 'Tipe Bayar', 'Status Transaksi', 'Status Kirim', 'Total Pembelian', 'Tanggal Transaksi'];
        $sheet->fromArray($header, null, 'A10'); // Mulai dari baris 10

        // Tambahkan data transaksi
        $row = 11; // Mulai dari baris 11
        foreach ($data as $item) {
            $sheet->fromArray($item, null, 'A' . $row);
            $row++;
        }

        // Tambahkan baris kosong untuk jarak
        $sheet->setCellValue('A' . ($row + 1), ''); // Baris kosong

        // Tambahkan tanda tangan
        $sheet->setCellValue('A' . ($row + 2), 'Tanda Tangan:');
        $sheet->mergeCells('A' . ($row + 2) . ':F' . ($row + 2)); // Merge cell
        $sheet->setCellValue('A' . ($row + 3), '(__________________________)');
        $sheet->mergeCells('A' . ($row + 3) . ':F' . ($row + 3)); // Merge cell
        $sheet->setCellValue('A' . ($row + 4), 'Atas Nama: John Doe');
        $sheet->mergeCells('A' . ($row + 4) . ':F' . ($row + 4)); // Merge cell

        // Atur lebar kolom otomatis
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Simpan file Excel
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
