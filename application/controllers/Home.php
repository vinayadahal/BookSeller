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
        $col = array("book.id",
            "book.name",
            "book.author",
            "book.year",
            "book.edition",
            "book.offer",
            "book.price",
            "book.pages",
            "book.condition",
            "category.name as category_name");
        $table1 = 'book';
        $table2 = 'category';
        $table1_id = "category_id";
        $table2_id = "id";
        $data['book_category'] = (array) $this->select->getSingleRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'id', $book_id);

        $this->loadView($data, "showDetails");
    }

    public function loadView($data, $page_name) {
        $data['title'] = ucfirst($page_name);
        $this->load->view('user/template/header', $data);
        if ($page_name == 'home') {
            $this->load->view('user/template/slider', $data);
        }
        $this->load->view('user/' . $page_name, $data);
        $this->load->view('user/template/footer', $data);
    }

}
