<?php

class Feedback extends Yun_Controller {
    
    function index(){
            $data['title']='留言反馈';
            $data['equip_cat']=$this->cache->get('equip_cat');
            $data['feedback_cat']=$this->cache->get('feedback_cat');
            $data['feedback_status']=$this->config->item('feedback_status');
            $this->load->view('common/header',$data);
            $this->load->view('tools/feedback');
            $this->load->view('common/footer');
        }

    function show(){
        $data['title']='查看详情';
        $this->load->model('feedback_model');
        $id=$this->uri->segment(3);
        if(!empty($id)){
            $feedback= $this->feedback_model->get_by_id($this->db->dbprefix('feedback'),$id);
            $status=$this->cache->get('feedback_status');
            $feed_cate= $this->cache->get('feedback_cat');
            $feedback=$this->chword($feedback,'status', $status);
            $feedback=$this->chword($feedback,'category', $feed_cate);
            $data['fb_main']=$feedback[0];
            $fb_reply=$this->feedback_model->get_rely_by_id($id);
            if($fb_reply->result_array()){
                $data['fb_reply']=$fb_reply->result_array();
            }else{
                $data['fb_reply']=array();
            }
            $this->load->view('tools/feedback_view', $data);
        }else{
            redirect('feedback/index');
        }
    }

    function chword($data,$key,$words){
        foreach($data as $p){
            $p[$key]=$words[$p[$key]];
            $array_group[]=$p;
        }
        return $array_group;
    }
}
