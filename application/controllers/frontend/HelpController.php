<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HelpController extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Help';

        $this->load->view('frontend/head', $data);
        $this->load->view('frontend/header_er', $data);
        $this->load->view('help/index', $data);
        $this->load->view('frontend/footer', $data);
    }
}

/* End of file HelpController.php */
