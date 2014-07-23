<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('yun_check');

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
            $this->load->view('template/head', $ames);
            $this->load->view('template/message');
            $this->load->view('template/foot');
        }
        $data['roles'] = $this->admin_model->get_roles();
        $this->load->view('template/head', $data);
        $this->load->view('admin/index');
        $this->load->view('template/foot');
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

}