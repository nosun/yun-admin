<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('message');
        //$this->load->model('admin_model');
    }

    public function index() {
        if ($this->session->userdata('uid')) {
            $data['title'] = '用户中心';
            $this->load->view('home', $data);
        } else {
            redirect(site_url('user/login'));
        }
    }

    public function login() {
        $data['title'] = '用户登录';
        $this->load->view('login');
    }

    public function check_login() {
        
        if($this->check_passwd()===true){
            redirect(site_url("user/feedback"));
        }else{
            redirect(site_url("user/feedback"));
        }
    }

    public function quit() {
        $this->session->sess_destroy();
        redirect(site_url('user/login'));
    }

    public function center() {
        $data['title'] = '用户中心';
        $this->load->view('center');
    }

    public function feedback() {
        $data['title'] = '在线反馈';
        $this->load->view('feedback', $data);
    }

    public function add_feedback() {
        $this->load->model('feedback_model');
        $this->feedback_model->add_feedback();
    }

    //校验验证码 配合前端ajax调用
    public function check_captcha() {
        @session_start();
        $this->load->library('securimage/securimage');
        $securimage = new Securimage();
        if ($securimage->check($this->input->post('captcha')) == false) {
            $result='false';
        } else {
            $result='true';
        }
           echo json_encode(array('valid' => $result));
    }
    
    //校验用户密码 配合前端ajax调用
    public function check_passwd() {
        $this->load->database();
        $user_name = $this->input->post('user_name');
        $login_pwd = $this->input->post('login_pwd');
        $login_pwd  = md5($login_pwd);
        if(!empty($user_name)&&!empty($login_pwd)){
            $sql='select id from yun_users where user_name="'.$user_name.'" and login_pwd = "'.$login_pwd.'"';
            $num=$this->db->query($sql)->num_rows();
            if($num==1){
                return true;
            }else{
                return false;
            }
        }
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

/* End of file User.php */
/* Location: ./application/controllers/welcome.php */