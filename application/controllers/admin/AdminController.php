<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
    }


    public function index() {}
}

/* End of file AdminController.php */
