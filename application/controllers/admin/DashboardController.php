<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('StatistikModel');

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
        $data['title'] = 'Dashboard ';


        $current_year = date('Y');
        $last_year = $current_year - 1;

        $data['current_year_sales'] = $this->StatistikModel->get_monthly_sales($current_year);
        $data['last_year_sales'] = $this->StatistikModel->get_monthly_sales($last_year);

        // Ambil data statistik penjualan
        $data['sales_statistics'] = $this->StatistikModel->get_sales_statistics();


        $data['sales_rate'] = $this->StatistikModel->get_sales_rate();
        $data['registration_rate'] = $this->StatistikModel->get_registration_rate();

        $data['total_employees'] = $this->StatistikModel->get_total_employees();
        $data['total_customers'] = $this->StatistikModel->get_total_customers();
        $data['total_publishers'] = $this->StatistikModel->get_total_publishers();
        $data['total_transactions'] = $this->StatistikModel->get_total_transactions();

        $this->load->view('backend/head', $data);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('backend/footer', $data);
    }
}

/* End of file DashboardController.php */
