<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BooksController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksModel');
        $this->load->model('CartModel');
        $this->load->library('encryption');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("beranda"));
        }
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Client") {
            $this->session->sess_destroy();
            redirect(base_url('beranda'));
        }
    }


    public function index()
    {
        $data['title'] = 'Books';

        $data['books'] = $this->ProduksModel->get_produks();

        foreach ($data['books'] as $book) {
            $book->encrypted_id = $this->encrypt_id($book->id);
        }


        $this->load->view('pelanggan/template/head', $data);
        $this->load->view('pelanggan/books', $data);
        $this->load->view('pelanggan/template/footer', $data);
    }

    private function encrypt_id($id)
    {
        $salt = "secure_salt"; // Salt rahasia
        return urlencode(base64_encode($id . '|' . $salt));
    }


    public function detail($encrypted_id)
    {
        // Mendekripsi ID produk yang diterima dari URL
        $product_id = $this->decrypt_id($encrypted_id);

        if (!$product_id) {
            show_404(); // ID tidak valid
        }
        $data['product'] = $this->ProduksModel->get_product_by_id($product_id);

        if (!$data['product']) {
            show_404(); // Data produk tidak ditemukan
        }

        // Ambil data transaksi untuk algoritma Apriori
        $this->load->database();
        $this->load->library('Apriori');

        // Ambil data transaksi yang berisi produk dalam keranjang (cart2)
        $query = $this->db->query("SELECT transaction_id, GROUP_CONCAT(product_id) as products FROM cart GROUP BY transaction_id");
        $transactions = [];
        foreach ($query->result() as $row) {
            $transactions[] = explode(',', $row->products);
        }

        // Jalankan algoritma Apriori untuk mendapatkan frequent itemsets
        $min_support = 2;
        $apriori = new Apriori($transactions, $min_support);
        $frequent_itemsets = $apriori->run();

        // Cari rekomendasi produk berdasarkan produk yang diklik
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

        // Ambil produk yang direkomendasikan berdasarkan ID yang ditemukan
        if (!empty($recommendations)) {
            $this->db->where_in('id', $recommendations);
            $recommendedProducts = $this->db->get('product')->result();

            // Mengenkripsi id untuk setiap produk rekomendasi
            foreach ($recommendedProducts as $recommended) {
                $recommended->encrypted_id = $this->encrypt_id($recommended->id);
            }
        } else {
            $recommendedProducts = [];
        }

        // Kirim data ke view
        $data['recommendedProducts'] = $recommendedProducts;
        $data['title'] = 'Detail Produk';


        $this->load->view('pelanggan/template/head', $data);
        $this->load->view('pelanggan/detail', $data);
        $this->load->view('pelanggan/template/footer', $data);

        // $this->load->view('frontend/head', $data);
        // $this->load->view('frontend/header_er', $data);
        // $this->load->view('produk/detail_produks', $data);
        // $this->load->view('frontend/footer', $data);
    }


    // public function detail($encrypted_id)
    // {

    //     $product_id = $this->decrypt_id($encrypted_id);

    //     if (!$product_id) {
    //         show_404(); // ID tidak valid
    //     }

    //     $data['product'] = $this->ProduksModel->get_product_by_id($product_id);

    //     if (!$data['product']) {
    //         show_404(); // Data produk tidak ditemukan
    //     }        // $id = $this->encryption->decrypt(urldecode($id));

    //     // $data['product'] = $this->ProduksModel->get_product_by_id($id);

    //     $data['title'] = 'Detail Books';

    //     $this->load->view('pelanggan/template/head', $data);
    //     $this->load->view('pelanggan/detail', $data);
    //     $this->load->view('pelanggan/template/footer', $data);
    // }


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

/* End of file BooksController.php */
