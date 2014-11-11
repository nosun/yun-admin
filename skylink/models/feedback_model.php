<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Feedback_Model extends Yun_Model{
    
    public $tb_feedback;
    public $tb_reply;
    public function __construct() {
        parent::__construct();
        $this->tb_feedback=$this->db->dbprefix('feedback');
        $this->tb_reply=$this->db->dbprefix('feedback_reply');
    }
    
    public function add_feedback(){
        $category=$this->input->post('category');
        $title=$this->input->post('title');
        $content=$this->input->post('content');
        $product=$this->input->post('product');
        $user_name=$this->session->userdata('uid');
        $data = array(
               'category' => $category ,
               'title' => $title,
               'content' => $content,
               'product' => $product,
               'user_name' => $user_name,
               'addtime' => time(),
               'status'  => 1
            );
        $this->db->insert($this->tb_feedback, $data);
    }
    
    public function get_feedback($user_name,$limit=10,$offset=0){
        $this->db->from($this->tb_feedback);
        $this->db->where('user_name',$user_name);
        $this->db->order_by('id','desc');
        if ($limit)
        {
            $this->db->limit($limit);
        }
        if ($offset)
        {
            $this->db->offset($offset);
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    
    public function insert_user_reply($fid,$user_name,$content){
        $data = array(
            'fid'       =>$fid,
            'user_name' =>$user_name,
            'content'   =>$content,
            'addtime'   =>time(),
            'role'      =>1
        );
        $this->db->insert($this->tb_reply,$data);
    }
    
    public function get_rely_by_id($id){
        $this->db->from($this->tb_reply);
        $this->db->where('fid',$id);
        $this->db->order_by("id", "asc"); 
        $query = $this->db->get();
        return $query;
    }
    
}