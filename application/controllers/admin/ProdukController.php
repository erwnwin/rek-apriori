<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProdukController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProduksModel');
        // $this->load->model('AprioriModel');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("beranda"));
        }

        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Admin" && $hak_akses != "Super Admin") {
            redirect(base_url("beranda"));
        }
    }


    public function index()
    {
        $data['title'] = 'Produks ';

        $data['publisher'] = $this->ProduksModel->get_pubslihers();
        // $data['product'] = $this->ProduksModel->get_produks();

        $this->load->library('pagination');

        $config['base_url'] = base_url('produks');
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'record';
        $config['per_page'] = 10;
        $config['total_rows'] = $this->ProduksModel->get_transaksi_count();

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $page = $this->input->get('record');
        if (!$page) {
            $page = 0;
        }
        $data['product'] = $this->ProduksModel->get_products($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/head', $data);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/sidebar', $data);
        $this->load->view('produk/produks', $data);
        $this->load->view('backend/footer', $data);
    }
}

/* End of file ProdukController.php */
