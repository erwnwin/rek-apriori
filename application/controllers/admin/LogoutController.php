<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LogoutController extends CI_Controller
{

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('beranda'));
    }
}

/* End of file LogoutController.php */
