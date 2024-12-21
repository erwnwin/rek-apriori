<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Beranda';

        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_er', $data);
        $this->load->view('beranda/index', $data);
        $this->load->view('frontend/footer', $data);
    }
}

/* End of file BerandaController.php */
