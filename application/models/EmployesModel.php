<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EmployesModel extends CI_Model
{

    public function get_employes()
    {
        $this->db->select('user.*, user.first_name,  type_user.name as role');
        $this->db->from('user'); // Menentukan tabel utama
        $this->db->join('type_user', 'user.type_user_id = type_user.id', 'left');
        $this->db->where_in('user.type_user_id', [1, 2]);
        return $this->db->get()->result();
    }
}

/* End of file EmployesModel.php */
