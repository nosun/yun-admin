<?php if (!defined('BASEPATH')) { exit('Access Denied');}

class Rights extends Yun_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rights_model');
    }

    function index($id = FALSE, $pid = FALSE) {
        $data['title'] = '权限列表';
        $this->load->view('admin/rights',$data);
    }

    public function create($id = NULL) {
        $id = $this->input->post('id');
        $this->rights_model->set_power($id);
    }

    public function del() {
        $this->load->helper('form');
        $id = $this->input->post('ids');
        $this->rights_model->del_power($id);
    }

}
