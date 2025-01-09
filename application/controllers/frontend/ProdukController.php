<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProdukController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksModel');
        $this->load->model('AprioriModel');
        $this->load->model('RecommendationModel');
    }


    public function index()
    {
        $data['title'] = 'Produk';
        $data['books'] = $this->ProduksModel->get_produks();

        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_er', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('frontend/footer', $data);
    }


    public function detail($encrypted_id)
    {
        // Mendekripsi ID produk yang diterima dari URL
        $product_id = $this->decrypt_id($encrypted_id);

        $data['title'] = 'Detail Produk';

        $this->load->database();
        $this->load->library('Apriori');

        // Ambil data transaksi
        $query = $this->db->query("SELECT transaction_id, GROUP_CONCAT(product_id) as products FROM cart GROUP BY transaction_id");
        $transactions = [];
        foreach ($query->result() as $row) {
            $transactions[] = explode(',', $row->products);
        }

        // Jalankan algoritma Apriori
        $min_support = 2;
        $apriori = new Apriori($transactions, $min_support);
        $frequent_itemsets = $apriori->run();

        // Cari rekomendasi berdasarkan produk yang diklik
        $recommendations = [];
        foreach ($frequent_itemsets as $itemset) {
            if (in_array($product_id, $itemset)) {
                foreach ($itemset as $item) {
                    if ($item != $product_id && !in_array($item, $recommendations)) {
                        $recommendations[] = $item;
                    }
                }
            }
        }

        // Ambil detail produk utama
        $product = $this->db->get_where('product', ['id' => $product_id])->row();

        // Ambil detail produk rekomendasi
        if (!empty($recommendations)) {
            $this->db->where_in('id', $recommendations);
            $recommendedProducts = $this->db->get('product')->result();
        } else {
            $recommendedProducts = [];
        }

        // Kirim data ke view
        $data['product'] = $product;
        $data['recommendedProducts'] = $recommendedProducts;

        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_er', $data);
        $this->load->view('produk/detail_produks', $data);
        $this->load->view('frontend/footer', $data);
    }


    private function decrypt_id($encrypted_id)
    {
        $salt = "secure_salt"; // Salt rahasia
        $decoded = base64_decode(urldecode($encrypted_id));

        if (strpos($decoded, '|') === false) {
            return false; // Format tidak sesuai
        }

        list($id, $decoded_salt) = explode('|', $decoded);

        return ($decoded_salt === $salt) ? $id : false; // Validasi salt
    }
}

/* End of file ProdukController.php */
