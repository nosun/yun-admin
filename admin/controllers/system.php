<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}
class System extends CI_Controller {

    	public function __construct()
	{
                parent::__construct();
                $this->config->load('setting');
	}
        
	function index(){
            if ($this->session->userdata('uid'))
            {
                    $this->load->view('/system_main');
            }
            else
            {       
                    redirect(config_item('backend_access').'/login');
            }
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
}
