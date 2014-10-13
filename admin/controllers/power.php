<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Power extends Yun_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('Yun_Check');
    }

    function index($id = FALSE, $pid = FALSE) {
        $data['title'] = '权限列表';
        $data['power'] = $this->admin_model->get_power();
        $data['base_url'] = $this->config->item('base_url');
        $data['link_url'] = $data['base_url'] . 'index.php/power/';
        $data['power'] = $this->admin_model->get_power($id, $pid);
        $this->load->view('common/header', $data);
        $this->load->view('power/index');
        $this->load->view('common/footer');
    }

    function power_data() {
        $offset = $this->input->post('start');
        $limit = $this->input->post('limit');
        $data = array();
        $num = $this->admin_model->get_num('power');
        $power = $this->admin_model->get_power();
        $str_json = json_encode($power);
        $data['str_json'] = '{"rows":' . $str_json . ', "results":' . $num . '}';
        $this->load->view('power/power_data', $data);
    }

    public function create($id = NULL) {
        $id = $this->input->post('id');
        $this->admin_model->set_power($id);
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->admin_model->del_power($id);
    }

}
