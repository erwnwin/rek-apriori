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
        return $this->db->count_all('transactions2');
    }

    public function get_transaksi_history($limit, $offset)
    {
        $this->db->select('DISTINCT(transactions2.id_transaction), user2.first_name, user2.last_name, user2.address, date_transaction, user_account_name, user_account_number, transactions2.id_bank, date_transfer, report_transfer, transactions2.status', false);
        $this->db->from('transactions2');
        $this->db->limit($limit, $offset);
        $this->db->join('status_transactions', 'transactions2.status = status_transactions.id', 'left');
        $this->db->join('bank', 'transactions2.id_bank = bank.id', 'left');
        $this->db->join('cart2', 'cart2.id_transaction = transactions2.id_transaction', 'left');
        $this->db->join('user2', 'cart2.id_user = user2.id', 'left');
        $this->db->order_by('transactions2.id_transaction', 'desc');
        return $this->db->get()->result();
    }
}

/* End of file TransaksiModel.php */
