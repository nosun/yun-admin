<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}
class System extends Yun_Controller {

    public function __construct()
	{
        parent::__construct();
        //$this->config->load('setting');
        $this->load->model('admin_model');
		
	}
    
	function index(){
        $this->load->view('/system_main');
	}
    
    function info(){
        $this->load->view('/system_info');
    }
    
    function setting(){
        $this->load->view('/system_setting');
    }
    
    function passwd(){
        $this->load->view('/system_passwd');
    }
    
    function logs(){
        $this->load->view('/system_logs');
    }
    
    
    function members(){
        $this->load->view('/system_members');
    }
    
    
    function roles(){
        $this->load->view('/system_roles');
    }


    public function register($username, $password, $email = '', $role ='1', $state = '1')
    {
        echo $this->admin_model->add_admin(array(   'username'  =>  $username, 
                                                    'password'  =>  $password, 
                                                    'email'     =>  $email,
                                                    'role'      =>  $role,
                                                    'state'     =>  $state ));
    }
    
    
    public function change_passwd()
    {
        $uid = $this->session->userdata('uid');
        $old_pass = sha1(trim($this->input->post('old_pass', TRUE)).$this->_admin->salt);
        $stored = $this->admin_model->get_admin_by_uid($uid);
        $new_pass = trim($this->input->post('new_pass', TRUE));

        if ($stored AND $old_pass == $stored->password)
        {
            $this->admin_model->edit_admin($uid, array('password' => $new_pass));
            $this->_message("密码更新成功!", '', TRUE);   
        }
        else
        {
            $this->_message("密码验证失败!", '', TRUE);
        }
    }

}
