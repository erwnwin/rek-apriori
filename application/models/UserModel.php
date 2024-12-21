<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    function auth_pengguna($username, $password)
    {
        $query = $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1 ");
        return $query;
    }

    public function getUserById($user_id)
    {
        return $this->db->where('id', $user_id)->get('user')->row();
        // $this->db->select('*');
        // $this->db->from('cart');
        // $this->db->where('user.id', $user_id);
        // return $this->db->get()->result();
    }
}


/* End of file UserModel.php */
