<?php

class User extends Yun_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    // the users info main, index page
    public function count_d(){
        $action=$this->uri->segment('3');
        $day=$this->uri->segment('4');
        if($day){ //search for someday the time format is unix time;
            $data['dataurl']='../../../data/user_count_d/'.$action.'/'.$day;
            $data['date']=$day;
        }else{ //set the day today
            $data['date']=date('Y-n',time());
            $data['dataurl']='../../data/user_count_d/'.$action.'/'.$data['date'];
        }
        if($action=='reg_all'){
            $data['title']='用户概况';
            $data['chart']='lineCfg';
        }
        if($action=='reg_new'){
            $data['title']='新注册用户';
            $data['chart']='columnCfg';            
        }
        $data['action']=$action;
        
        $this->load->view('common/header',$data);
        $this->load->view('user/count_d');
        $this->load->view('common/footer');        
    }

    public function user_list(){
        $data['title'] = '用户列表';        
        $this->load->view('common/header',$data);
        $this->load->view('user/list');
        $this->load->view('common/footer');     
    }
    
    public function user_detail(){
        $uid=$this->uri->segment('3');
        $data['user']=$this->user_model->get_user($uid);
        $data['title'] = '用户详情';        
        $this->load->view('common/header',$data);
        $this->load->view('user/detail');
        $this->load->view('common/footer');             
    } 
    // the users info main, index page
    public function aera(){
        $data['title'] = '地区分布';        
        $this->load->view('common/header',$data);
        $this->load->view('user/aera');
        $this->load->view('common/footer');        
    }
        // the users info main, index page
    public function reg_new(){
        $data['title'] = '最新注册';        
        $this->load->view('common/header',$data);
        $this->load->view('user/reg_new');
        $this->load->view('common/footer');        
    }
    
    // the users info main, index page
    public function agent(){
        $data['title'] = '客户端分析';
        if($this->uri->segment('3')){
            $data['action']=$this->uri->segment('3');
        }else{
            $data['action']='agent';
        }
        $data['dataurl']=base_url().'data/user_agent/'.$data['action'];
        $this->load->view('common/header',$data);
        $this->load->view('user/agent');
        $this->load->view('common/footer');        
    }
}