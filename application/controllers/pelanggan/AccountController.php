<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
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
        $data['title'] = 'My Account';

        $this->load->view('pelanggan/template/head', $data);
        $this->load->view('pelanggan/account', $data);
        $this->load->view('pelanggan/template/footer', $data);
    }
}

/* End of file AccountController.php */
