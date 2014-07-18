<?php

class User extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    // the users info main, index page
    public function index(){
        $this->load->view('user_index');
    }

    public function user_list(){
        $this->load->view('user_list');
    }
    
    public function user_detail(){
        $uid=$this->uri->segment('3');
        $data['user']=$this->user_model->get_user($uid);
        $this->load->view('user_detail',$data);
    } 
    
}