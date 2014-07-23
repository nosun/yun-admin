<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Yun_Check {

    public function __construct() {
        $CI = & get_instance();
        $CI->load->database();
        $CI->load->library('session');
        if (!$this->check_power()) {
            echo '您没有访问权限';
            die();
        }
    }

    public function check_power() {
        $CI = & get_instance();
        $id = $this->get_powerid();
        if (!$id) {
            return FALSE;
        }
        $uid = $CI->session->userdata('uid');
        $rid = $this->get_rolesid($uid);
        $arr_power = $this->get_array_power($rid);
        if ($arr_power[$id] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_array_power($rid) {
        $CI = & get_instance();
        $table_roles = $CI->db->dbprefix('roles');
        $query = $CI->db->get_where($table_roles, array('id' => $rid));
        $rs = $query->row_array();
        $str = $rs['models'];
        return json_decode($str, true);
    }

    public function get_rolesid($id) {
        $CI = & get_instance();
        $table = $CI->db->dbprefix('admins');
        $query = $CI->db->get_where($table, array('uid' => $id));
        $arr = $query->row_array();
        return intval($arr['role']);
    }

    public function get_admins($id) {
        $CI = & get_instance();
        $table = $CI->db->dbprefix('admins');
        $query = $CI->db->get_where($table, array('uid' => $id));
        $arr = $query->row_array();
        return $arr;
    }

    public function get_powerid() {
        $CI = & get_instance();
        $str = $CI->uri->uri_string();
        $table = $CI->db->dbprefix('power');
        $query = $CI->db->query('select id,controller from ' . $table);

        foreach ($query->result_array() as $row) {

            if (strchr($str, $row['controller'])) {
                return $row['id'];
                break;
            };
        }
    }

    public function set_log($table, $str) {
        $CI = & get_instance();
        $uid = $CI->session->userdata('uid');
        $admins = $this->get_admins($uid);

        $ip = $CI->input->ip_address();
        $data = array(
            'ip' => $ip,
            'username' => $admins['username'],
            'userid' => $admins['uid'],
            'time' => time(),
            'table' => $table,
            'detail' => $str
        );
        return $CI->db->insert($CI->db->dbprefix('logs'), $data);
    }

}

