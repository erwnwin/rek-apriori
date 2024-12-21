<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AprioriController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel');
        $this->load->library('Apriori');
        // $this->load->library('Apriorinew');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("beranda"));
        }

        // Cek apakah hak_akses adalah Admin atau Super Admin
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Admin" && $hak_akses != "Super Admin") {
            // Jika bukan Admin atau Super Admin, arahkan ke halaman beranda atau halaman lain
            redirect(base_url("beranda"));
        }
    }


    public function index()
    {
        $data['title'] = 'Proses Apriori ';

        // Tahap 1: Ambil Data Transaksi
        $query = $this->db->query("SELECT id_transaction, id_product, SUM(qty) as qty FROM cart2 GROUP BY id_transaction, id_product");

        $transactions = [];
        $qty_products = [];

        // Format data transaksi dan hitung jumlah qty produk
        foreach ($query->result() as $row) {
            // Menyusun transaksi berdasarkan id_transaction
            $transactions[$row->id_transaction][] = $row->id_product;

            // Menjumlahkan qty untuk setiap id_product
            if (!isset($qty_products[$row->id_product])) {
                $qty_products[$row->id_product] = 0;
            }
            $qty_products[$row->id_product] += $row->qty;
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

        $product_details = [];
        $product_ids = array_unique(array_merge(array_column($recommendations, 'product_main'), array_column($recommendations, 'recommendation')));

        if (!empty($product_ids)) {
            $this->db->where_in('id', $product_ids);
            $query = $this->db->get('product'); // Asumsikan nama tabel adalah 'product'

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $product_details[$row->id] = $row->id . ' - ' . $row->name; // Format "id - name_product"
                }
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
        $this->load->view('apriori/proses/index', $data);
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
}

/* End of file AprioriController.php */
