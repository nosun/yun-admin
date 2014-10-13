<?php

class Roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('Yun_Check');
    }

    function index() {
        $data['title'] = '角色列表';
        $data['roles'] = $this->admin_model->get_roles();
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/roles/';
        $data['roles'] = $this->admin_model->get_roles();
        $this->load->view('common/header', $data);
        $this->load->view('roles/index');
        $this->load->view('common/footer');
    }

    function roles_data() {
        $offset = $this->input->post('start');
        $limit = $this->input->post('limit');
        $data = array();
        $num = $this->admin_model->get_num('roles');
        $roles = $this->admin_model->get_roles();
        $str_json = json_encode($roles);
        $data['str_json'] = '{"rows":' . $str_json . ', "results":' . $num . '}';
        $this->load->view('roles/roles_data', $data);
    }

    public function create($id = NULL) {
        $id = $this->input->post('id');
        $models = $this->admin_model->get_jsonstr_power($id);
        $this->admin_model->set_roles($models, $id);
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->admin_model->del_roles($id);
    }

    public function power($id = FALSE) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['id'] = $id;
        $data['title'] = '权限设置';
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . '/roles/';
        if (!$this->input->post('action')) {
            $data['powers'] = $this->admin_model->get_power();
            $data['roles'] = $this->admin_model->get_roles($id);
            $str_models = $data['roles']['models'];
            $data['models'] = json_decode($str_models, TRUE);
            $this->load->view('common/header', $data);
            $this->load->view('roles/setpower');
        } else {
            $models = $this->input->post('models');
            $json_powers = $this->admin_model->get_jsonstr_power();

            $arr_powers = json_decode($json_powers, true);

            foreach ($models as $m) {
                $arr_powers[$m] = 1;
            }

            $str = json_encode($arr_powers);

            $this->admin_model->set_roles($str, $id);
        }
        $this->load->view('common/footer');
    }

}
