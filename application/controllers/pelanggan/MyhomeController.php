<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MyhomeController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksModel');
        $this->load->library('encryption');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("beranda"));
        }
        // Cek apakah hak_akses adalah Admin atau Super Admin
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Client") {
            $this->session->sess_destroy();
            redirect(base_url('beranda'));
        }
    }

    private function encrypt_id($id)
    {
        $salt = "secure_salt"; // Salt rahasia
        return urlencode(base64_encode($id . '|' . $salt));
    }


    public function index()
    {
        $data['title'] = 'My Home';

        // Ambil data produk dari model
        $data['books'] = $this->ProduksModel->get_produks();

        $data['books1'] = $this->ProduksModel->get_produks_limit(3);

        // Enkripsi ID untuk setiap produk
        foreach ($data['books1'] as $book) {
            $book->encrypted_id = $this->encrypt_id($book->id);
        }

        // Enkripsi ID produk untuk setiap produk yang ada
        foreach ($data['books'] as $book) {
            $book->encrypted_id = $this->encrypt_id($book->id);
        }

        // Cek apakah ada data produk dalam keranjang pengguna
        $user_id = $this->session->userdata('user_id');
        $this->load->database();

        // Query untuk mencari produk yang sering dibeli oleh pengguna saat ini
        $this->db->select('product_id, SUM(qty) as total_qty');
        $this->db->from('cart');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 2);
        $this->db->group_by('product_id');
        $this->db->order_by('total_qty', 'DESC');
        $this->db->limit(5);
        $user_recommendations = $this->db->get()->result();

        // Jika keranjang pengguna kosong, ambil data rekomendasi dari seluruh pengguna
        if (empty($user_recommendations)) {
            $this->db->select('product_id, SUM(qty) as total_qty');
            $this->db->from('cart');
            $this->db->where('status', 2);
            $this->db->group_by('product_id');
            $this->db->order_by('total_qty', 'DESC');
            $this->db->limit(5);
            $user_recommendations = $this->db->get()->result();
        }

        // Ambil ID produk yang sering dibeli
        $recommended_product_ids = [];
        foreach ($user_recommendations as $recommend) {
            $recommended_product_ids[] = $recommend->product_id;
        }

        // Ambil produk yang direkomendasikan berdasarkan id produk yang sudah didapatkan
        if (!empty($recommended_product_ids)) {
            $this->db->where_in('id', $recommended_product_ids);
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

        $this->load->view('pelanggan/template/head', $data);
        $this->load->view('pelanggan/myhome', $data);
        $this->load->view('pelanggan/template/footer', $data);
    }
}

/* End of file MyhomeController.php */
