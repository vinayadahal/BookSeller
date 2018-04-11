<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    private $name, $email, $phone, $address, $role, $username, $password, $con_password, $user_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->model('delete');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('upload');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
    }

    public function form_value_init() {
        $this->name = $this->input->post('name');
        $this->email = $this->input->post('email');
        $this->phone = $this->input->post('phone');
        $this->address = $this->input->post('address');
        $this->role = $this->input->post('role');
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->con_password = $this->input->post('con_password');
        if (!empty($this->input->post('user_id')) && null !== $this->input->post('user_id')) {
            $this->user_id = $this->input->post('user_id');
        }
    }

    public function array_maker_user_table() {
        if (empty($this->password) && empty($this->con_password)) {
            return array("name" => $this->name, "email" => $this->email, "phone" => $this->phone, "address" => $this->address, "role" => $this->role, "username" => $this->username);
        } else {
            return array("name" => $this->name, "email" => $this->email, "phone" => $this->phone, "address" => $this->address, "role" => $this->role, "username" => $this->username, "password" => sha1($this->password));
        }
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');
        $col = array("user.id", "user.name", "user.email", "user.phone", "user.address", "user.created", "user.username", "role.role as role");
        $table1 = 'user';
        $table2 = 'role';
        $table1_id = "role";
        $table2_id = "id";
        $data['users'] = (array) $this->select->getAllRecordInnerJoinNoCondition($col, $table1, $table2, $table1_id, $table2_id);
        $this->loadView($data, 'users/index', 'All Users');
    }

    public function addUser() {
        $data['roles'] = (array) $this->select->getAllFromTable('role', '', '');
        $this->loadView($data, "users/create", "Add User");
    }

    public function createUser() {
        $this->form_value_init(); // initalize form value
        $data_user_table = $this->array_maker_user_table(); // create array with book
        if ($this->password != $this->con_password) {
            $this->session->set_flashdata('message', "Passwords are not equal!!!");
        }
        if ($this->insert->insert_single_row($data_user_table, "user")) {
            $this->session->set_flashdata('message', ucwords($this->name) . " added successfully!!!");
        } else {
            $this->session->set_flashdata('message', 'Unable to add ' . ucwords($this->name) . '!!!');
        }
        redirect(base_url() . 'users/index', 'refresh');
    }

    public function editUser($id) {
        $col = array("user.id", "user.name", "user.email", "user.phone", "user.address", "user.created", "user.username", "role.role as role");
        $table1 = 'user';
        $table2 = 'role';
        $table1_id = "role";
        $table2_id = "id";
        $data['users'] = (array) $this->select->getSingleRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'id', $id);
        $data['roles'] = (array) $this->select->getAllFromTable('role', '', '');
        $data['user_id'] = $id;
        $this->loadView($data, "users/edit", "Edit User");
    }

    public function updateUser() {
        $this->form_value_init(); // initalize form value
        $data_user_table = $this->array_maker_user_table(); // create array with book
        if ($this->password != $this->con_password) {
            $this->session->set_flashdata('message', "Passwords are not equal!!!");
        }
        if ($this->update->updateSingleCondition($data_user_table, "user", "id", $this->user_id)) {
            $this->session->set_flashdata('message', ucfirst($this->name) . " updated successfully!!!");
        } else {
            $this->session->set_flashdata('message', 'Unable to update ' . ucfirst($this->name) . '!!!');
        }
        redirect(base_url() . 'users/index', 'refresh');
    }

    public function deleteUser($id) {
        $user = (array) $this->select->getSingleRecord('user', $id);
        if ($this->delete->deleteSingleCondition("user", "id", $id)) {
            $this->session->set_flashdata('message', ucwords($user['name']) . ' deleted successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete ' . ucwords($user['name']) . '!!!');
        }
        redirect(base_url() . 'users/index', 'refresh');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/' . $page_name, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
