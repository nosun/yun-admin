<?php

class Yun_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_by_id($tablename,$id) {
        $query = $this->db->get_where($tablename, array('id' => $id), 1);
        if ($query->num_rows() > 0)
        {
            $row = $query->result_array();
        } 
        return $row;
    }
    
}