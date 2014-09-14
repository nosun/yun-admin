<?php

class User_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
        
    }

    //equipment list many condition search
    function get_user_list($start_date=0,$end_date=0,$s_key=0,$s_value=0,$limit=0,$start=0){
        
            $table=$this->db->dbprefix('users');
            
            if($start_date){
                $this->db->where("$table.user_regtime >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.user_regtime <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$table.$s_key",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->from($table)->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_user_num($start_date=0,$end_date=0,$s_key=0,$s_value=0){
            
            $table=$this->db->dbprefix('users');
            
            if($start_date){
                $this->db->where("$table.user_regtime >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.user_regtime <",$end_date);
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
    
    //search result affected rows for paganation
    function get_user_count_d($action=0,$start_date=0,$end_date=0,$limit=0,$start=0){
            $table=$this->db->dbprefix('user_count_d');
            if($start_date){
                $this->db->where("$table.updatetime >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.updatetime <",$end_date);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->select("updatetime,num_{$action} as num")->from($table)->get()->result_array();
            //var_dump($res);
            //echo $this->db->last_query();
            return($res);;
    }
}