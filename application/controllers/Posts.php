<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    private $user_id;
    private $book_name;
    private $author;
    private $post_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->model('delete');
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

    public function form_value_init() {
        $this->user_id = $this->session->userdata('user_id');
        $this->book_name = $this->input->post('book_name');
        $this->author = $this->input->post('author');
        if (!empty($this->input->post('post_id')) && null !== $this->input->post('post_id')) {
            $this->post_id = $this->input->post('post_id');
        }
    }

    public function array_maker_post_table() {
        return array(
            "book_name" => $this->book_name,
            "author" => $this->author,
            "user_id" => $this->user_id
        );
    }

    public function pageDataLimiter($page, $dataPerPage) {
        if ($page > 1) {
            $page = $page - 1;
            return ($dataPerPage * $page);
        } else {
            return 0;
        }
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

    public function index($page = null) {
        $data['books'] = $this->matchingBooks();
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("posts");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->pageDataLimiter($page, $DataPerPage);
        $table = 'posts';
        $data['AllPosts'] = (array) $this->select->getAllFromTableWhere($table, 'user_id', $this->session->userdata('user_id'), $DataPerPage, $start);
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'posts/index', 'My Posts');
    }

    public function addPost() {
        $this->loadView("", "posts/create", "Add Post");
    }

    public function createPost() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->insert->insert_single_row($data_post_table, "posts")) {
            $this->session->set_flashdata('message', 'Added post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        }
    }

    public function editPost($id) {
        $data['post'] = (array) $this->select->getSingleRecord('posts', $id);
        $data['post_id'] = $id;
        $this->loadView($data, "posts/edit", "Edit Post");
    }

    public function updatePost() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->update->updateSingleCondition($data_post_table, "posts", "id", $this->post_id)) {
            $this->session->set_flashdata('message', 'Updated post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        }
    }

    public function deletePost($id) {
        $post = (array) $this->select->getSingleRecord('posts', $id);
        if ($this->delete->deleteSingleCondition("posts", "id", $id)) {
            $this->session->set_flashdata('message', 'Post for ' . ucfirst($post['book_name']) . ' deleted successfully!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete post for ' . ucfirst($post['book_name']) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
