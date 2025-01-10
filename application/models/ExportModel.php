<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ExportModel extends CI_Model
{
    // Mengambil data transaksi
    public function getTransactions()
    {
        $query = $this->db->select('transaction_id, GROUP_CONCAT(product_id) as produk')
            ->group_by('transaction_id')
            ->get('cart');
        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->transaction_id] = explode(',', $row->produk);
        }
        return $result;
    }

    // Menghitung support tiap produk
    public function getProductSupport()
    {
        $query = $this->db->select('product_id, COUNT(*) as qty')
            ->group_by('product_id')
            ->get('cart');
        $totalTransactions = $this->db->count_all('cart');

        $support = [];
        foreach ($query->result() as $row) {
            $support[$row->product_id] = $row->qty / $totalTransactions;
        }
        return $support;
    }

    // Menghitung support pasangan produk
    public function getPairSupport()
    {
        $transactions = $this->getTransactions();
        $pairCounts = [];
        foreach ($transactions as $products) {
            $pairs = $this->generatePairs($products);
            foreach ($pairs as $pair) {
                sort($pair); // Pastikan pasangan selalu dalam urutan yang sama
                $key = implode(',', $pair);
                if (!isset($pairCounts[$key])) {
                    $pairCounts[$key] = 0;
                }
                $pairCounts[$key]++;
            }
        }
        return $pairCounts;
    }

    // Menghasilkan pasangan produk
    private function generatePairs($products)
    {
        $pairs = [];
        $count = count($products);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $pairs[] = [$products[$i], $products[$j]];
            }
        }
        return $pairs;
    }

    // Menghitung rekomendasi dengan confidence
    public function getRecommendations()
    {
        $pairSupport = $this->getPairSupport();
        $productSupport = $this->getProductSupport();
        $recommendations = [];

        foreach ($pairSupport as $pair => $count) {
            list($productA, $productB) = explode(',', $pair);
            $confidence = $count / (isset($productSupport[$productA]) ? $productSupport[$productA] * count($this->getTransactions()) : 1);
            if ($confidence >= 0.5) { // Atur minimum confidence
                $recommendations[] = [
                    'product_main' => $productA,
                    'recommendation' => $productB,
                    'confidence' => $confidence * 100,
                ];
            }
        }
        return $recommendations;
    }



    public function get_filtered_data($start_date, $end_date, $status_filter)
    {
        // Mulai query builder
        $this->db->select('
            DISTINCT(transactions_new.id_transaction),
            transactions_new.type_bayar,
            transactions_new.total_pembelian,
            transactions_new.tgl_transaksi,
            transactions_new.status,
            transactions_new.status_kirim
        ');
        $this->db->from('transactions_new');
        $this->db->join('status_transactions', 'transactions_new.status = status_transactions.id', 'left');
        $this->db->join('cart', 'cart.transaction_id = transactions_new.id_transaction', 'left');
        $this->db->join('user', 'cart.user_id = user.id', 'left');

        // Filter berdasarkan tanggal jika ada
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('DATE(tgl_transaksi) >=', $start_date);
            $this->db->where('DATE(tgl_transaksi) <=', $end_date);
        }

        // Filter berdasarkan status jika ada
        if (!empty($status_filter)) {
            $this->db->where('status_kirim', $status_filter);
        }

        // Eksekusi query
        $query = $this->db->get();

        // Kembalikan hasil query
        return $query->result_array();
    }
}

/* End of file ExportModel.php */
