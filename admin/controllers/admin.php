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
        $id = $this->input->post('uid');
        $this->admin_model->set_admin($id);
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->admin_model->del_admin($id);
    }

}