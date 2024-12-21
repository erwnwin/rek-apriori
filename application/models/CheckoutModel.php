<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CheckoutModel extends CI_Model
{

    // Fungsi untuk menghasilkan ID transaksi
    public function generateTransactionId()
    {
        // Mengambil timestamp untuk bagian dari ID unik
        $timestamp = time();
        // Menambahkan prefix untuk ID transaksi (misal 'KMU')
        $prefix = 'KMU';
        // Membuat ID transaksi yang terdiri dari prefix dan timestamp
        $transactionId = $prefix . date('ymd') . $timestamp;
        return $transactionId;
    }

    // Fungsi untuk menyimpan transaksi ke tabel transactions
    public function createTransaction($transactionData)
    {
        $this->db->insert('transactions_new', $transactionData);
    }

    // Fungsi untuk memperbarui item cart dengan ID transaksi
    public function updateCartTransactionId($item, $transactionId)
    {
        // Cek apakah item cart sudah ada untuk user dan product tertentu
        $this->db->where('user_id', $item['user_id']);
        $this->db->where('product_id', $item['product_id']);
        $cartItem = $this->db->get('cart')->row();

        if ($cartItem) {
            // Jika item cart ditemukan, update dengan transaction_id baru
            $this->db->where('id', $cartItem->id);  // Gunakan id cart item yang ada
            $this->db->update('cart', [
                'transaction_id' => $transactionId
            ]);
        } else {
            // Jika item cart tidak ditemukan, insert item baru
            $data = [
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'transaction_id' => $transactionId
            ];

            $this->db->insert('cart', $data);  // Menambahkan item baru ke cart
        }
    }
}

/* End of file CheckoutModel.php */
