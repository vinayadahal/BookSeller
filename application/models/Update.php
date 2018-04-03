<?php

class Update extends CI_Model {

    function updateSingleCondition($data, $table_name, $cond_col, $cond_val) {
        $this->db->where($cond_col, $cond_val);
        if ($this->db->update($table_name, $data)) {
            return true;
        } else {
            return false;
        }
    }

}
