<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('message', 'Invaild credentials!!!');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');
        $data['books'] = $this->matchingBooks();
        $this->removeImages();
        $this->loadView($data, 'home', 'home');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
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

    public function removeImages() {
        $images = (array) $this->select->getAllFromTable('images', '', '');
        $img_files = $this->getImgFile();
        $img_from_db = array();
        $i = 0;
        foreach ($images as $image) {
            $img_from_db[$i++] = $image->image_location;
        }
        foreach ($img_files as $img_file) {
            if (in_array($img_file, $img_from_db)) {
                continue;
            } else {
                unlink("./images/icons/$img_file");
            }
        }
    }

    public function getImgFile() {
        $files = scandir('./images/icons/');
        $array = array();
        $i = 0;
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $array[$i++] = $file;
            }
        }
        return $array;
    }

}
