<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RegionsModel extends CI_Model
{
    public function get_region()
    {
        $this->db->select('*');
        $this->db->from('region');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_banks()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file RegionsModel.php */
