<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AprioriModel extends CI_Model
{

    // Ambil detail produk berdasarkan ID
    public function get_product_details($product_id)
    {
        $this->db->where('id', $product_id);
        $query = $this->db->get('product');
        return $query->row();
    }

    // Ambil semua transaksi yang berisi produk tertentu
    public function get_transactions_by_product($product_id)
    {
        $this->db->select('c.id_transaction, c.id_product');
        $this->db->from('cart2 c');
        $this->db->where('c.id_product', $product_id);
        $this->db->join('transactions t', 't.id_transaction = c.id_transaction');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Ambil rekomendasi berdasarkan aturan asosiasi
    public function get_recommendations($product_ids)
    {
        $this->db->select('consequent');
        $this->db->from('association_rules');
        $this->db->where_in('antecedent', $product_ids);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_transactions()
    {
        $this->db->select('id_transaction, GROUP_CONCAT(id_product ORDER BY id_product) AS product');
        $this->db->from('cart2');
        $this->db->group_by('id_transaction');
        $query = $this->db->get();
        return $query->result_array(); // Mengambil data transaksi dalam bentuk array
    }
}
