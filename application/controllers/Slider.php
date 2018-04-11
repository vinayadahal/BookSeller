<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('upload');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
    }

    public function file_uploader() {
        $config['upload_path'] = './images/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['max_size'] = 0;
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('imgFile')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', $error . '!!!');
        } else {
            $data = ($this->upload->data());
            $this->resizeImage("./images/uploads/" . $data['file_name']);
            $this->session->set_flashdata('message', $data['file_name'] . ' uploaded successfully!!!');
        }
        redirect(base_url() . 'admin/slider', 'refresh');
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');
        $this->loadView($data, 'slider/index', 'home');
    }

    public function activeSlider() {
        $this->loadView("", 'slider/active', 'Active Slider');
    }

    public function addSliderImage() {
        $this->loadView("", "slider/create", "Upload Slider");
    }

    public function editImage($id) {
        $data['image_location'] = "images/uploads/" . $id . '.jpg';
        $this->loadView($data, 'slider/edit', 'home');
    }

    public function cropUploadImage() {
        $imgPath = $this->input->post('imgPath');
        $coordX = $this->input->post('x');
        $coordY = $this->input->post('y');
        $coordW = $this->input->post('w');
        $coordH = $this->input->post('h');
        $filename = $this->cropImage($imgPath, $coordX, $coordY, $coordW, $coordH);
        if (!empty($filename)) {
            $this->session->set_flashdata('message', 'Successfully added image to slider!!!');
            redirect(base_url() . 'admin/slider', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add image on slider!!!');
            redirect(base_url() . 'admin/slider', 'refresh');
        }
    }

    public function resizeImage($imgPath) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = $img_height / $img_width;
        $img_width_new = 980;
        $img_height_new = $img_width_new * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = './images/uploads/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, 'upload');
    }

    public function fileExists($file_path) {
        if (!file_exists($file_path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getMime($imgPath) {
        $mime = getimagesize($imgPath);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($imgPath);
        } elseif ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        return array($src_img, $mime);
    }

    public function create_image($new_image, $new_file_path, $mime, $filename, $folder = NULL) {
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($new_image, $new_file_path, 9);
        } elseif ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        }
        if ($folder == 'slide') {
            return './images/slider/' . $filename;
        } else {
            return './images/uploads/' . $filename;
        }
    }

    public function cropImage($imgPath, $coordX, $coordY, $coordW, $coordH) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data[1];
        $img_width_new = 980;
        $img_height_new = 350;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        imagecopyresampled($new_image, $src_img, 0, 0, $coordX, $coordY, $coordW, $coordH, $img_width_new, $img_height_new); // New save location
        $new_file_path = './images/slider/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, basename($imgPath), 'slide');
    }

    public function deleteImage($id) {
        unlink('./images/uploads/' . $id . '.jpg');
        if (!$this->fileExists('./images/slider/' . $id . '.jpg')) {
            unlink('./images/slider/' . $id . '.jpg');
        }
        $this->session->set_flashdata('message', 'Image' . $id . '.jpg' . 'has been deleted!!!');
        redirect(base_url() . 'admin/slider', 'refresh');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/' . $page_name, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
