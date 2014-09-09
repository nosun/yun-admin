<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Yun_check extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function check_power($mid) {
        $uid = $this->session->userdata('user_id');
        $rid = $this->get_rolesid($uid);
        $arr_power = $this->get_array_power($rid);
        if ($arr_power[$id] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_array_power($rid) {
        $table_roles = $this->db->dbprefix('roles');
        $query = $this->db->get_where($table_roles, array('id' => $rid));
        $rs = $query->row_array();
        $str = $rs['models'];
        return json_decode($str);
    }

    public function get_rolesid($id) {
        $table_admins = $this->db->dbprefix('admins');
        $query = $this->db->get_where($table_admins, array('uid' => $id));
        $arr = $query->row_array();
        return inval($arr['role']);
        
    }
    
    public function set_log(){
        
    }

}

