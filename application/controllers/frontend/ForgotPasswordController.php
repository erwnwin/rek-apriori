<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForgotPasswordController extends CI_Controller
{

    public function index()
    {
        $data['title'] = '404 Not Found';

        $this->load->view('not_found', $data);
    }
}

/* End of file ForgotPasswordController.php */
