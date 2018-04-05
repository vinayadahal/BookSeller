<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyBooks extends CI_Controller {

    private $user_id;
    private $book_name;
    private $image;
    private $category;
    private $author;
    private $year;
    private $edition;
    private $offer;
    private $pages;
    private $price;
    private $condition;
    private $description;
    private $book_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->model('delete');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('upload');
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
//        $this->image = $this->input->post('imgFile');
        $this->category = $this->input->post('category');
        $this->author = $this->input->post('author');
        $this->year = $this->input->post('year');
        $this->edition = $this->input->post('edition');
        $this->offer = $this->input->post('offer');
        $this->pages = $this->input->post('pages');
        $this->price = $this->input->post('price');
        $this->condition = $this->input->post('condition');
        $this->description = $this->input->post('description');
        if (!empty($this->input->post('book_id')) && null !== $this->input->post('book_id')) {
            $this->book_id = $this->input->post('book_id');
        }
    }

    public function file_uploader() {
        $config['upload_path'] = './images/icons/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['max_size'] = 0;
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('imgFile')) {
//            $error = array('error' => $this->upload->display_errors());
            return false;
        } else {
            $data = ($this->upload->data());
            return $data['file_name'];
        }
    }

    public function array_maker_book_table() {
        return array(
            "name" => $this->book_name,
            "category_id" => $this->category,
            "author" => $this->author,
            "year" => $this->year,
            "edition" => $this->edition,
            "offer" => $this->offer,
            "pages" => $this->pages,
            "price" => $this->price,
            "condition" => $this->condition,
            "user_id" => $this->user_id,
        );
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

    public function pageDataLimiter($page, $dataPerPage) {
        if ($page > 1) {
            $page = $page - 1;
            return ($dataPerPage * $page);
        } else {
            return 0;
        }
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $data['books'] = $this->matchingBooks();
        $TotalCount = $this->select->getTotalCount("book");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->pageDataLimiter($page, $DataPerPage);

        $col = array("book.id", "book.name",
            "book.author", "book.year",
            "book.edition", "book.offer",
            "book.price", "book.pages",
            "book.condition", "book.publish", "category.name as category_name");
        $table1 = 'book';
        $table2 = 'category';
        $table1_id = "category_id";
        $table2_id = "id";

        $data['AllBooks'] = (array) $this->select->getAllRecordInnerJoin($col, $table1, $table2, $table1_id, $table2_id, 'user_id', $this->session->userdata('user_id'), $DataPerPage, $start);
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'my_books/index', 'My Books');
    }

    public function addBook() {
        $data['categories'] = (array) $this->select->getAllFromTable('category', '', '');
        $this->loadView($data, "my_books/create", "Add Book");
    }

    public function createBook() {

        $this->form_value_init(); // initalize form value

        $data_book_table = $this->array_maker_book_table(); // create array with book

        $new_book_id = $this->insert->insert_return_id($data_book_table, "book");

        $data_description_table = array(
            "book_id" => $new_book_id,
            "description" => $this->description
        );

        $data_image_table = array(
            "book_id" => $new_book_id,
            "image_location" => $this->image
        );

        if ($this->insert->insert_single_row($data_description_table, "description")) {
            $this->insert->insert_single_row($data_image_table, "images");
            $this->file_uploader();
            $this->session->set_flashdata('message', ucfirst($this->book_name) . " added successfully!!!");
            redirect(base_url() . 'member/my-books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        }
    }

    public function editBook($id) {
        $data['book'] = (array) $this->select->getSingleRecord('book', $id);
        $data['description'] = (array) $this->select->getSingleRecordWhere('description', 'book_id', $id);
        $data['images'] = (array) $this->select->getSingleRecordWhere('images', 'book_id', $id); // replace this with getAllRecord version of query for multiple image selection
        $data['categories'] = (array) $this->select->getAllFromTable('category', '', '');
        $data['book_id'] = $id;
        $this->loadView($data, "my_books/edit", "Edit Book");
    }

    public function updateBook() {
        $this->form_value_init(); // initalize form value
        $data_book_table = $this->array_maker_book_table(); // create array with book
        $this->update->updateSingleCondition($data_book_table, "book", "id", $this->book_id);
        $data_description_table = array("description" => $this->description);
        if ($this->update->updateSingleCondition($data_description_table, "description", "book_id", $this->book_id)) {
            $data_image_table = array("image_location" => $this->file_uploader());
            $this->update->updateSingleCondition($data_image_table, "images", "book_id", $this->book_id);
            $this->session->set_flashdata('message', ucfirst($this->book_name) . " updated successfully!!!");
            redirect(base_url() . 'member/my-books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        }
    }

    public function deleteBook($id) {
        $book = (array) $this->select->getSingleRecord('book', $id);
        $this->delete->deleteSingleCondition("images", "book_id", $id);
        $this->delete->deleteSingleCondition("description", "book_id", $id);
        if ($this->delete->deleteSingleCondition("book", "id", $id)) {
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' deleted successfully!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete ' . ucfirst($book['name']) . '!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        }
    }

    public function publishBook($id) {
        $data_book_table = array("publish" => "Yes");
        $book = (array) $this->select->getSingleRecord('book', $id);
        if ($this->update->updateSingleCondition($data_book_table, "book", "id", $id)) {
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' published successfully!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to piblish ' . ucfirst($book['name']) . '!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        }
    }

    public function hideBook($id) {
        $data_book_table = array("publish" => "No");
        $book = (array) $this->select->getSingleRecord('book', $id);
        if ($this->update->updateSingleCondition($data_book_table, "book", "id", $id)) {
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' hidden successfully!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to hidden ' . ucfirst($book['name']) . '!!!');
            redirect(base_url() . 'member/my-books', 'refresh');
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
