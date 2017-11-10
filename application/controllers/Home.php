<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
//        $this->load->model('fetch');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
//        $this->session_check();
    }

    public function index() {
        $this->load->view('user/template/header');
        $this->load->view('user/template/slider');
        $this->load->view('user/home');
        $this->load->view('user/template/footer');
    }

}
