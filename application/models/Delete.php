<?php

class Delete extends CI_Model {

    function deleteSingleCondition($table_name, $cond_col, $cond_val) {
        $this->db->where($cond_col, $cond_val);
        if ($this->db->delete($table_name)) {
            return true;
        } else {
            return false;
        }
    }

}
