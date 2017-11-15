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
        $data['book_category'] = $this->BookDetails($book_id);
        $data['reviews'] = $this->UserReview($book_id);
        $data['biddings'] = $this->Bidding($book_id);
        $this->loadView($data, "showDetails");
    }

    public function BookDetails($book_id) {
        $col = array("book.id", "book.name",
            "book.author", "book.year",
            "book.edition", "book.offer",
            "book.price", "book.pages",
            "book.condition", "category.name as category_name");
        $table1 = 'book';
        $table2 = 'category';
        $table1_id = "category_id";
        $table2_id = "id";
        return (array) $this->select->getSingleRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'id', $book_id);
    }

    public function UserReview($book_id) {
        $reviews = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('review', 'book_id', $book_id, '', ''));
        foreach ($result as $review) {
            $user_details = (array) ($this->select->getSingleRecord('user', $review->user_id));
            $reviews[$i++] = array(
                'title' => $review->title,
                'review' => $review->review,
                'username' => $user_details['username'],
                'member_since' => $user_details['created']
            );
        }
        return $reviews;
    }

    public function Bidding($book_id) {
        $biddings = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('bidding', 'book_id', $book_id, '', ''));
        foreach ($result as $bidding) {
            $user_details = (array) ($this->select->getSingleRecord('user', $bidding->user_id));
            $biddings[$i++] = array(
                'bidding' => $bidding->bidding,
                'time' => $bidding->date,
                'username' => $user_details['username'],
                'member_since' => $user_details['created']
            );
        }
        return $biddings;
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
