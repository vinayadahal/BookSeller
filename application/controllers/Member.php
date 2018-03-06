<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
//        $this->session_check();
    }

    public function index($page = null) {
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

    public function BookDetails($book_id) {
        $col = array("book.id", "book.name",
            "book.author", "book.year",
            "book.edition", "book.offer",
            "book.price", "book.pages",
            "book.condition", "category.name as category_name",
            "user.name as username", "DATE(user.created) as member_since");
        $table1 = 'book';
        $table2 = 'category';
        $table3 = 'user';
        $table1_id = "category_id";
        $table2_id = "id";
        $table3_id = "id";
        return (array) $this->select->getSingleRecordInnerJoinThreeTbl($col, $table1, $table2, $table3, $table1_id, $table2_id, $table3_id, 'id', $book_id);
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

    public function Description($book_id) {
        $descriptions = array();
        $i = 0;
        $result = (array) ($this->select->getAllFromTableWhere('description', 'book_id', $book_id, '', ''));
        foreach ($result as $description) {
            $descriptions[$i++] = array(
                'description' => $description->description
            );
        }
        return $descriptions;
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
