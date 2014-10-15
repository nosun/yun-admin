<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class Yun_Controller extends CI_Controller {
    /**
     * _admin
     * 保存当前登录用户的信息
     *
     * @var object
     * @access  public
     * */
    public $_admin = NULL;

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->_check_login();
        if (!$this->check_power()) {
            echo '您没有访问权限';
            die();
        }
    }

    /**
     * 检查用户是否登录
     *
     * @access  protected
     * @return  void
     */
    protected function _check_login() {
        if (!$this->session->userdata('uid')) {
            redirect('login/index');
        } else {
            $this->_admin = $this->admin_model->get_full_admin($this->session->userdata('uid'), 'uid');
            if ($this->_admin->status != 1) {
                $this->message->set('error', '您的账号已被冻结，请联系管理员！');
                redirect('message/index');
            }
        }
    }

    public function check_power() {
        $id = $this->get_powerid();
        if (!$id) {
            return FALSE;
        }
        $uid = $this->session->userdata('uid');
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
        return json_decode($str, true);
    }

    public function get_rolesid($id) {
        $table = $this->db->dbprefix('admins');
        $query = $this->db->get_where($table, array('uid' => $id));
        $arr = $query->row_array();
        return intval($arr['role']);
    }

    public function get_admins($id) {
        $table = $this->db->dbprefix('admins');
        $query = $this->db->get_where($table, array('uid' => $id));
        $arr = $query->row_array();
        return $arr;
    }

    public function get_powerid() {
        $str = $this->uri->uri_string();
        $table = $this->db->dbprefix('power');
        $query = $this->db->query('select id,controller from ' . $table);

        foreach ($query->result_array() as $row) {

            if (strchr($str, $row['controller'])) {
                return $row['id'];
                break;
            };
        }
    }

    public function set_log($table, $str) {
        $uid = $this->session->userdata('uid');
        $admins = $this->get_admins($uid);
        $ip = $this->input->ip_address();
        $data = array(
            'ip' => $ip,
            'username' => $admins['username'],
            'userid' => $admins['uid'],
            'time' => time(),
            'table' => $table,
            'detail' => $str
        );
        return $CI->db->insert($CI->db->dbprefix('admin_dologs'), $data);
    }

    /**
     * 信息提示
     *
     * @access  public
     * @param $msg
     * @param string $goto
     * @param bool $auto
     * @param string $fix
     * @param int $pause
     * @return  void
     */
    public function _message($msg, $goto = '', $auto = TRUE, $fix = '', $pause = 3000) {
        if ($goto == '') {
            $goto = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url();
        } else {
            $goto = strpos($goto, 'http') !== false ? $goto : backend_url($goto);
        }
        $goto .= $fix;
        //$this->_template('sys_message', array('msg' => $msg, 'goto' => $goto, 'auto' => $auto, 'pause' => $pause));
        $data = array('msg' => $msg, 'goto' => $goto, 'auto' => $auto, 'pause' => $pause);
        $this->load->view('common/message_1', $data);
        echo $this->output->get_output();
        exit();
    }

}

/* End of file Dili_Controller.php */
/* Location: ./admin/core/Dili_Controller.php */
	
