<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        if ($this->session->userdata('status') == 'login') {
            // Jika sudah login, arahkan ke halaman utama (misalnya dashboard)
            redirect(base_url('dashboard'));
        } elseif ($this->session->userdata('hak_akses') == 'Client') {
            redirect(base_url('myhome'));
        }
    }

    public function index()
    {
        $data['title'] = 'Login';

        $this->load->view('template_login/head_login', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('template_login/footer_login', $data);
    }


    public function proses_login()
    {
        // Ambil data username dan password dari request POST
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Username atau password tidak boleh kosong.']);
            return;
        }

        // Periksa user di database
        $cek_user = $this->UserModel->auth_pengguna($username, $password);

        if ($cek_user->num_rows() > 0) {
            $data = $cek_user->row_array();

            // Set session sesuai dengan hak akses
            $this->session->set_userdata('status', 'login');
            $this->session->set_userdata('username', $data['username']);
            $this->session->set_userdata('email', $data['email']);
            $this->session->set_userdata('first_name', $data['first_name']);
            $this->session->set_userdata('last_name', $data['last_name']);
            $this->session->set_userdata('user_id', $data['id']);

            // Tentukan level hak akses
            if ($data['type_user_id'] == 1) {
                $this->session->set_userdata('hak_akses', 'Super Admin');
                echo json_encode(['success' => true, 'redirect' => base_url('dashboard')]);
            } elseif ($data['type_user_id'] == 2) {
                $this->session->set_userdata('hak_akses', 'Admin');
                echo json_encode(['success' => true, 'redirect' => base_url('dashboard')]);
            } elseif ($data['type_user_id'] == 3) {
                $this->session->set_userdata('hak_akses', 'Client');
                echo json_encode(['success' => true, 'redirect' => base_url('myhome')]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Hak akses tidak valid.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Username atau password salah.']);
        }
    }
}

/* End of file LoginController.php */
