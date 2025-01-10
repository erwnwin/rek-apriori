<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ExportController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ExportModel');
        $this->load->library('encryption');
        $this->load->library('Spout_excel');
    }


    public function index() {}

    // public function export_pdf()
    // {
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
    //     $status_filter = $this->input->post('status_filter');

    //     // Ambil data berdasarkan filter
    //     $data = $this->transaksi_model->get_filtered_data($start_date, $end_date, $status_filter);

    //     // Load library MPDF
    //     $this->load->library('pdf');

    //     // Generate PDF
    //     $html = $this->load->view('transaksi/pdf_template', ['data' => $data], true);
    //     $this->pdf->WriteHTML($html);
    //     $this->pdf->Output('filtered_transactions.pdf', 'D');
    // }



    public function export_pdf()
    {
        $this->load->library('dompdf_gen');

        // Ambil data dari POST (bukan GET)
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $status_filter = $this->input->post('status_filter');


        // if (empty($start_date) || empty($end_date)) {
        //     $start_date = date('Y-m-01'); // Tanggal awal bulan ini
        //     $end_date = date('Y-m-t');   // Tanggal akhir bulan ini
        // }

        // Ambil data dari model
        $data['transaksi'] = $this->ExportModel->get_filtered_data($start_date, $end_date, $status_filter);

        // Hitung total pembelian
        $data['total_pembelian'] = array_sum(array_column($data['transaksi'], 'total_pembelian'));

        // Load view HTML
        $html = $this->load->view('export/transaksi_pdf', $data, true);

        // Load library Dompdf
        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->set_paper('A4', 'portrait');
        $this->dompdf_gen->render();

        // Output PDF ke browser
        $this->dompdf_gen->stream("transaksi_report.pdf", array('Attachment' => 0));
    }




    public function export_excel()
    {
        // Ambil range tanggal dan status filter dari input POST
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $status_filter = $this->input->post('status_filter');

        // Validasi dan format tanggal
        if ($start_date && $end_date) {
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
        } else {
            // Jika tanggal tidak diisi, gunakan tanggal hari ini
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }

        // Ambil data transaksi berdasarkan range tanggal dan status filter
        $transaksi = $this->ExportModel->get_filtered_data($start_date, $end_date, $status_filter);

        // Siapkan data untuk Excel
        $data = [];
        if (!empty($transaksi)) {
            $total_keseluruhan = 0; // Inisialisasi total keseluruhan
            foreach ($transaksi as $trx) {
                $data[] = [
                    $trx['id_transaction'], // Kode Transaksi
                    $trx['type_bayar'], // Tipe Bayar
                    $trx['status'], // Status Transaksi
                    ucfirst($trx['status_kirim']), // Status Kirim (dikonversi ke huruf kapital di awal)
                    'Rp ' . number_format($trx['total_pembelian'], 0, ',', '.'), // Total Pembelian (diformat ke Rupiah)
                    date('d-m-Y', strtotime($trx['tgl_transaksi'])) // Tanggal Transaksi (diformat ke dd-mm-yyyy)
                ];
                $total_keseluruhan += $trx['total_pembelian']; // Tambahkan ke total keseluruhan
            }

            // Tambahkan baris total keseluruhan
            $data[] = [
                '', // Kolom Kode Transaksi kosong
                '', // Kolom Tipe Bayar kosong
                '', // Kolom Status Transaksi kosong
                'Total Keseluruhan:', // Label Total Keseluruhan
                'Rp ' . number_format($total_keseluruhan, 0, ',', '.'), // Total Keseluruhan (diformat ke Rupiah)
                '' // Kolom Tanggal Transaksi kosong
            ];
        } else {
            // Jika tidak ada data, tambahkan baris "Tidak ada data"
            $data[] = ['', '', '', 'Tidak ada data', '', ''];
        }

        // Export data ke Excel
        $filePath = $this->spout_excel->export_excel($data, $start_date, $end_date);

        // Set headers dan force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);

        // Hapus file setelah di-download
        unlink($filePath);
        exit; // Pastikan tidak ada output lain setelah file di-download
    }

    // public function export_excel()
    // {
    //     // Ambil data dari POST
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
    //     $status_filter = $this->input->post('status_filter');

    //     // Validasi dan format tanggal
    //     if (empty($start_date) || empty($end_date)) {
    //         $start_date = date('Y-m-01'); // Tanggal awal bulan ini
    //         $end_date = date('Y-m-t');   // Tanggal akhir bulan ini
    //     } else {
    //         $start_date = date('Y-m-d', strtotime($start_date));
    //         $end_date = date('Y-m-d', strtotime($end_date));
    //     }

    //     // Load model dan ambil data transaksi berdasarkan filter
    //     $this->load->model('ExportModel');
    //     $transaksi = $this->ExportModel->get_filtered_data($start_date, $end_date, $status_filter);

    //     // Siapkan data untuk Excel
    //     $data = [];
    //     if (!empty($transaksi)) {
    //         $total_keseluruhan = 0; // Inisialisasi total keseluruhan
    //         foreach ($transaksi as $trx) {
    //             $data[] = [
    //                 $trx['kode_transaksi'], // Kode Transaksi
    //                 $trx['status_transaksi'], // Status Transaksi
    //                 'Rp ' . number_format($trx['total_payment'], 0, ',', '.'), // Total Payment (diformat ke Rupiah)
    //                 $trx['tgl_transaksi'] // Tanggal Transaksi
    //             ];
    //             $total_keseluruhan += $trx['total_payment']; // Tambahkan ke total keseluruhan
    //         }

    //         // Tambahkan baris total keseluruhan
    //         $data[] = [
    //             '', // Kolom Kode Transaksi kosong
    //             'Total Keseluruhan:', // Label Total Keseluruhan
    //             'Rp ' . number_format($total_keseluruhan, 0, ',', '.'), // Total Keseluruhan (diformat ke Rupiah)
    //             '' // Kolom Tanggal Transaksi kosong
    //         ];
    //     } else {
    //         // Jika tidak ada data, tambahkan baris "Tidak ada data"
    //         $data[] = ['', '', 'Tidak ada data', ''];
    //     }

    //     // Load library PHPExcel
    //     $this->load->library('excel');

    //     // Buat objek PHPExcel
    //     $objPHPExcel = new PHPExcel();

    //     // Set sheet aktif
    //     $sheet = $objPHPExcel->getActiveSheet();

    //     // Tambahkan judul laporan
    //     $sheet->setCellValue('A1', 'Laporan Transaksi');
    //     $sheet->mergeCells('A1:D1'); // Merge cell dari A1 hingga D1

    //     // Tambahkan range tanggal
    //     $rangeDate = 'Periode: ' . date('d-m-Y', strtotime($start_date)) . ' hingga ' . date('d-m-Y', strtotime($end_date));
    //     $sheet->setCellValue('A2', $rangeDate);
    //     $sheet->mergeCells('A2:D2'); // Merge cell dari A2 hingga D2

    //     // Tambahkan filter status
    //     $statusFilterText = 'Filter Status: ' . ($status_filter ? $status_filter : 'Semua Status');
    //     $sheet->setCellValue('A3', $statusFilterText);
    //     $sheet->mergeCells('A3:D3'); // Merge cell dari A3 hingga D3

    //     // Tambahkan tanggal cetak
    //     $printDate = 'Tanggal Cetak: ' . date('d-m-Y H:i:s');
    //     $sheet->setCellValue('A4', $printDate);
    //     $sheet->mergeCells('A4:D4'); // Merge cell dari A4 hingga D4

    //     // Tambahkan baris kosong untuk jarak
    //     $sheet->setCellValue('A6', ''); // Baris kosong

    //     // Tambahkan header kolom
    //     $header = ['Kode Transaksi', 'Status Transaksi', 'Total Pembelian', 'Tanggal Transaksi'];
    //     $sheet->fromArray($header, null, 'A7'); // Mulai dari baris 7

    //     // Tambahkan data transaksi
    //     $row = 8; // Mulai dari baris 8
    //     foreach ($data as $item) {
    //         $sheet->fromArray($item, null, 'A' . $row);
    //         $row++;
    //     }

    //     // Atur lebar kolom otomatis
    //     foreach (range('A', 'D') as $column) {
    //         $sheet->getColumnDimension($column)->setAutoSize(true);
    //     }

    //     // Simpan file Excel
    //     $filename = 'laporan_transaksi_' . date('YmdHis') . '.xlsx';
    //     $filePath = FCPATH . 'downloads/' . $filename;

    //     // Pastikan folder downloads ada
    //     if (!is_dir(FCPATH . 'downloads/')) {
    //         mkdir(FCPATH . 'downloads/', 0777, true);
    //     }

    //     // Simpan file ke server
    //     $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $writer->save($filePath);

    //     // Set headers dan force download
    //     header('Content-Description: File Transfer');
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . filesize($filePath));
    //     readfile($filePath);

    //     // Hapus file setelah di-download
    //     unlink($filePath);
    //     exit; // Pastikan tidak ada output lain setelah file di-download
    // }

    // public function export_excel()
    // {
    //     // Load library PhpSpreadsheet
    //     $this->load->library('PhpSpreadsheet');

    //     // Ambil data dari POST (bukan GET)
    //     $start_date = $this->input->post('start_date');
    //     $end_date = $this->input->post('end_date');
    //     $status_filter = $this->input->post('status_filter');

    //     // Jika tanggal kosong, set default ke bulan ini
    //     if (empty($start_date) || empty($end_date)) {
    //         $start_date = date('Y-m-01'); // Tanggal awal bulan ini
    //         $end_date = date('Y-m-t');   // Tanggal akhir bulan ini
    //     }

    //     // Ambil data dari model
    //     $transaksi = $this->ExportModel->get_filtered_data($start_date, $end_date, $status_filter);

    //     // Hitung total pembelian
    //     $total_pembelian = array_sum(array_column($transaksi, 'total_pembelian'));

    //     // Siapkan data untuk diekspor
    //     $data = [
    //         'transaksi' => $transaksi,
    //         'total_pembelian' => $total_pembelian,
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'status_filter' => $status_filter,
    //     ];

    //     // Export to Excel
    //     $filename = 'laporan_transaksi_' . date('Ymd_His') . '.xlsx';
    //     $this->phpspreadsheet->exportExcel($data, $filename);
    // }
}

/* End of file ExportController.php */
