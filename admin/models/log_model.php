<?php

class User_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
    }


    //equipment list many condition search
    function get_log_list($start_date=0,$end_date=0,$s_key=0,$s_value=0,$limit=0,$offset=0){
        
            $table=$this->db->dbprefix('users');
            
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$table.$s_key",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($offset)
            {
                $this->db->offset($offset);
            }
            $res=$this->db->from($table)->get()->result();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_user_num($start_date=0,$end_date=0,$s_key=0,$s_value=0){
            
            $table=$this->db->dbprefix('users');
            
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$table.$s_key",$s_value);
            }
            
            $this->db->from($table)->get()->result();
            
            return $this->db->affected_rows() ;

    }
    
    function get_user($uid){
        return $this->db->where('id', $uid)->get($this->db->dbprefix('users'))->row_array();
    }
    
    
    
    
    
    
    
}