<?php

class log_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
    }

    //logs list many condition search
    function get_logs_login($start_date=0,$end_date=0,$s_value='',$limit=0,$offset=0){
        
            $table=$this->db->dbprefix('admin_logs');
            
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_value){
                $this->db->where("$table.username",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($offset)
            {
                $this->db->offset($offset);
            }
            $res=$this->db->from($table)->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_logs_login_num($start_date=0,$end_date=0,$s_value=''){
            
            $table=$this->db->dbprefix('admin_logs');
            
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_value){
                $this->db->where("$table.username",$s_value);
            }
            
            $this->db->from($table)->get()->result();
            
            return $this->db->affected_rows() ;

    }
    
    function set_logs_login($data){
            $table=$this->db->dbprefix('admin_logs');
            
    }
    
    
    function get_logs_action($start_date=0,$end_date=0,$s_key='',$s_value='',$limit=0,$offset=0){
        
            $table=$this->db->dbprefix('admin_dologs');
            
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
            $res=$this->db->from($table)->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_logs_action_num($start_date=0,$end_date=0,$s_key='',$s_value=''){
            
            $table=$this->db->dbprefix('admin_dologs');
            
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
}