<?php

class User extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    // the users info main, index page
    public function index(){
        $data['title'] = '用户概况';        
        $this->load->view('common/header',$data);
        $this->load->view('user/user_index');
        $this->load->view('common/footer');        
    }

    public function user_list(){
        $data['title'] = '用户列表';        
        $this->load->view('common/header',$data);
        $this->load->view('user/user_list');
        $this->load->view('common/footer');     
    }
    
    public function user_detail(){
        $uid=$this->uri->segment('3');
        $data['user']=$this->user_model->get_user($uid);
        $data['title'] = '用户详情';        
        $this->load->view('common/header',$data);
        $this->load->view('user/user_detail');
        $this->load->view('common/footer');             
    } 
    
}