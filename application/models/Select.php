<?php

class Select extends CI_Model {

    function getAllFromTable($table, $limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getAllFromTableWhere($table, $cond_col, $cond_val, $limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        if (is_array($cond_col) && is_array($cond_val)) {
            $i = 0;
            foreach ($cond_col as $col) {
                $this->db->where($col, $cond_val[$i++]);
            }
        } else {
            $this->db->where($cond_col, $cond_val);
        }
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getAllRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_value, $limit = null, $start = null) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->where("$t_name1.$cond_col", $cond_value);
        $this->dataLimiter($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getAllRecordInnerJoinNoCondition($col, $t_name1, $t_name2, $t_1_col, $t_2_col) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
//        $this->db->where("$t_name1.$cond_col", $cond_value);
//        $this->dataLimiter($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getSingleRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_value) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->where("$t_name1.$cond_col", $cond_value);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function getSingleRecordInnerJoinThreeTbl($col, $t_name1, $t_name2, $t_name3, $t_1_col, $t_2_col, $t_3_col, $t1_col2, $cond_col, $cond_value) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $field = "" . implode(",", $col) . "";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->join($t_name3, "$t_name1.$t1_col2 = $t_name3.$t_3_col");
        $this->db->where("$t_name1.$cond_col", $cond_value);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
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

    function search($keyword, $cols, $tablename, $cond_col = null, $cond_val = null) {
        $this->db->select('*');
        $this->db->from($tablename);
        foreach ($cols as $col) {
            $this->db->or_like($col, $keyword);
            if (isset($cond_col) && isset($cond_val)) {
                $this->db->where($cond_col, $cond_val);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    function searchAllRecords($keyword, $cols, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $i = 1;
        $j = 0;
        $where_query = "";
        foreach ($cols as $col) {
            if (count($cols) == $i) {
                $where_query .= "`" . $col . "` LIKE '%" . $keyword[$j] . "%';";
            } else {
                $where_query .= "`" . $col . "` LIKE '%" . $keyword[$j] . "%' AND ";
            }
            $i++;
            $j++;
        }
        $this->db->where($where_query);
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
            return $query->row();
        } else {
            return false;
        }
    }

    function getSingleRecordWhere($table, $cond_col, $cond_val) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($cond_col, $cond_val);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function getSingleRecordWhereMultiValue($table, $cond_col, $cond_val, $cond_col2, $cond_val2) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($cond_col, $cond_val);
        $this->db->where($cond_col2, $cond_val2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function dataLimiter($limit, $start) {
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
    }

}
