<?php

if (!defined('BASEPATH')) {
    exit('Access Denied');
}

class Admin extends CI_Controller {

    function index() {
        $this->load->view("/views_index");
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = '添加管理员';
        $data['base_url'] = $this->config->item('base_url');
        $data['js_path'] = $this->config->item('js_path');
        $data['css_path'] = $this->config->item('css_path');
        $data['img_path'] = $this->config->item('img_path');
        $data['link_url'] = $data['base_url'] . 'index.php/admin/';
        $this->load->view('manage/templates/head', $data);
//        $this->load->view('manage/templates/css');
//        $this->load->view('manage/templates/js');
        $this->load->view('manage/templates/header');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('create');
        } else {
            $this->admin_model->
            $this->load->view('formsuccess');
        }
        $this->load->view('manage/templates/footer');
    }

}
