<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RecommendationModel extends CI_Model
{
    public function get_product_detail($product_id)
    {
        return $this->db->get_where('cart2', ['id' => $product_id])->row_array();
    }

    public function get_transactions_by_product($product_id)
    {
        // Ambil semua transaksi yang mencakup produk yang dipilih
        $this->db->select('id_transaction, id_product');
        $this->db->from('cart2');
        $this->db->where('id_product', $product_id);
        return $this->db->get()->result_array();
    }

    public function get_recommended_products($product_id, $min_support = 2)
    {
        // Ambil semua transaksi
        $this->db->select('id_transaction, id_product');
        $this->db->from('cart2');
        $transactions = $this->db->get()->result_array();

        // Format data transaksi
        $transaction_data = [];
        foreach ($transactions as $row) {
            $transaction_data[$row['id_transaction']][] = $row['id_product'];
        }

        // Jalankan algoritma Apriori
        $this->load->library('Apriori', [$transaction_data, $min_support]);
        $frequent_itemsets = $this->apriori->generate_frequent_itemsets();

        // Cari produk terkait dengan produk yang dipilih
        $recommended_products = [];
        foreach ($frequent_itemsets as $itemset) {
            if (array_key_exists($product_id, $itemset)) {
                $recommended_products = array_keys($itemset);
                break;
            }
        }

        return array_diff($recommended_products, [$product_id]); // Hilangkan produk yang dipilih
    }
}

/* End of file Recommen.php */
