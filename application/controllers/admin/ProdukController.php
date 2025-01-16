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


    public function act()
    {
        // Validasi form
        $this->form_validation->set_rules('name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('publisher_id', 'Publisher', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('produks'));
        } else {
            // Konfigurasi upload gambar
            $config['upload_path'] = './public/image/product/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                // Jika upload gagal, kembalikan ke form dengan pesan error
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect(base_url('produks'));
            } else {
                // Jika upload berhasil, simpan data ke database
                $data = $this->input->post();
                $data['image'] = $this->upload->data('file_name'); // Simpan nama file gambar

                $this->ProduksModel->add_product($data);
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
                redirect(base_url('produks'));
            }
        }
    }


    public function update()
    {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'publisher_id' => $this->input->post('publisher_id'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty')
        );

        // Handle file upload jika ada gambar baru
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/image/product/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            }
        }

        $this->ProduksModel->update_produk($id, $data);
        $this->session->set_flashdata('success', 'Produk berhasil diupdate.');
        redirect(base_url('produks'));
    }



    // Method untuk cek apakah data digunakan di tabel lain
    public function check_delete()
    {
        $id = $this->input->post('id');
        $is_used = $this->ProduksModel->is_used_in_cart($id);

        if ($is_used) {
            echo 'used'; // Data digunakan di tabel lain
        } else {
            echo 'not_used'; // Data tidak digunakan
        }
    }

    // Method untuk menghapus data
    public function delete()
    {
        $id = $this->input->post('id');
        $is_used = $this->ProduksModel->is_used_in_cart($id);

        if ($is_used) {
            // Jika data digunakan di tabel lain, tampilkan pesan error
            $this->session->set_flashdata('error', 'Data tidak dapat dihapus karena digunakan di tabel lain.');
        } else {
            // Jika data tidak digunakan, hapus data
            $this->ProduksModel->delete_produk($id);
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        }

        redirect('produks');
    }
}

/* End of file ProdukController.php */
