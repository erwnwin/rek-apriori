<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProfilController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        
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
        $data['title'] = 'Profile Account ';

        $user_id = $this->session->userdata('user_id');

        // Ambil data pelanggan dari model
        $data['user'] = $this->UserModel->get_user_by_id($user_id);

        $this->load->view('backend/head', $data);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/sidebar', $data);
        $this->load->view('profil/admin_account', $data);
        $this->load->view('backend/footer', $data);
    }
}

/* End of file ProfilController.php */
