<?php

class Roles extends Yun_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('roles_model');
    }

    function index() {
        $data['title'] = '角色列表';
        $this->load->view('admin/roles',$data);
    }

    public function create($id = NULL) {
        $id = $this->input->post('id');
        $this->load->model('rights_model');
        $models = $this->rights_model->get_jsonstr_power($id);
        $this->roles_model->set_roles($models, $id);
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->roles_model->del_roles($id);
    }

    public function rights_list($id) {
        $this->load->helper('msg');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('rights_model');
        $data['id'] = $id;
        $data['title'] = '权限设置';
        $data['powers'] = $this->rights_model->rights_list();
        $data['roles'] = $this->roles_model->get_role($id);
        $str_models = $data['roles']['models'];
        $data['models'] = json_decode($str_models, TRUE);
        $this->load->view('admin/setpower',$data);
    }
    
    public function set_rights($id){
        
        $models = $this->input->post('models');
        $json_powers = $this->rights_model->get_jsonstr_power();
        $arr_powers = json_decode($json_powers, true);
        foreach ($models as $m) {
            $arr_powers[$m] = 1;
        }
        $str = json_encode($arr_powers);
        $this->roles_model->set_roles($str, $id);
        $this->session->set_flashdata( 'message', array( 'title' => '消息提示', 'content' => '权限已经设置成功', 'type' => 'message' )); 
        redirect('roles/rights_list/'.$id);
    }        
}
