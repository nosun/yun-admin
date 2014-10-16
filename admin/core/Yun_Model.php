<?php

class Yun_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_num($tablename) {
        $table = $this->db->dbprefix($tablename);
        return $this->db->count_all($table);
    }
    
    
    
}