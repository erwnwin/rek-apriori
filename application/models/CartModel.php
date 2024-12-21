<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CartModel extends CI_Model
{
    public function addToCart($userId, $productId, $qty)
    {
        // Cek apakah produk sudah ada di keranjang dengan status 1 (belum checkout)
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);
        $this->db->where('status', 1); // Status 1 berarti produk ada di keranjang dan belum checkout
        $query = $this->db->get('cart');

        if ($query->num_rows() > 0) {
            // Update qty jika produk sudah ada di keranjang dan statusnya masih 1
            $this->db->set('qty', 'qty + ' . (int)$qty, FALSE);
            $this->db->where('user_id', $userId);
            $this->db->where('product_id', $productId);
            $this->db->where('status', 1);
            return $this->db->update('cart');
        } else {
            // Cek apakah produk sudah ada di keranjang dengan status 2 (sudah checkout)
            $this->db->where('user_id', $userId);
            $this->db->where('product_id', $productId);
            $this->db->where('status', 2); // Produk sudah checkout
            $query2 = $this->db->get('cart');

            if ($query2->num_rows() > 0) {
                // Jika produk sudah ada di keranjang dengan status 2 (sudah checkout),
                // biarkan produk tersebut tetap ada, dan masukkan produk baru dengan product_id yang sama
                $data = [
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'status' => 1, // Status 1 berarti belum checkout
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                return $this->db->insert('cart', $data); // Masukkan produk baru dengan status 1
            } else {
                // Insert produk baru ke keranjang jika produk belum ada di keranjang
                $data = [
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'status' => 1, // Status 1 berarti belum checkout
                    'timestamp' => date('Y-m-d H:i:s')
                ];
                return $this->db->insert('cart', $data); // Masukkan produk baru dengan status 1
            }
        }
    }

    public function getCartItemByStatus($userId, $productId, $status)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);
        $this->db->where('status', $status);
        return $this->db->get('cart')->row();
    }




    public function updateCartItem($cartItemId, $qty)
    {
        $this->db->where('id', $cartItemId);
        $this->db->update('cart', ['qty' => $qty]);
    }

    public function getCartItem($userId, $productId)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);
        $query = $this->db->get('cart');
        return $query->row();
    }

    public function getCartItemCount($userId)
    {
        $this->db->select_sum('qty');
        $this->db->where('user_id', $userId);
        $this->db->where('status', 1); // Status 0 berarti belum checkout
        $query = $this->db->get('cart');
        return $query->row()->qty ?? "";
    }

    public function getCartByUserId($user_id)
    {
        $this->db->select('cart.id, product_id, product.image, product.name, cart.status, cart.qty, price');
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_id = product.id', 'left');
        $this->db->where('cart.user_id', $user_id); // Filter berdasarkan id_login
        $this->db->where('cart.status', 1); // Hanya yang belum checkout
        return $this->db->get()->result();
    }


    public function getCartByUserId2($user_id)
    {
        $this->db->select('cart.id, product_id, product.image, product.name, cart.status, cart.qty, price');
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_id = product.id', 'left');
        $this->db->where('cart.user_id', $user_id); // Filter berdasarkan id_login
        $this->db->where('cart.status', 1); // Hanya yang belum checkout
        return $this->db->get()->result();
    }

    public function deleteCartItem($cartId)
    {

        $this->db->where('id', $cartId);
        $deleted = $this->db->delete('cart');
        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }


    public function update_cart_quantity($user_id, $product_id, $qty, $status)
    {
        // Update kuantitas di database
        $this->db->set('qty', $qty);
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $this->db->where('status', $status);
        return $this->db->update('cart');
    }


    public function get_cart_by_user($user_id)
    {
        $this->db->select('cart.product_id, cart.qty, product.price, product.name');
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_id = product.id');
        $this->db->join('user', 'cart.user_id = user.id');
        $this->db->where('cart.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }


    public function getPendingTransactionsByUserId($user_id)
    {
        // Ambil semua transaksi yang statusnya 'pending' atau 'settlement' untuk pengguna dengan user_id tertentu
        $this->db->where('user_id', $user_id);
        $this->db->group_start(); // Memulai grup untuk kondisi OR
        $this->db->where('status', 'settlement');
        $this->db->or_where('status', 'pending'); // Menggunakan OR
        $this->db->group_end(); // Menutup grup kondisi OR
        $query = $this->db->get('transactions_new');

        return $query->result();  // Kembalikan hasilnya dalam bentuk array objek
    }


    public function getTransactionsByFilters($user_id, $status = NULL, $date = NULL)
    {
        // Mulai query untuk mengambil transaksi berdasarkan user_id
        $this->db->where('user_id', $user_id);

        // Filter berdasarkan status jika ada
        if ($status) {
            $this->db->where('status', $status);
        }

        // Filter berdasarkan tanggal jika ada
        if ($date) {
            $this->db->where('DATE(tgl_transaksi)', $date); // Asumsi 'created_at' adalah kolom tanggal
        }

        // Ambil transaksi yang sesuai
        $query = $this->db->get('transactions_new');  // Pastikan tabel sesuai dengan yang Anda pakai

        return $query->result(); // Kembalikan hasil transaksi
    }



    public function getCartByUserIdAndTransaction($user_id, $id_transaction)
    {
        $this->db->select('cart.id, cart.product_id, product.name, cart.status, cart.qty, product.price');
        $this->db->from('cart');
        $this->db->join('product', 'cart.product_id = product.id', 'left');
        $this->db->where('cart.user_id', $user_id); // Filter berdasarkan user_id
        $this->db->where('cart.status', 2); // Hanya yang belum checkout
        $this->db->where('cart.transaction_id', $id_transaction); // Menyaring berdasarkan id_transaction
        return $this->db->get()->result();
    }
}

/* End of file CartModel.php */
