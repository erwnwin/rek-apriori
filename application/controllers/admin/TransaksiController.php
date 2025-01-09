<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel');

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
        $data['title'] = 'Transaksi ';

        // Load library pagination
        $this->load->library('pagination');

        // Konfigurasi pagination
        $config['base_url'] = base_url('transaksi'); // URL dasar pagination
        $config['page_query_string'] = TRUE; // Gunakan query string
        $config['query_string_segment'] = 'views'; // Parameter query string
        $config['per_page'] = 10; // Jumlah item per halaman
        $config['total_rows'] = $this->TransaksiModel->get_transaksi_count(); // Total data transaksi

        // Konfigurasi tampilan pagination
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

        // Inisialisasi pagination
        $this->pagination->initialize($config);

        // Ambil parameter page dari query string
        $page = $this->input->get('views');
        if (!$page) {
            $page = 0;
        }

        // Ambil data transaksi dengan limit dan offset
        $data['transaksi'] = $this->TransaksiModel->get_transaksi_history($config['per_page'], $page);

        // Tautan pagination
        $data['pagination'] = $this->pagination->create_links();
        // // $data['region'] = $this->RegionsModel->get_region();
        // $data['transaksi'] = $this->TransaksiModel->get_transaksi_history();

        $this->load->view('backend/head', $data);
        $this->load->view('backend/header', $data);
        $this->load->view('backend/sidebar', $data);
        $this->load->view('apriori/transaksi/index', $data);
        $this->load->view('backend/footer', $data);
    }


    public function filter()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $status_filter = $this->input->post('status_filter');

        $this->db->select('DISTINCT(transactions2.id_transaction), user2.first_name, user2.last_name, user2.address, date_transaction, user_account_name, user_account_number, transactions2.id_bank, date_transfer, report_transfer, transactions2.status');
        $this->db->from('transactions2');
        $this->db->join('status_transactions', 'transactions2.status = status_transactions.id', 'left');
        $this->db->join('bank', 'transactions2.id_bank = bank.id', 'left');
        $this->db->join('cart2', 'cart2.id_transaction = transactions2.id_transaction', 'left');
        $this->db->join('user2', 'cart2.id_user = user2.id', 'left');

        // Filter range tanggal
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('date_transaction >=', $start_date);
            $this->db->where('date_transaction <=', $end_date);
        }

        // Filter status
        if (!empty($status_filter)) {
            $this->db->where('transactions2.status', $status_filter);
        }

        $query = $this->db->get();
        $transactions = $query->result();

        // Generate tabel HTML
        $output = '';
        $no = 1;
        foreach ($transactions as $p) {
            $badge = '';
            switch ($p->status) {
                case '1':
                    $badge = '<span class="badge bg-primary"><i class="fas fa-money-check"></i> Payment</span>';
                    break;
                case '2':
                    $badge = '<span class="badge bg-warning"><i class="fas fa-paper-plane"></i> Confirmation</span>';
                    break;
                case '3':
                    $badge = '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Success</span>';
                    break;
                case '4':
                    $badge = '<span class="badge bg-danger"><i class="fas fa-times-circle"></i> Reject</span>';
                    break;
            }
            $output .= '<tr>
            <td>' . $no++ . '</td>
            <td>' . $p->id_transaction . '</td>
            <td>' . $p->first_name . ' ' . $p->last_name . '</td>
            <td>' . $p->address . '</td>
            <td>' . $p->date_transaction . '</td>
            <td>' . $badge . '</td>
            <td>
                <a href="' . base_url('transaksi/detail/' . $p->id_transaction) . '" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> Detail</a>
            </td>
        </tr>';
        }

        echo $output; // Kirim hasil HTML ke AJAX
    }




    public function filter_auto()
    {
        $query = $this->input->post('query'); // Ambil input pencarian

        // Query dasar
        $this->db->select('DISTINCT(transactions2.id_transaction), user2.first_name, user2.last_name, user2.address, date_transaction, user_account_name, user_account_number, transactions2.id_bank, date_transfer, report_transfer, transactions2.status');
        $this->db->from('transactions2');
        $this->db->join('status_transactions', 'transactions2.status = status_transactions.id', 'left');
        $this->db->join('bank', 'transactions2.id_bank = bank.id', 'left');
        $this->db->join('cart2', 'cart2.id_transaction = transactions2.id_transaction', 'left');
        $this->db->join('user2', 'cart2.id_user = user2.id', 'left');

        // Tambahkan filter jika ada input pencarian
        if (!empty($query)) {
            $this->db->group_start();
            $this->db->like('user2.first_name', $query);
            $this->db->or_like('user2.last_name', $query);
            $this->db->or_like('date_transaction', $query);
            $this->db->group_end();
        }

        // Urutkan data
        $this->db->order_by('transactions2.id_transaction', 'desc');

        // Eksekusi query
        $transactions = $this->db->get()->result();

        // Generate tabel HTML
        $output = '';
        $no = 1;
        foreach ($transactions as $p) {
            // Tentukan badge berdasarkan status
            $badge = '';
            switch ($p->status) {
                case '1':
                    $badge = '<span class="badge bg-primary"><i class="fas fa-money-check"></i> Payment</span>';
                    break;
                case '2':
                    $badge = '<span class="badge bg-warning"><i class="fas fa-paper-plane"></i> Confirmation</span>';
                    break;
                case '3':
                    $badge = '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Success</span>';
                    break;
                case '4':
                    $badge = '<span class="badge bg-danger"><i class="fas fa-times-circle"></i> Reject</span>';
                    break;
            }

            // Tambahkan baris tabel
            $output .= '<tr>
            <td>' . $no++ . '</td>
            <td>' . $p->id_transaction . '</td>
            <td>' . $p->first_name . ' ' . $p->last_name . '</td>
            <td>' . $p->address . '</td>
            <td>' . $p->date_transaction . '</td>
            <td>' . $badge . '</td>
            <td>
                <a href="' . base_url('transaksi/detail/' . $p->id_transaction) . '" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> Detail</a>
            </td>
        </tr>';
        }

        // Jika tidak ada data
        if (empty($output)) {
            $output = '<tr><td colspan="7" class="text-center">Tidak ada data ditemukan</td></tr>';
        }

        echo $output; // Kirim data HTML ke AJAX
    }
}

/* End of file TransaksiController.php */
