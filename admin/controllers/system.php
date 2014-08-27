<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}
class System extends Yun_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('admin_model');
		
	}
    
    function index(){
        $this->load->view('system/system_main');
    }

    function info(){
        $data['title'] = '系统信息';        
        $this->load->view('common/header');
        $this->load->view('system/system_info');
        $this->load->view('common/footer');
    }

    function setting(){
        $data['title'] = '系统设置';        
        $data['settings'] = $this->db->get($this->db->dbprefix('settings'))->row();
        $this->load->view('common/header');
        $this->load->view('system/system_setting', $data);
        $this->load->view('common/footer');
    }
    
    function logs_login(){
        $data['title'] = '登陆日志';   
        $this->load->view('common/header',$data);
        $this->load->view('system/system_logs_login');
        $this->load->view('common/footer');
    }    
    
    function logs_action(){
        $data['title'] = '操作日志';   
        $this->load->view('common/header',$data);
        $this->load->view('system/system_logs_action');
        $this->load->view('common/footer');
    }    
    
    public function change_site_settings()
    {
        $update_data = $this->input->post();
        $update_data['not_oper_time'] = json_encode($this->input->post('not_oper_time'));;

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
