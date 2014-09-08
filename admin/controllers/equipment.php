<?php

class Equipment extends CI_Controller{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('equip_model');
                $this->load->library('pagination');
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

        function eq_cat_list(){
            $data['title']  = '设备型号';
            $this->load->view('common/header',$data);
            $this->load->view('equip/cat_list'); 
            $this->load->view('common/footer');
        }
        
	function eq_list(){
            $data['title']  = '设备列表';
            $this->load->view('common/header',$data);
            $this->load->view('equip/list'); 
            $this->load->view('common/footer');
	}
        
        function index(){
            $data['title']  = '设备概况';
            $this->load->view('common/header',$data);
            $this->load->view('equip/index'); 
            $this->load->view('common/footer');
        }
        
        //show aera analysis
        function aera(){
            $data['title']='设备分布';
            $this->load->view('common/header',$data);
            $this->load->view('equip/aera'); 
            $this->load->view('common/footer');
        }

        //show aera analysis
        function reg_new(){
            $data['title']='新增设备';
            $this->load->view('common/header',$data);
            $this->load->view('equip/reg_new'); 
            $this->load->view('common/footer');  
        }
        
        //show aera analysis
        function reg_all(){
            $data['title']='所有设备';
            $this->load->view('common/header',$data);
            $this->load->view('equip/reg_all'); 
            $this->load->view('common/footer');  
        } 
        
         //show aera analysis
        function online(){
            $data['title']='设备在线';
            $this->load->view('common/header',$data);
            $this->load->view('equip/online'); 
            $this->load->view('common/footer');   
        }
        function filter(){
            $data['title']='滤网到期';
            $this->load->view('common/header',$data);
            $this->load->view('equip/filter'); 
            $this->load->view('common/footer'); 
        }                
        
        
}