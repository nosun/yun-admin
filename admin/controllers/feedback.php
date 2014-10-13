<?php

class Feedback extends Yun_Controller {
    
    function index(){
            $data['title']='留言反馈';
            $this->load->view('common/header',$data);
            $this->load->view('tools/feedback');
            $this->load->view('common/footer');
        }
}
