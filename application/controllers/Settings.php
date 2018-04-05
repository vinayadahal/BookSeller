<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    private $username;
    private $password;
    private $user_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('update');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->session_check();
        $this->user_id = $this->session->userdata('user_id');
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('message', 'Invaild credentials!!!');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function form_value_init() {
        $this->username = $this->input->post('username');
        $this->old_password = $this->input->post('old_password');
        if ($this->input->post('new_password') == $this->input->post('con_password')) {
            $this->password = $this->input->post('new_password');
        } else {
            $this->session->set_flashdata('message', 'Passwords do not match!!!');
            redirect(base_url() . 'member/settings', 'refresh');
        }
    }

    public function array_maker_post_table() {
        return array(
            "username" => $this->username,
            "password" => sha1($this->password)
        );
    }

    public function matchingBooks() {
        $posted_books = (array) $this->select->getAllFromTable('posts', '', '');
        $data = array();
        $i = 0;
        foreach ($posted_books as $posted_book) {
            $data[$i++] = (array) $this->select->searchAllRecords(array($posted_book->book_name, $posted_book->author), array('name', 'author'), 'book');
        }
        return $data;
    }

    public function index() {
        $data['books'] = $this->matchingBooks();
        $data['user'] = (array) $this->select->getSingleRecord('user', $this->user_id);
        $data['message'] = $this->session->flashdata('message');
        $this->loadView($data, 'settings/index', 'Settings');
    }

    public function updateUser() {
        $this->form_value_init(); // initalize form value
        $user = (array) $this->select->getSingleRecordWhere('user', 'password', sha1($this->old_password));
        if (isset($user['id']) && $user['id'] == $this->user_id) {
            $data_post_table = $this->array_maker_post_table(); // create array with book
            if ($this->update->updateSingleCondition($data_post_table, "user", "id", $this->user_id)) {
                $this->session->set_flashdata('message', 'User credential updated!!!');
                redirect(base_url() . 'member', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Unable to update user credentials!!!');
                redirect(base_url() . 'member', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', 'Old password do not match!!!');
            redirect(base_url() . 'member/settings', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
