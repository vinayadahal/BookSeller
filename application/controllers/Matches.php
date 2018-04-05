<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matches extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function index() {
        $posted_books = (array) $this->select->getAllFromTable('posts', '', '');
        $data['AllBooks'] = array();
        $i = 0;
        foreach ($posted_books as $posted_book) {
            $match = (array) $this->select->searchAllRecords(array($posted_book->book_name, $posted_book->author), array('name', 'author'), 'book');
            foreach ($match as $matches) {
                $array_each_record = array(
                    "id" => $matches->id,
                    "name" => $matches->name,
                    "author" => $matches->author,
                    "year" => $matches->year,
                    "edition" => $matches->edition,
                    "offer" => $matches->offer,
                    "price" => $matches->price,
                    "pages" => $matches->pages,
                    "condition" => $matches->condition,
                );
                $data['AllBooks'][$i++] = $array_each_record;
            }
        }
        $this->loadView($data, 'matches/index', 'Matching Books');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
