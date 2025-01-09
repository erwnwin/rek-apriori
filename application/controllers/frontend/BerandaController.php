<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksModel');
        $this->load->library('encryption');
    }


    public function index()
    {
        $data['title'] = 'Beranda';


        $data['books1'] = $this->ProduksModel->get_produks_limit(8);

        foreach ($data['books1'] as $book) {
            $book->encrypted_id = $this->encrypt_id($book->id);
        }

        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_er', $data);
        $this->load->view('beranda/index', $data);
        $this->load->view('frontend/footer', $data);
    }

    private function encrypt_id($id)
    {
        $salt = "secure_salt"; // Salt rahasia
        return urlencode(base64_encode($id . '|' . $salt));
    }
}

/* End of file BerandaController.php */
