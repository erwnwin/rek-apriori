<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;


class HasilController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("beranda"));
        }

        // Cek apakah hak_akses adalah Admin atau Super Admin
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Admin" && $hak_akses != "Super Admin") {
            // Jika bukan Admin atau Super Admin, arahkan ke halaman beranda atau halaman lain
            redirect(base_url("beranda"));
        }
        $this->load->model('ExportModel');
    }

    public function index()
    {
        $data['title'] = 'Hasil ';

        // Tahap 1: Ambil Data Transaksi
        $query = $this->db->query("SELECT transaction_id, product_id, SUM(qty) as qty 
       FROM cart GROUP BY transaction_id, product_id");

        $transactions = [];
        $qty_products = [];

        // Format data transaksi dan hitung jumlah qty produk
        foreach ($query->result() as $row) {
            // Menyusun transaksi berdasarkan transaction_id
            $transactions[$row->transaction_id][] = $row->product_id;

            // Menjumlahkan qty untuk setiap product_id
            if (!isset($qty_products[$row->product_id])) {
                $qty_products[$row->product_id] = 0;
            }
            $qty_products[$row->product_id] += $row->qty;
        }


        // Tahap 3: Menghitung Support Setiap Produk
        $min_support = 2; // Support Minimum
        $product_support = [];
        $total_transactions = count($transactions);

        foreach ($qty_products as $product_id => $qty) {
            $support = $qty / $total_transactions;
            if ($support >= $min_support / $total_transactions) {
                $product_support[$product_id] = $support;
            }
        }

        // Tahap 4: Kombinasi Produk yang Lolos
        $frequent_itemsets = [];
        foreach ($transactions as $transaction) {
            $items = array_intersect($transaction, array_keys($product_support));
            $combinations = $this->generate_combinations($items);
            foreach ($combinations as $combination) {
                sort($combination);
                $key = implode(',', $combination);
                if (!isset($frequent_itemsets[$key])) {
                    $frequent_itemsets[$key] = 0;
                }
                $frequent_itemsets[$key]++;
            }
        }

        // Tahap 5: Jumlah Transaksi Tiap Kombinasi
        $pair_support = [];
        foreach ($frequent_itemsets as $pair => $count) {
            if ($count >= $min_support) {
                $pair_support[$pair] = $count;
            }
        }

        // Tahap 6: Menghitung Confidence dan Membuat Rekomendasi Produk
        $recommendations = [];
        foreach ($pair_support as $pair => $count) {
            $products = explode(',', $pair);
            foreach ($products as $product_main) {
                foreach ($products as $recommendation) {
                    if ($product_main != $recommendation) {
                        $confidence = ($count / $qty_products[$product_main]) * 100;
                        $recommendations[] = [
                            'product_main' => $product_main,
                            'recommendation' => $recommendation,
                            'confidence' => $confidence
                        ];
                    }
                }
            }
        }

        // Ambil Detail Produk
        // $product_details = [];
        // $product_ids = array_unique(array_merge(array_column($recommendations, 'product_main'), array_column($recommendations, 'recommendation')));
        // if (!empty($product_ids)) {
        //     $this->db->where_in('id', $product_ids);
        //     $product_details = $this->db->get('product')->result_array();
        // }

        $product_details = [];
        $product_ids = array_unique(array_merge(array_column($recommendations, 'product_main'), array_column($recommendations, 'recommendation')));

        if (!empty($product_ids)) {
            $this->db->where_in('id', $product_ids);
            $query = $this->db->get('product'); // Asumsikan nama tabel produk adalah 'product'

            foreach ($query->result() as $row) {
                $product_details[$row->id] = $row->name; // Map ID ke Nama Produk
            }
        }


        $recommendations_with_names = [];
        foreach ($recommendations as $recommendation) {
            $recommendations_with_names[] = [
                'product_main' => $product_details[$recommendation['product_main']] ?? 'Unknown',
                'recommendation' => $product_details[$recommendation['recommendation']] ?? 'Unknown',
                'confidence' => $recommendation['confidence']
            ];
        }


        // Kirim Data ke View
        $data['transactions'] = $transactions;
        $data['product_support'] = $product_support;
        $data['pair_support'] = $pair_support;
        $data['recommendations_with_names'] = $recommendations_with_names;
        $data['product_details'] = $product_details;

        $this->load->view('backend/head', $data);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/sidebar', $data);
        $this->load->view('apriori/hasil/index', $data);
        $this->load->view('backend/footer', $data);
    }

    private function generate_combinations($items)
    {
        $combinations = [];
        $items = array_values($items); // Reset indeks array

        $count = count($items);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $combinations[] = [$items[$i], $items[$j]];
            }
        }
        return $combinations;
    }

    public function exportToExcel()
    {
        // Data hasil tiap tahapan (pastikan data ini tersedia di controller)
        $transactions = $this->ExportModel->getTransactions(); // Contoh fungsi ExportModel
        $productSupport = $this->ExportModel->getProductSupport();
        $pairSupport = $this->ExportModel->getPairSupport();
        $recommendations = $this->ExportModel->getRecommendations();

        // Membuat file Excel
        $writer = WriterEntityFactory::createXLSXWriter();
        $filePath = 'php://output';
        $writer->openToBrowser('tahapan_apriori.xlsx'); // Output langsung ke browser

        // Tahap 1: Data Transaksi
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Tahap 1: Data Transaksi']));
        $writer->addRow(WriterEntityFactory::createRowFromArray(['ID Transaksi', 'Produk']));

        foreach ($transactions as $id_trans => $products) {
            $writer->addRow(WriterEntityFactory::createRowFromArray([$id_trans, implode(', ', $products)]));
        }

        // Spasi antar bagian
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));

        // Tahap 2: Jumlah Qty
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Tahap 2: Jumlah Qty']));
        $writer->addRow(WriterEntityFactory::createRowFromArray(['ID Produk', 'Qty']));

        foreach ($productSupport as $product_id => $support) {
            $writer->addRow(WriterEntityFactory::createRowFromArray([$product_id, round($support * count($transactions))]));
        }

        // Spasi antar bagian
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));

        // Tahap 4: Kombinasi Produk
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Tahap 4: Kombinasi Produk']));
        $writer->addRow(WriterEntityFactory::createRowFromArray(['No', 'Kombinasi Produk']));

        $no = 1;
        foreach ($pairSupport as $pair => $count) {
            $writer->addRow(WriterEntityFactory::createRowFromArray([$no++, $pair]));
        }

        // Spasi antar bagian
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));

        // Tahap 6: Confidence
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Tahap 6: Confidence']));
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Produk Utama', 'Rekomendasi', 'Confidence (%)']));

        foreach ($recommendations as $recommendation) {
            $writer->addRow(WriterEntityFactory::createRowFromArray([
                $recommendation['product_main'],
                $recommendation['recommendation'],
                number_format($recommendation['confidence'], 2)
            ]));
        }

        // Menutup file dan mengirimkan output ke browser
        $writer->close();
        exit;
    }
}

/* End of file HasilController.php */
