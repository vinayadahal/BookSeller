<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commons {

    public function pageDataLimiter($page, $dataPerPage) {
        if ($page > 1) {
            $page = $page - 1;
            return ($dataPerPage * $page);
        } else {
            return 0;
        }
    }

    public function matchingBooks($obj_select) {
        $posted_books = (array) $obj_select->getAllFromTable('posts', '', '');
        $data = array();
        $i = 0;
        foreach ($posted_books as $posted_book) {
            $data[$i++] = (array) $obj_select->searchAllRecords(array($posted_book->book_name, $posted_book->author), array('name', 'author'), 'book');
        }
        return $data;
    }

}
