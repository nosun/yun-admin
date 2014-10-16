<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log_Model extends Yun_Model{
    
    function __construct() {
        parent::__construct();
        $this->dologdb=$this->db->dbprefix('admin_dologs');
        $this->logdb=$this->db->dbprefix('admin_logs');
        
    }
    
    public function set_log($table, $str) {
        $uid = $this->session->userdata('uid');
        $this->load->model('admin_model');
        $admin =$this->admin_model->get_admin($uid);
        $ip = $this->input->ip_address();
        $data = array(
            'ip' => $ip,
            'username' => $admin['username'],
            'userid' => $admin['uid'],
            'time' => time(),
            'table' => $table,
            'detail' => $str
        );
        return $this->db->insert($this->dologdb, $data);
    }
    
    
    //logs list many condition search
    function get_logs_login($start_date=0,$end_date=0,$s_value='',$limit=0,$offset=0,$order='logintime desc'){

            if($start_date){
                $this->db->where("active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("active_time <",$end_date);
            }
            if($s_value){
                $this->db->where("username",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($offset)
            {
                $this->db->offset($offset);
            }
                $this->db->order_by($order);
                $this->db->from($this->logdb);
                
            $res=$this->db->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_logs_login_num($start_date=0,$end_date=0,$s_value=''){
            
            if($start_date){
                $this->db->where("active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("active_time <",$end_date);
            }
            if($s_value){
                $this->db->where("username",$s_value);
            }
            
            $this->db->from($this->logdb)->get()->result();
            
            return $this->db->affected_rows() ;

    }
    
    
    function get_logs_action($start_date=0,$end_date=0,$s_key='',$s_value='',$limit=0,$offset=0){
            
            if($start_date){
                $this->db->where("active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$s_key",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($offset)
            {
                $this->db->offset($offset);
            }
            $res=$this->db->from($this->dologdb)->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_logs_action_num($start_date=0,$end_date=0,$s_key='',$s_value=''){

        if($start_date){
                $this->db->where("active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$s_key",$s_value);
            }
            
            $this->db->from($this->dologdb)->get()->result();
            
            return $this->db->affected_rows() ;

    }
}