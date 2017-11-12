<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
//        $this->session_check();
    }

    public function index() {
        $data['AllBooks'] = (array) ($this->select->getAllFromTable('book', '', ''));
        $this->loadView($data, 'home');
    }

    public function showDetails($book_id) {
        //select * from book where id=1 AND category_id=(select id from category)
//        $data['book']
    }

    public function loadView($data, $page_name) {
        $data['title'] = ucfirst('home');
        $this->load->view('user/template/header', $data);
        $this->load->view('user/template/slider', $data);
        $this->load->view('user/' . $page_name, $data);
        $this->load->view('user/template/footer', $data);
    }

}
