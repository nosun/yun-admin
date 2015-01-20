<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends Yun_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');

    }

    function index() {
        $this->load->view('system/system_main');
    }

    function info() {
        $this->load->model('log_model');
        $this->load->model('roles_model');
        $uid=$this->session->userdata('uid');
        $user=$this->admin_model->get_full_admin($uid,'uid');
        $data['title'] = '系统信息';
        $data['login_num']=$this->log_model->get_logs_login_num(0,0,$user->username);
        $data['last_login']=$this->log_model->get_logs_login(0,0,$user->username,1,0,'logintime desc');
        $data['role'] =$this->roles_model->get_role($user->role);
        $this->load->view('system/system_info',$data);
    }

    function setting() {
        $data['title'] = '系统设置';
        $data['settings'] = $this->db->get($this->db->dbprefix('admin_setting'))->row();
        $this->load->view('common/header');
        $this->load->view('system/system_setting', $data);
        $this->load->view('common/footer');
    }

    function cache(){
        $data['title'] = '更新缓存';
        $this->load->view('system/system_cache', $data);
    }
    function logs_login() {
        $data['title'] = '登陆日志';
        $this->load->view('common/header', $data);
        $this->load->view('system/system_logs_login');
        $this->load->view('common/footer');
    }

    function logs_action() {
        $data['title'] = '操作日志';
        $this->load->view('common/header', $data);
        $this->load->view('system/system_logs_action');
        $this->load->view('common/footer');
    }

    public function change_site_settings() {
        $update_data = $this->input->post();
        $update_data['not_oper_time'] = json_encode($this->input->post('not_oper_time'));
        ;

        $ret = $this->db->update($this->db->dbprefix('settings'), $update_data);
        //update_cache('backend');
        if ($ret == TRUE) {
            // the message function at Yun_controller
            $this->_message("更新成功", '', TRUE);
        } else {
            $this->_message("更新失败", '', TRUE);
        }
    }

}
