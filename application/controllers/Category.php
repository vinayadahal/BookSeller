<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    private $name;
    private $category_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->model('delete');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('commons');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
    }

    public function form_value_init() {
        $this->name = $this->input->post('name');
        if (!empty($this->input->post('category_id')) && null !== $this->input->post('category_id')) {
            $this->category_id = $this->input->post('category_id');
        }
    }

    public function array_maker_post_table() {
        return array("name" => $this->name);
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("category");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $data['categories'] = (array) $this->select->getAllFromTable('category', $DataPerPage, $start);
        $this->loadView($data, 'category/index', 'home');
    }

    public function addCategory() {
        $this->loadView("", "category/create", "Add Category");
    }

    public function createCategory() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->insert->insert_single_row($data_post_table, "category")) {
            $this->session->set_flashdata('message', 'Added a new category as ' . ucfirst($this->name) . '!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to add category as ' . ucfirst($this->name) . '!!!');
        }
        redirect(base_url() . 'admin/category', 'refresh');
    }

    public function editCategory($id) {
        $data['category'] = (array) $this->select->getSingleRecord('category', $id);
        $data['category_id'] = $id;
        $this->loadView($data, "category/edit", "Edit Post");
    }

    public function updateCategory() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->update->updateSingleCondition($data_post_table, "category", "id", $this->category_id)) {
            $this->session->set_flashdata('message', 'Updated category ' . ucfirst($this->name) . '!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to update category ' . ucfirst($this->name) . '!!!');
        }
        redirect(base_url() . 'admin/category', 'refresh');
    }

    public function deleteCategory($id) {
        $post = (array) $this->select->getSingleRecord('category', $id);
        if ($this->delete->deleteSingleCondition("category", "id", $id)) {
            $this->session->set_flashdata('message', 'Category ' . ucfirst($post['name']) . ' deleted successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete category ' . ucfirst($post['name']) . '!!!');
        }
        redirect(base_url() . 'admin/category', 'refresh');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/' . $page_name, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
