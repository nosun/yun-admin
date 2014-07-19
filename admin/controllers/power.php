<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Power extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    function index($id = FALSE, $pid = FALSE) {
        $data['title'] = '权限列表';
        $data['power'] = $this->admin_model->get_power();
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/power/';
        if (empty($data['power'])) {
            $ames = array(
                'str' => '没有数据，请添加！',
                'url' => $data['link_url'] . 'create'
            );
            $this->load->view('template/head', $ames);
            $this->load->view('template/message');
            $this->load->view('template/foot');
        }
        $data['power'] = $this->admin_model->get_power($id,$pid);
        $this->load->view('template/head', $data);
        $this->load->view('power/index');
        $this->load->view('template/js');
        $this->load->view('power/index_js');
        $this->load->view('template/foot');
    }

    public function create($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['id'] = $id;
        $data['title'] = '角色添加';
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/power/';
        $data['admin'] = null;
        $data['submitvalue'] = '添加';
        $data['url'] = 'power/create';

        if ($this->form_validation->run() == FALSE) {
            if ($id) {
                $data['url'].='/' . $id;
                $data['submitvalue'] = '修改';
                $data['title'] = '角色修改';
                $data['admin'] = $this->admin_model->get_power($id);
            }
            $this->load->view('template/head', $data);
            $this->load->view('power/create');
        } else {
            $this->admin_model->set_power($id);
            $ames = array(
                'str' => '添加成功！',
                'url' => $data['link_url'] . 'index'
            );
            $this->load->view('template/head', $data);
            $this->load->view('template/message', $ames);
        }
        $this->load->view('template/foot');
    }

    public function del($id) {
        $this->admin_model->del_power($id);
        $ames = array(
            'str' => '删除成功！',
            'url' => $data['link_url'] . 'index'
        );
        $this->load->view('template/head', $ames);
        $this->load->view('template/message');
        $this->load->view('template/foot');
    }

}
