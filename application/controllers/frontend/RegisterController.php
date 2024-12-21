<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Register';

        $this->load->view('template_register/head_regis', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('template_register/footer_regis', $data);
    }
}

/* End of file RegisterController.php */
