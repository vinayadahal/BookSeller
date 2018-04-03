<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PublicUser extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
//        $this->session_check();
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
        $data['AllBooks'] = (array) ($this->select->getAllFromTable('book', $DataPerPage, $start));
        $this->loadView($data, 'home');
    }

    public function showDetails($book_id) {
        $data['book_category'] = $this->BookDetails($book_id);
        $data['reviews'] = $this->UserReview($book_id);
        $data['biddings'] = $this->Bidding($book_id);
        $data['images'] = (array) $this->select->getAllFromTableWhere('images', 'book_id', $book_id, '', '');
        $data['descriptions'] = $this->Description($book_id);
        $this->loadView($data, "showDetails");
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
