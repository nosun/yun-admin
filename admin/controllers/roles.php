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
        $data['title'] = '角色列表';
        $data['roles'] = $this->admin_model->get_roles();
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/roles/';
        if (empty($data['roles'])) {
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
        $this->load->view('roles/index');
        $this->load->view('template/js');
        $this->load->view('roles/index_js');
        $this->load->view('template/foot');
    }

    public function create($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['id'] = $id;
        $data['title'] = '角色添加';
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/roles/';
        $data['admin'] = null;
        $data['submitvalue'] = '添加';
        $data['url'] = 'roles/create';

        if ($this->form_validation->run() == FALSE) {
            if ($id) {
                $data['url'].='/' . $id;
                $data['submitvalue'] = '修改';
                $data['title'] = '角色修改';
                $data['roles'] = $this->admin_model->get_roles($id);
            }
            $this->load->view('template/head', $data);
            $this->load->view('roles/create');
        } else {
            $models = $this->admin_model->get_jsonstr_power($id);
            $this->admin_model->set_roles($models, $id);
            $ames = array(
                'str' => '操作成功！',
                'url' => $data['link_url'] . 'index'
            );
            $this->load->view('template/head', $data);
            $this->load->view('template/message', $ames);
        }
        $this->load->view('template/foot');
    }

    public function del($id) {
        $this->admin_model->del_roles($id);
        $ames = array(
            'str' => '删除成功！',
            'url' => $data['link_url'] . 'index'
        );
        $this->load->view('template/head', $ames);
        $this->load->view('template/message');
        $this->load->view('template/foot');
    }

    public function set_roles_power($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['id'] = $id;
        $data['title'] = '权限设置';
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/roles/';
        if ($this->form_validation->run() == FALSE) {
            $data['powers'] = $this->admin_model->get_power();
            $data['roles'] = $this->admin_model->get_roles($id);
            $data['models'] = $data['roles']['models'];
            $data['models'] = json_decode($data['models'], TRUE);
            $this->load->view('template/head', $data);
            $this->load->view('roles/setpower');
            $this->load->view('template/js');
            $this->load->view('roles/form_js');
        } else {
            $models = $this->input->post['models'];
            $json_powers = $this->admin_model->get_json_power();
            $arr_powers = json_decode($json_powers);
            $arr_models = explode(',', $models);
            foreach ($arr_models as $m) {
                $arr_models[$m] = 1;
            }
            $models = json_encode($arr_models);
            $this->admin_model->set_roles($models, $id);
        }
        $this->load->view('template/foot');
    }

}
