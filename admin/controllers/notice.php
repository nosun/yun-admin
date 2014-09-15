<?php

class Notice extends CI_Controller {
    
    function index(){
            $data['title']='消息队列';
            $this->load->view('common/header',$data);
            $this->load->view('tools/notice');
            $this->load->view('common/footer');
        }
}
