<?php

class Insert extends CI_Model {

    function insert_single_row($data, $table_name) {
        if ($this->db->insert($table_name, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function insert_return_id($data, $table_name) {
        if ($this->db->insert($table_name, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

}
