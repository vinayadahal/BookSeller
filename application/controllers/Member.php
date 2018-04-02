<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            redirect('PublicUser/index', 'refresh');
        }
    }

    public function index($page = null) {
        $this->session->set_userdata('user_id', '1');
        $this->loadView("", 'home', 'home');
    }

    public function myBooks() {
//        $data['AllBooks'] = (array) $this->select->getAllFromTableWhere('book', 'user_id', '1', '', '');
        $col = array("book.id", "book.name",
            "book.author", "book.year",
            "book.edition", "book.offer",
            "book.price", "book.pages",
            "book.condition", "category.name as category_name");
        $table1 = 'book';
        $table2 = 'category';
        $table1_id = "category_id";
        $table2_id = "id";
        $data['AllBooks'] = (array) $this->select->getAllRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'user_id', '1');
        $this->loadView($data, 'my_books/index', 'My Books');
    }

    public function addBook() {
        $data['categories'] = (array) $this->select->getAllFromTable('category', '', '');
        $this->loadView($data, "my_books/create", "Add Book");
    }

    public function createBook() {
        $user_id = $this->session->userdata('user_id');
        $book_name = $this->input->post('book_name');
        $image = $this->input->post('imgFile');
        $category = $this->input->post('category');
        $author = $this->input->post('author');
        $year = $this->input->post('year');
        $edition = $this->input->post('edition');
        $offer = $this->input->post('offer');
        $pages = $this->input->post('pages');
        $price = $this->input->post('price');
        $condition = $this->input->post('condition');
        $description = $this->input->post('description');

        $data_book_table = array(
            "name" => $book_name,
            "category_id" => $category,
            "author" => $author,
            "year" => $year,
            "edition" => $edition,
            "offer" => $offer,
            "price" => $price,
            "condition" => $condition,
            "user_id" => $user_id
        );

        $new_book_id = $this->insert->insert_return_id($data_book_table, "book");

        $data_description_table = array(
            "book_id" => $new_book_id,
            "description" => $description
        );

        $data_image_table = array(
            "book_id" => $new_book_id,
            "image_location" => $image
        );

        if ($this->insert->insert_single_row($data_description_table, "description")) {
            $this->insert->insert_single_row($data_image_table, "images");
            redirect('Member/myBooks', 'refresh');
        } else {
            redirect('Member/myBooks', 'refresh');
        }
    }

    public function editBook($id) {
        $data['book'] = (array) $this->select->getSingleRecord('book', $id);
        $data['description'] = (array) $this->select->getSingleRecordWhere('description', 'book_id', $id);
        $data['images'] = (array) $this->select->getSingleRecordWhere('images', 'book_id', $id); // replace this with getAllRecord version of query for multiple image selection
        $data['categories'] = (array) $this->select->getAllFromTable('category', '', '');
        $this->loadView($data, "my_books/edit", "Edit Book");
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
