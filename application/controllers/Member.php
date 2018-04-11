<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('images');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');
        $data['books'] = $this->matchingBooks();
        $this->images->removeImages($this->select);
        $this->loadView($data, 'home', 'home');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
