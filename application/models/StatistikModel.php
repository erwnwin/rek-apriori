<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StatistikModel extends CI_Model
{
    public function get_sales_statistics()
    {
        // Total penjualan bulan ini
        $this->db->select_sum('total_pembelian');
        $this->db->where('YEAR(tgl_transaksi)', date('Y'));
        $this->db->where('MONTH(tgl_transaksi)', date('m'));
        $current_month_sales = $this->db->get('transactions_new')->row()->total_pembelian;

        // Total penjualan bulan sebelumnya
        $this->db->select_sum('total_pembelian');
        $this->db->where('YEAR(tgl_transaksi)', date('Y', strtotime('-1 month')));
        $this->db->where('MONTH(tgl_transaksi)', date('m', strtotime('-1 month')));
        $last_month_sales = $this->db->get('transactions_new')->row()->total_pembelian;

        // Hitung persentase kenaikan/penurunan
        $percentage_change = 0;
        if ($last_month_sales > 0) {
            $percentage_change = (($current_month_sales - $last_month_sales) / $last_month_sales) * 100;
        }

        return [
            'current_month_sales' => $current_month_sales,
            'last_month_sales' => $last_month_sales,
            'percentage_change' => $percentage_change,
        ];
    }


    public function get_monthly_sales($year)
    {
        $this->db->select('MONTH(tgl_transaksi) as month, SUM(total_pembelian) as total_sales');
        $this->db->where('YEAR(tgl_transaksi)', $year);
        $this->db->group_by('MONTH(tgl_transaksi)');
        $query = $this->db->get('transactions_new');
        return $query->result_array();
    }



    public function get_sales_rate()
    {
        $current_month_sales = $this->db->select_sum('total_pembelian')
            ->where('YEAR(tgl_transaksi)', date('Y'))
            ->where('MONTH(tgl_transaksi)', date('m'))
            ->get('transactions_new')
            ->row()->total_pembelian;

        $last_month_sales = $this->db->select_sum('total_pembelian')
            ->where('YEAR(tgl_transaksi)', date('Y', strtotime('-1 month')))
            ->where('MONTH(tgl_transaksi)', date('m', strtotime('-1 month')))
            ->get('transactions_new')
            ->row()->total_pembelian;

        if ($last_month_sales > 0) {
            return (($current_month_sales - $last_month_sales) / $last_month_sales) * 100;
        } else {
            return 0;
        }
    }

    // Hitung Registration Rate
    public function get_registration_rate()
    {
        $current_month_registrations = $this->db->where('YEAR(create_at)', date('Y'))
            ->where('MONTH(create_at)', date('m'))
            ->count_all_results('user');

        $last_month_registrations = $this->db->where('YEAR(create_at)', date('Y', strtotime('-1 month')))
            ->where('MONTH(create_at)', date('m', strtotime('-1 month')))
            ->count_all_results('user');

        if ($last_month_registrations > 0) {
            return (($current_month_registrations - $last_month_registrations) / $last_month_registrations) * 100;
        } else {
            return 0;
        }
    }



    public function get_total_publishers()
    {
        return $this->db->count_all('publisher'); // Ganti 'publishers' dengan nama tabel yang sesuai
    }

    // Hitung jumlah transaksi
    public function get_total_transactions()
    {
        return $this->db->count_all('transactions_new'); // Ganti 'transactions' dengan nama tabel yang sesuai
    }


    public function get_total_employees()
    {
        $this->db->where('type_user_id !=', 3); // Ambil semua user yang bukan customers
        return $this->db->count_all_results('user'); // Hitung jumlahnya
    }

    // Hitung jumlah customers (type_user_id = 3)
    public function get_total_customers()
    {
        $this->db->where('type_user_id', 3); // Ambil hanya customers
        return $this->db->count_all_results('user'); // Hitung jumlahnya
    }
}

/* End of file StatistikModel.php */
