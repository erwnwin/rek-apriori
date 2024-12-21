<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RekomendasiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AprioriModel');
        $this->load->model('ProduksModel');
        $this->load->model('RecommendationModel');
    }

    // Menampilkan halaman detail produk beserta rekomendasi produk terkait
    public function detail($product_id)
    {
        // Load required model
        // Fetch product details
        $product = $this->ProduksModel->get_product_by_id($product_id);

        // Get recommendations based on the Apriori algorithm
        $recommended_products = $this->RecommendationModel->get_recommended_products($product_id);

        // Pass data to view
        $data = [
            'product' => $product,
            'recommended_products' => $recommended_products
        ];

        // Load view

        // Menampilkan view detail produk beserta rekomendasi produk
        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_new', $data);
        $this->load->view('produk/detail_product_view', $data);
        $this->load->view('frontend/footer', $data);
        // $this->load->view('produkdetail_product_view', $data);
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

    private function encrypt_id($id)
    {
        $salt = "secure_salt"; // Salt rahasia
        return urlencode(base64_encode($id . '|' . $salt));
    }
}
