<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $username;
    private $password;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
    }

    public function form_value_init() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
    }

    public function index() {
        $page_name = "index";
        $title = 'login';
        $this->loadView("", $page_name, $title);
    }

    public function checkLogin() {
        $this->form_value_init();
        $result = $this->select->getSingleRecordWhereMultiValue('user', 'username', $this->username, 'password', sha1($this->password));
        if (!isset($result) || empty($result)) {
            redirect(base_url() . 'login', 'refresh');
        } else {
            $this->session->set_userdata('user_id', $result->id);
            $this->checkRole($result->role); // checks which panel to redirect to
        }
    }

    public function checkRole($role) {
        $role_value = $this->select->getSingleRecordWhere('role', 'id', $role);
        if (!empty($role_value->role)) {
            if ($role_value->role == 'role_admin') {
                echo "redirect to admin";
            } else {
                redirect(base_url() . 'member', 'refresh');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $this->load->view('login/template/header', $data);
        $this->load->view('login/' . $page_name, $data);
        $this->load->view('login/template/footer', $data);
    }

}
