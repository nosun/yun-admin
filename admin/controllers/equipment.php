<?php

class Equipment extends CI_Controller{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('equip_model');
                $this->load->library('pagination');
        }
       
        function eq_cat_list(){
            $this->load->view('equip_cat_list');
        }
        
        function eq_cat_update(){
            $id=  $this->input->post('id');
            $data= array(
                "model"=> $this->input->post('model'),
                "name"=> $this->input->post('name'),
                "show_time"=> $this->input->post('show_time'),
                "info"=> $this->input->post('info'),
            );
            $this->equip_model->update_eq_cat($id,$data);
        } 
        
        function eq_cat_insert(){
            $data= array(
                "model"=> $this->input->post('model'),
                "name"=> $this->input->post('name'),
                "show_time"=> $this->input->post('show_time'),
                "info"=> $this->input->post('info'),
            );
            $this->equip_model->insert_eq_cat($data);
        }
        
        function eq_cat_delete(){
            $my_ids='';
            $ids=  $this->input->post('ids');
            foreach ($ids as $id){
                $my_ids=$my_ids.','.$id;
            }
            $my_ids=trim($my_ids,',');
            $sql='delete from yun_device_class where id in ('.$my_ids.')';
            $this->db->query($sql);
        }
        
	function eq_list(){
            $this->load->view('equip_list');
	}
        
        function index(){
            $data['title']  = '设备概况';
            $this->load->view('equip_index',$data);    
            
        }
        
        //show aera analysis
        function aera(){
            $data['title']='设备分布';
            $this->load->view('equip_aera',$data);   
        }

        //show aera analysis
        function regment(){
            $data['title']='设备注册';
            $this->load->view('equip_regment',$data);   
        }   

         //show aera analysis
        function online(){
            $data['title']='设备在线';
            $this->load->view('equip_online',$data);   
        }
        function filter(){
            $data['title']='滤网到期';
            $this->load->view('equip_filter',$data);   
        }                
        
        
}