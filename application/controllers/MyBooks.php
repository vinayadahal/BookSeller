<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyBooks extends CI_Controller {

    private $user_id, $book_name, $category, $author, $year, $edition, $offer, $pages, $price, $condition, $description, $book_id;

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
        $this->load->library('images');
        $this->load->library('commons');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
    }

    public function form_value_init() {
        $this->user_id = $this->session->userdata('user_id');
        $this->book_name = ucwords($this->input->post('book_name'));
        $this->category = $this->input->post('category');
        $this->author = ucwords($this->input->post('author'));
        $this->year = $this->input->post('year');
        $this->edition = ucwords($this->input->post('edition'));
        $this->offer = ucfirst($this->input->post('offer'));
        $this->pages = $this->input->post('pages');
        $this->price = $this->input->post('price');
        $this->condition = $this->input->post('condition');
        $this->description = ucfirst($this->input->post('description'));
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
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('imgFile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            return false;
        } else {
            $data = ($this->upload->data());
            $this->images->resizeImage("./images/icons/" . $data['file_name']);
            return $data['file_name'];
        }
    }

    public function array_maker_book_table() {
        return array("name" => $this->book_name, "category_id" => $this->category, "author" => $this->author, "year" => $this->year, "edition" => $this->edition, "offer" => $this->offer, "pages" => $this->pages, "price" => $this->price, "condition" => $this->condition, "user_id" => $this->user_id);
    }

    public function index($page = null) {
        $this->images->removeImages($this->select);
        $data['message'] = $this->session->flashdata('message');
        $data['books'] = $this->commons->matchingBooks($this->select);
        $TotalCount = $this->select->getTotalCount("book");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $col = array("book.id", "book.name", "book.author", "book.year", "book.edition", "book.offer", "book.price", "book.pages", "book.condition", "book.publish", "category.name as category_name");
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
        if ($this->insertDescription($new_book_id, $this->description)) {
            $this->insertImage($new_book_id);
            $this->session->set_flashdata('message', ucfirst($this->book_name) . " added successfully!!!");
        } else {
            $this->session->set_flashdata('message', 'Unable to add ' . ucfirst($this->book_name) . '!!!');
        }
        redirect(base_url() . 'member/my-books', 'refresh');
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
        if ($this->updateDescription($this->description, $this->book_id)) {
            if ($this->updateImage($this->book_id)) {
                $this->session->set_flashdata('message', ucfirst($this->book_name) . " updated successfully!!!");
            } else {
                $this->session->set_flashdata('message', 'Unable to update image for ' . ucfirst($this->book_name) . '!!!');
            }
        } else {
            $this->session->set_flashdata('message', 'Unable to update ' . ucfirst($this->book_name) . '!!!');
        }
        redirect(base_url() . 'member/my-books', 'refresh');
    }

    public function deleteBook($id) {
        $book = (array) $this->select->getSingleRecord('book', $id);
        $this->delete->deleteSingleCondition("description", "book_id", $id);
        if ($this->delete->deleteSingleCondition("book", "id", $id)) {
            $image = (array) $this->select->getSingleRecordWhere('images', 'book_id', $id);
            $this->deleteImage($image['image_location']);
            $this->delete->deleteSingleCondition("images", "book_id", $id);
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' deleted successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete ' . ucfirst($book['name']) . '!!!');
        }
        redirect(base_url() . 'member/my-books', 'refresh');
    }

    public function deleteImage($image_name) {
        unlink('./images/icons/' . $image_name);
    }

    public function publishBook($id) {
        $data_book_table = array("publish" => "Yes");
        $book = (array) $this->select->getSingleRecord('book', $id);
        if ($this->update->updateSingleCondition($data_book_table, "book", "id", $id)) {
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' published successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to piblish ' . ucfirst($book['name']) . '!!!');
        }
        redirect(base_url() . 'member/my-books', 'refresh');
    }

    public function hideBook($id) {
        $data_book_table = array("publish" => "No");
        $book = (array) $this->select->getSingleRecord('book', $id);
        if ($this->update->updateSingleCondition($data_book_table, "book", "id", $id)) {
            $this->session->set_flashdata('message', ucfirst($book['name']) . ' hidden successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to hidden ' . ucfirst($book['name']) . '!!!');
        }
        redirect(base_url() . 'member/my-books', 'refresh');
    }

    public function insertDescription($book_id, $description) {
        $data_description_table = array("book_id" => $book_id, "description" => $description);
        return $this->insert->insert_single_row($data_description_table, "description");
    }

    public function updateDescription($description, $book_id) {
        $desc = (array) $this->select->getSingleRecordWhere('description', 'book_id', $book_id);
        if (array_key_exists('0', $desc)) {
            return $this->insertDescription($book_id, $description);
        } else {
            $data_description_table = array("description" => $description);
            return $this->update->updateSingleCondition($data_description_table, "description", "book_id", $book_id);
        }
    }

    public function insertImage($book_id) {
        if (!empty($_FILES['imgFile']['name'])) {
            $data_image_table = array("book_id" => $book_id, "image_location" => $this->file_uploader());
            return $this->insert->insert_single_row($data_image_table, "images");
        } else {
            $data_image_table = array("book_id" => $book_id);
            return $this->insert->insert_single_row($data_image_table, "images");
        }
    }

    public function updateImage($book_id) {
        $image = (array) $this->select->getSingleRecordWhere('images', 'book_id', $book_id);
        if (array_key_exists('0', $image)) {
            return $this->insertImage($book_id);
        } else {
            if (!empty($_FILES['imgFile']['name'])) {
                $data_image_table = array("image_location" => $this->file_uploader());
                return $this->update->updateSingleCondition($data_image_table, "images", "book_id", $book_id);
            } else {
                return FALSE;
            }
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
