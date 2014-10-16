<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Yun_Controller extends CI_Controller {
    
    public $_admin = NULL;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->library('message');        
        $this->_admin = $this->admin_model->get_full_admin($this->session->userdata('uid'), 'uid');
        $this->_check_login();
        $this->_check_rights();
    }

    protected function _check_login() {
        if (empty($this->_admin)) {
            redirect('login/index');
        } else {
            if ($this->_admin->status != 1) {
                $this->message->set('error', '您的账号已被冻结，请联系管理员！');
                redirect('login/index');
            }
        }
    }

    protected function _check_rights() {
        $this->load->model('rights_model');
        $str = $this->uri->uri_string();
        $id = $this->rights_model->get_powerid($str);
        if (!$id) {
            echo '您没有访问权限！';
            die();
        }
        $uid = $this->session->userdata('uid');
        if (!$uid) {
            $this->message->set('error', '您尚未登录，请登录后进行操作！');
            redirect('login/index');
        }        
        $rid = $this->admin_model->get_rolesid($uid);
        $arr_power = $this->rights_model->get_array_power($rid);
        if ($arr_power[$id] != 1) {
            echo '您没有访问权限！';
            die();
        }
    }

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
	
