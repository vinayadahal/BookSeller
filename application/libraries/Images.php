<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Images {

    public function resizeImage($imgPath) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = $img_width / $img_height;
        $img_height_new = 225;
        $img_width_new = $img_height_new * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = './images/icons/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, 'upload');
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

    public function removeImages($obj_select) {
        $images = (array) $obj_select->getAllFromTable('images', '', '');
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
