<?php

class select extends CI_Model {

    function getAllFromTable($table, $limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getCountFromTable($table, $id, $value) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id . '<', $value);
        $query = $this->db->get();
        return count($query->result());
    }

    function getTotalCount($table) {
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();
        return count($query->result());
    }

    function getUserLogin($username, $password) {
        $this->db->select('id, first_name, gender, username, password');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getUserDetails($id) {
        $this->db->select('first_name, gender');
        $this->db->from('user');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function search($keyword, $cols, $tablename) {
//        $column_list = '';
//        $i = 1;
//        foreach ($cols as $col) {
//            if (count($cols) == $i) {
//                $column_list .= '"' . $col . '"';
//            } else {
//                $column_list .= '"' . $col . '",';
//            }
//            $i++;
//        }
//        echo $column_list;
        $this->db->select('*');
        $this->db->from($tablename);
        foreach ($cols as $col) {
            $this->db->or_like($col, $keyword);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getSingleRecord($table, $id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
