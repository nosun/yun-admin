<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
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
        $data['admins'] = $this->admin_model->get_admin();
        $this->load->view('admin/admin_data', $data);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');
//        $data['id'] = $id;
//        $data['title'] = '添加管理员';
//        $data['base_url'] = $this->config->item('base_url');
//        $data['link_url'] = $data['base_url'] . 'index.php/admin/';
//        $data['admin'] = null;
//        $data['submitvalue'] = '添加';
//        $data['url'] = 'admin/create';
//
//        if ($this->form_validation->run() == FALSE) {
//            if ($id) {
//                $data['url'].='/' . $id;
//                $data['submitvalue'] = '修改';
//                $data['title'] = '管理员修改';
//                $data['admin'] = $this->admin_model->get_admin($id);
//            } else {
//                $this->form_validation->set_rules('username', 'username', 'required');
//                $this->form_validation->set_rules('password', 'password', 'required');
//            }
//            $data['roles'] = $this->admin_model->get_roles();
//            $this->load->view('template/head', $data);
//            $this->load->view('admin/create');
//        } else {
//        }
//        $this->load->view('template/head', $data);
        $id = $this->input->post('uid');

        $this->admin_model->set_admin($id);
//        $ames = array(
//            'str' => '添加成功！',
//            'url' => $data['link_url'] . 'index'
//        );
//        $this->load->view('template/message', $ames);
//        $this->load->view('template/foot');
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->admin_model->del_admin($id);
    }

}