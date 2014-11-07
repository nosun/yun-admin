<?php

class Login extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('message');        
    }

    public function index() {
        $data['title'] = '用户登录';
        $this->load->view('login');
    }

    public function check_login() {
        $this->load->model('user_model');
        $user_name = $this->input->post('user_name');
        $login_pwd = $this->input->post('login_pwd');
        if (empty($user_name) || empty($login_pwd)) {
            $result = false;
        } else {
            $result = $this->user_model->check_passwd($user_name, $login_pwd);
        }
        if ($result === true) {
            $this->session->set_userdata('uid', $user_name);
            redirect(site_url("user/home"));
        } else {
            $this->message->set('error', '您的用户名密码输入不正确!');
            redirect(site_url("login"));
        }
    }

    public function quit() {
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
    
    //校验验证码 配合前端ajax调用
    public function check_captcha() {
        @session_start();
        $this->load->library('securimage/securimage');
        $securimage = new Securimage();
        if ($securimage->check($this->input->post('captcha')) == false) {
            $result = 'false';
        } else {
            $result = 'true';
        }
        echo json_encode(array('valid' => $result));
    }

    public function securimage() {
        $this->load->config('securimage');
        $allsettings = array_merge($this->config->item('si_easy'), $this->config->item('si_general'));
        $this->load->library('securimage/securimage');
        $img = new Securimage($allsettings);
        $img->captcha_type = Securimage::SI_CAPTCHA_MATHEMATIC;
        $img->show(APPPATH . 'libraries/securimage/backgrounds/bg6.png');
    }    
    
}