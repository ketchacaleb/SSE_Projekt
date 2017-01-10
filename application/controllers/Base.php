<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != 1) {
            redirect(base_url() . 'index.php/welcome/login');
        }
    }
    public function welcome(){
        $this->load->view('view/head');
        $this->load->view('page_management/welcome_message');
        $this->load->view('view/footer');
    }
}