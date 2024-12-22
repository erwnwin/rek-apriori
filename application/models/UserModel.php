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


    // Method to check if username exists
    public function is_username_taken($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }

    // Method to check if email exists
    public function is_email_taken($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }

    // Method to check if phone number exists
    public function is_phone_taken($phone)
    {
        $this->db->where('phone', $phone);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }

    // Insert user data into the database
    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }
}


/* End of file UserModel.php */
