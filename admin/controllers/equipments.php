<?php

class Equipments extends CI_Controller{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('equip_model');
        }
   
	function index(){
            $limit      =5;
            
            if (!empty($this->uri->segment[3])){
                $product_id=$this->uri->segment[3];
                $s_key     =$this->uri->segment[4];
                $s_value   =$this->uri->segment[5];                
                $start_date=$this->uri->segment[6];                
                $end_date  =$this->uri->segment[7];                 
            }else{
                $product_id =$this->input->get('product_id')?$this->input->get('product_id'):0;
                $s_key      =$this->input->get('s_key')?$this->input->get('s_key'):0;
                $s_value    =$this->input->get('s_value')?$this->input->get('s_value'):0;
                $start_date =$this->input->get('start_date')?$this->input->get('start_date'):0;
                $end_date   =$this->input->get('end_date')?$this->input->get('end_date'):0;                
            }    

            $segments   = $product_id.'/'.$s_key.'/'.$s_value.'/'.$start_date.'/'.$end_date ;   
            $where      ="1=1 and ";
            
            
            $offset     = $this->uri->segment(8) ? $this->uri->segment(8) : 0;    
            
            $data['eqlist'] =$this->equip_model->search($product_id,$start_date,$end_date,$s_key,$s_value,$limit,$offset);
            $query_count=$this->equip_model->query_count($product_id,$start_date,$end_date,$s_key,$s_value);
            
            //加载分页
            $this->load->library('pagination');
            $config['base_url'] = site_url('equipments/index').'/'.$segments;
            $config['per_page'] = 5;
            $config['total_rows'] = $query_count;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->load->view('equip_index',$data);
	}	     
        
    
    
    
    
}