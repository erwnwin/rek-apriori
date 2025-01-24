<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
    public function get_transaksi()
    {
        $this->db->select('cart.id, product_id, product.image, product.name, cart.qty, product.price');
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_id = product.id', 'left');
        $this->db->join('user', 'cart.user_id = user.id', 'left');
        $this->db->join('region', 'cart.region_id = region.id', 'left');
        $this->db->join('bank', 'cart.bank_id = bank.id', 'left');
        $this->db->join('transactions', 'cart.transaction_id = transactions.id', 'left');
        $this->db->join('status_cart', 'cart.status = status_cart.id', 'left');
        $this->db->where('cart.status', 5);
        return $this->db->get()->result();
    }

    public function get_transaksi_count()
    {
        return $this->db->count_all('transactions_new');
    }

    public function get_transaksi_history($limit, $offset)
    {
        $this->db->select('DISTINCT(transactions_new.id_transaction), user.first_name, user.last_name, user.address, tgl_transaksi, transactions_new.status, transactions_new.status_kirim', false);
        $this->db->from('transactions_new');
        $this->db->limit($limit, $offset);
        $this->db->join('status_transactions', 'transactions_new.status = status_transactions.id', 'left');
        $this->db->join('cart', 'cart.transaction_id = transactions_new.id_transaction', 'left');
        $this->db->join('user', 'cart.user_id = user.id', 'left');
        $this->db->order_by('transactions_new.id_transaction', 'desc');
        return $this->db->get()->result();
    }


    public function get_customers()
    {
        return $this->db->get('user')->result();
    }

    // Ambil data produk dari tabel products
    public function get_products()
    {
        return $this->db->get('product')->result();
    }


    public function insert_transaction($data)
    {
        $this->db->insert('transactions_new', $data);
    }

    // Insert batch data ke tabel cart
    public function insert_batch_cart($data)
    {
        $this->db->insert_batch('cart', $data);
    }

    // old query ku
    // public function get_transaksi_history($limit, $offset)
    // {
    //     $this->db->select('DISTINCT(transactions_new.id_transaction), user.first_name, user.last_name, user.address, tgl_transaksi, user_account_name, user_account_number, transactions_new.id_bank, date_transfer, report_transfer, transactions_new.status', false);
    //     $this->db->from('transactions_new');
    //     $this->db->limit($limit, $offset);
    //     $this->db->join('status_transactions', 'transactions_new.status = status_transactions.id', 'left');
    //     $this->db->join('bank', 'transactions_new.id_bank = bank.id', 'left');
    //     $this->db->join('cart', 'cart.id_transaction = transactions_new.id_transaction', 'left');
    //     $this->db->join('user', 'cart.user_id = user.id', 'left');
    //     $this->db->order_by('transactions_new.id_transaction', 'desc');
    //     return $this->db->get()->result();
    // }
}

/* End of file TransaksiModel.php */
