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

    // backend function
    function querylist($sql){
        $result =array();
        $query = $this->db->query($sql);
        if($query){
            foreach($query->result_array() as $row){
                $result[] = $row ;
            }
        }
        return $result ;
    }

    //equipment list many condition search
    function get_list($product_id=0,$category=0,$status=0,$id=0,$start_date=0,$end_date=0,$limit=0,$start=0){

        $table= $this->db->dbprefix('feedback');
        if($product_id){
            $this->db->where("$table.product_id",$product_id);
        }
        if($category){
            $this->db->where("$table.category",$category);
        }
        if($status){
            $this->db->where("$table.status",$status);
        }
        if($id){
            $this->db->where("$table.id",$id);
        }
        if($start_date){
            $this->db->where("$table.add_time >",$start_date);
        }
        if($end_date){
            $this->db->where("$table.add_time <",$end_date);
        }
        if ($limit)
        {
            $this->db->limit($limit);
        }
        if ($start)
        {
            $this->db->offset($start);
        }
        $res=$this->db->from($table)->get()->result_array();
        //echo $this->db->last_query();
        return($res);
    }

    //search result affected rows for paganation
    function get_num($product_id=0,$category=0,$status=0,$id=0,$start_date=0,$end_date=0){

        $table= $this->db->dbprefix('feedback');
        if($product_id){
            $this->db->where("$table.product_id",$product_id);
        }
        if($category){
            $this->db->where("$table.category",$category);
        }
        if($status){
            $this->db->where("$table.status",$status);
        }
        if($id){
            $this->db->where("$table.id",$id);
        }
        if($start_date){
            $this->db->where("$table.add_time >",$start_date);
        }
        if($end_date){
            $this->db->where("$table.add_time <",$end_date);
        }

        $this->db->from($table)->get()->result();

        return $this->db->affected_rows() ;

    }
}