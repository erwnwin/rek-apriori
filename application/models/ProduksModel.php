<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProduksModel extends CI_Model
{
    public function get_pubslihers()
    {
        $this->db->select('*');
        $this->db->from('publisher');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_produks_limit($limit)
    {
        $this->db->limit($limit); // Membatasi jumlah produk yang diambil
        $query = $this->db->get('product');
        return $query->result(); // Mengembalikan hasilnya dalam bentuk array
    }


    public function get_produks()
    {
        $this->db->select('product.*, product.name as nama_produk, publisher.name as nama_publisher');
        $this->db->from('product'); // Menentukan tabel utama
        $this->db->join('publisher', 'product.publisher_id = publisher.id', 'left');
        return $this->db->get()->result();
    }

    public function get_transaksi_count()
    {
        return $this->db->count_all('product');
    }



    public function get_products($limit, $offset)
    {
        $this->db->select('product.*, product.name as nama_produk, publisher.name as nama_publisher');
        $this->db->from('product');
        $this->db->limit($limit, $offset);
        $this->db->join('publisher', 'product.publisher_id = publisher.id', 'left');
        $this->db->order_by('product.id', 'desc');
        return $this->db->get()->result();
    }


    public function get_product_by_id($id)
    {
        $this->db->select('product.id, product.price, product.qty, product.description, product.image, product.name as nama_produk, publisher.name as nama_publisher');
        $this->db->join('publisher', 'product.publisher_id = publisher.id', 'left');
        $this->db->where('product.id', $id);

        $query = $this->db->get('product'); // Pastikan tabel sesuai
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data
        }
        return false;
    }


    public function get_product_by_id_id($productId)
    {
        return $this->db->get_where('product', ['id' => $productId])->row();
    }


    public function add_product($data)
    {
        return $this->db->insert('product', $data);
    }


    public function update_produk($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }


    public function is_used_in_cart($product_id)
    {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('cart');
        return $query->num_rows() > 0; // Return true jika data digunakan
    }

    // Hapus data produk
    public function delete_produk($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product');
    }
}

/* End of file ProduksModel.php */
