<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    public $user_name;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->user_name=$this->session->userdata('uid');
        $this->_check_login();
        
    }

    private function _check_login() {
        if (empty($this->user_name)) {
            redirect(site_url('login'));
        }
    }

    public function home() {
        $data['title'] = '用户中心';
        $this->load->view('home', $data);
    }
    
    public function feedback_add() {
        $data['title'] = '在线反馈';
        $this->load->view('feedback_add', $data);
    }

    public function add_feedback() {
        $this->load->model('feedback_model');
        $this->feedback_model->add_feedback();
    }
    
    public function feedback() {
        $data['title'] = '反馈列表';
        $this->load->model('feedback_model');
        $limit=10;
        $offset=0;
        $data['feedback']= $this->feedback_model->get_feedback($this->user_name,$limit,$offset);
        $this->load->view('feedback', $data);
    }

    public function feedback_view() {
        $this->load->model('feedback_model');
        $data['title'] = '查看反馈';
        $id=$this->uri->segment(3);
        if(!empty($id)){
            $data['fb_main']= $this->feedback_model->get_by_id($this->db->dbprefix('feedback'),$id);
            $fb_reply=$this->feedback_model->get_rely_by_id($id);
            if($fb_reply->result_array()){
                $data['fb_reply']=$fb_reply->result_array();
            }else{
                $data['fb_reply']=array();
            }
            $this->load->view('feedback_view', $data);            
        }else{
            redirect('user/feedback');
        }

    }
    
    public function feedback_reply() {
        $this->load->model('feedback_model');
        $data['title'] = '查看反馈';
        $id=$this->uri->segment(3);
        $content=  $this->input->post('content');
        if(!empty($id) && !empty($content)){
            $this->feedback_model->insert_user_reply($id,$this->user_name,$content);
        }
        redirect(site_url('user/feedback_view/'.$id));

    }

}
/* End of file User.php */
/* Location: ./application/controllers/welcome.php */