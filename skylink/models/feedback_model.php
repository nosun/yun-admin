<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Feedback_Model extends CI_Model{
    
    public $tb_feedback;
    public $tb_comment;
    public function __construct() {
        parent::__construct();
        $this->tb_feedback=$this->db->dbprefix('feedback');
        $this->tb_comment=$this->db->dbprefix('feedback_comments');
    }
    
    public function add_feedback(){
        $category=$this->input->post('category');
        $title=$this->input->post('title');
        $content=$this->input->post('content');
        $product=$this->input->post('product');
        $user_name=$this->input->post('user_name');
        $data = array(
               'category' => $category ,
               'title' => $title,
               'content' => $content,
               'product' => $product,
               'user_name' => $user_name,
               'addtime' => time(),
               'status'  => 1
            );
        exit(0);
        $this->db->insert($this->tb_feedback, $data);
    }
    
    
}