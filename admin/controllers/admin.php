<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Admin extends Yun_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('yun_check');
        $this->load->helper('msg');        

    }

    function index() {
        $data['title'] = '管理员列表';
        $data['admins'] = $this->admin_model->get_admin();
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/admin/';
        if (empty($data['admins'])) {
            $ames = array(
                'str' => '没有数据，请添加！',
                'url' => $data['link_url'] . 'create'
            );
            $this->load->view('common/header', $ames);
            $this->load->view('common/message');
            $this->load->view('common/footer');
        }
        $data['roles'] = $this->admin_model->get_roles();
        $this->load->view('common/header', $data);
        $this->load->view('admin/index');
        $this->load->view('common/footer');
    }

    function passwd(){
        $data['title'] = '修改密码';        
        $this->load->view('common/header',$data);
        $this->load->view('admin/passwd');
        $this->load->view('common/footer');        
    }
    
    
    function admin_data() {
        $offset = $this->input->post('start');
        $limit = $this->input->post('limit');
//        var_dump($offset);
//        var_dump($limit);
//        die();
        $data = array();
        $num = $this->admin_model->get_num('admins');
        $admins = $this->admin_model->get_admin();   
        $str_json = json_encode($admins);
        $data['str_json']='{"rows":'.$str_json.', "results":'.$num.'}';
        $this->load->view('admin/admin_data', $data);
    }

    public function create() {
        $id = $this->input->post('uid');
        $this->admin_model->set_admin($id);
        if($id){
            $this->yun_check->set_log('admins','修改用户'.$this->input->post('username').'(id:'. $this->input->post('uid').')');
        }else{
            $this->yun_check->set_log('admins','添加用户'.$this->input->post('username'));
            
        }
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->admin_model->del_admin($id);
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
        $stored = $this->admin_model->get_admin_by_uid($uid);
        $old_pass = sha1($this->input->post('old_pass', TRUE).$stored->salt);
        $new_pass = trim($this->input->post('new_pass', TRUE));
        if ($stored AND $old_pass == $stored->password)
        {
            $this->admin_model->edit_admin($uid, array('password' => $new_pass));
            $this->session->set_flashdata( 'message', array( 'title' => '密码更新成功', 'content' => '您的密码已经修改成功', 'type' => 'message' )); 
            //helper message function, display by jquery, find it at admin/helpers/msg_helper.php
            redirect('admin/passwd');  
        }
        else
        {
            $this->session->set_flashdata( 'message', array( 'title' => '更新密码失败', 'content' => '旧密码输入不正确，请重试', 'type' => 'message' )); 
            redirect('admin/passwd');
        }
    }
    
}