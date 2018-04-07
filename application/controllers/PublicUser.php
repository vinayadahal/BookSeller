<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PublicUser extends CI_Controller {

    private $name, $email, $phone, $address, $role, $username, $password, $con_password, $user_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
    }

    public function pageDataLimiter($page, $dataPerPage) {
        if ($page > 1) {
            $page = $page - 1;
            return ($dataPerPage * $page);
        } else {
            return 0;
        }
    }

    public function index($page = null) {
        $TotalCount = $this->select->getTotalCount("book");
        $DataPerPage = 12;
        $start = $this->pageDataLimiter($page, $DataPerPage);
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $col = array("book.id", "book.name",
            "book.author", "book.year",
            "book.edition", "book.offer",
            "book.price", "images.image_location as image_location");
        $table1 = 'book';
        $table2 = 'images';
        $table1_id = "id";
        $table2_id = "book_id";
        $data['AllBooks'] = (array) $this->select->getAllRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'publish', 'Yes', $DataPerPage, $start);
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        if (!empty($this->session->userdata('user_id'))) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $this->loadView($data, 'home');
    }

    public function showDetails($book_id) {
        $data['book_category'] = $this->BookDetails($book_id);
        $data['reviews'] = $this->UserReview($book_id);
        $data['biddings'] = $this->Bidding($book_id);
        $data['images'] = (array) $this->select->getAllFromTableWhere('images', 'book_id', $book_id, '', '');
        $data['descriptions'] = $this->Description($book_id);
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        if (!empty($this->session->userdata('user_id'))) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $this->loadView($data, "showDetails");
    }

    public function BookDetails($book_id) {
        $col = array("book.id", "book.name", "book.author", "book.year", "book.edition", "book.offer", "book.price", "book.pages", "book.condition", "category.name as category_name", "user.name as username", "DATE(user.created) as member_since");
        $table1 = 'book';
        $table2 = 'category';
        $table3 = 'user';
        $table1_id = "category_id";
        $table2_id = "id";
        $table3_id = "id";
        $table1_user_id = "user_id";
        return (array) $this->select->getSingleRecordInnerJoinThreeTbl($col, $table1, $table2, $table3, $table1_id, $table2_id, $table3_id, $table1_user_id, 'id', $book_id);
    }

    public function UserReview($book_id) {
        $reviews = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('review', 'book_id', $book_id, '', ''));
        foreach ($result as $review) {
            $user_details = (array) ($this->select->getSingleRecord('user', $review->user_id));
            $reviews[$i++] = array('title' => $review->title, 'review' => $review->review, 'username' => $user_details['username'], 'member_since' => $user_details['created']);
        }
        return $reviews;
    }

    public function Bidding($book_id) {
        $biddings = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('bidding', 'book_id', $book_id, '', ''));
        foreach ($result as $bidding) {
            $user_details = (array) ($this->select->getSingleRecord('user', $bidding->user_id));
            $biddings[$i++] = array('bidding' => $bidding->bidding, 'time' => $bidding->date, 'username' => $user_details['username'], 'member_since' => $user_details['created']);
        }
        return $biddings;
    }

    public function Description($book_id) {
        $descriptions = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('description', 'book_id', $book_id, '', ''));
        foreach ($result as $description) {
            $descriptions[$i++] = array('description' => $description->description);
        }
        return $descriptions;
    }

    public function searchBook() {
        $keyword = $this->input->get('keyword');
        $data['keyword'] = $keyword;
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        $book_result = (array) ($this->select->search($keyword, array('name', 'author', 'edition', 'offer', 'condition'), 'book', 'publish', 'yes'));
        $data['searchBooks'] = array();
        $i = 0;
        foreach ($book_result as $book) {
            $image = (array) ($this->select->getSingleRecordWhere('images', 'book_id', $book->id));
            $data['searchBooks'][$i++] = array('id' => $book->id, 'name' => $book->name, 'author' => $book->author, 'edition' => $book->edition, 'offer' => $book->offer, 'price' => $book->price, 'pages' => $book->pages, 'image_location' => $image['image_location'],);
        }
        if (!empty($this->session->userdata('user_id'))) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $this->loadView($data, 'search');
    }

    public function searchByCategory($keyword) {
        $data['keyword'] = str_replace('-', ' ', $keyword);
        $result = (array) ($this->select->getSingleRecordWhere('category', 'name', str_replace('-', ' ', $keyword)));
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        $book_result = (array) ($this->select->getAllFromTableWhere('book', array('category_id', 'publish'), array($result['id'], 'Yes'), '', ''));
        $data['searchBooks'] = array();
        $i = 0;
        foreach ($book_result as $book) {
            $image = (array) ($this->select->getSingleRecordWhere('images', 'book_id', $book->id));
            $data['searchBooks'][$i++] = array('id' => $book->id, 'name' => $book->name, 'author' => $book->author, 'edition' => $book->edition, 'offer' => $book->offer, 'price' => $book->price, 'pages' => $book->pages, 'image_location' => $image['image_location'],);
        }
        if (!empty($this->session->userdata('user_id'))) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $this->loadView($data, 'search');
    }

    public function request() {
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        $posts = (array) $this->select->getAllFromTable('posts', '', '');
        $data['AllPosts'] = array();
        $i = 0;
        foreach ($posts as $post) {
            $user = (array) ($this->select->getSingleRecordWhere('user', 'id', $post->user_id));
            $data['AllPosts'][$i++] = array("book_name" => $post->book_name, "author" => $post->author, "username" => $user['username'], "email" => $user['email']);
        }
        if (!empty($this->session->userdata('user_id'))) {
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $this->loadView($data, 'request');
    }

    public function register() {
        $data['message'] = $this->session->flashdata('message');
        $data['AllCategories'] = (array) $this->select->getAllFromTable('category', '', '');
        $this->loadView($data, 'register');
    }

    public function form_value_init() {
        $this->name = $this->input->post('name');
        $this->email = $this->input->post('email');
        $this->phone = $this->input->post('phone');
        $this->address = $this->input->post('address');
        $this->role = '2';
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->con_password = $this->input->post('con_password');
    }

    public function array_maker_user_table() {
        return array("name" => $this->name, "email" => $this->email, "phone" => $this->phone, "address" => $this->address, "role" => $this->role, "username" => $this->username, "password" => sha1($this->password));
    }

    public function signup() {
        $this->form_value_init(); // initalize form value
        $data_user_table = $this->array_maker_user_table(); // create array with book
        if ($this->password != $this->con_password) {
            $this->session->set_flashdata('message', "Passwords are not equal!!!");
            redirect(base_url() . 'register', 'refresh');
        }
        if ($this->insert->insert_single_row($data_user_table, "user")) {
            $this->session->set_flashdata('message', ucwords($this->name) . " registered successfully. Please check your email for verification code!!!");
            redirect(base_url() . 'register', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to register ' . ucwords($this->name) . '!!!');
            redirect(base_url() . 'register', 'refresh');
        }
    }

    public function loginUser($book_id) {
        $this->session->set_userdata('redirectUrl', base_url() . 'showDetails/' . $book_id);
        redirect(base_url() . 'login', 'refresh');
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
