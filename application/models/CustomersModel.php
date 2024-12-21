<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomersModel extends CI_Model
{
    public function get_customers()
    {
        $this->db->select('user.*, user.first_name,  type_user.name as role');
        $this->db->from('user'); // Menentukan tabel utama
        $this->db->join('type_user', 'user.type_user_id = type_user.id', 'left');
        $this->db->where('user.type_user_id', '3');
        return $this->db->get()->result();
    }
}

/* End of file CustomersModel.php */
