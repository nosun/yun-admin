<?php

class Equipments extends CI_Controller{
        public function __construct()
        {
                parent::__construct();
                $this->load->model('equip_model');
                $this->load->library('pagination');
        }
       
        function eq_cat_list(){
            $this->load->view('equip_cat_list');
        }
                
        
        
        
        
	function eq_list(){
            $this->load->library('pagination');
            $config['per_page'] = 5;
            $config['uri_segment'] = 8;
            
            //there is two situation on getting arguments,one is from form,the other is from page uri.
            if (!empty($this->uri->segment(8))){
                $product_id=$this->uri->segment(3);
                $s_key     =$this->uri->segment(4);
                $s_value   =$this->uri->segment(5);                
                $start_date=$this->uri->segment(6);                
                $end_date  =$this->uri->segment(7);     
            }else{
                $product_id =$this->input->get('product_id')?$this->input->get('product_id'):0;
                $s_key      =$this->input->get('s_key')?$this->input->get('s_key'):'';
                $s_value    =$this->input->get('s_value')?$this->input->get('s_value'):'';
                $start_date =$this->input->get('start_date')?strtotime($this->input->get('start_date')):'1399154400';
                $end_date   =$this->input->get('end_date')?strtotime($this->input->get('end_date')):  time();
            }
            
            // search segments
            $segments   = $product_id.'/'.$s_key.'/'.$s_value.'/'.$start_date.'/'.$end_date ;   
            $limit      = $config['per_page'];
            $offset     = $this->uri->segment(8) ? ($this->uri->segment(8)-1)*$config['per_page'] : 0;    
            
            //sql select
            $data['eqlist'] =$this->equip_model->search($product_id,$start_date,$end_date,$s_key,$s_value,$limit,$offset);
            $query_count=$this->equip_model->query_count($product_id,$start_date,$end_date,$s_key,$s_value);
            
            // page setting
            $config['base_url'] = site_url('equipments/index').'/'.$segments;
            $config['total_rows'] = $query_count;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            // save data for views
            $data['product_id'] = $product_id;
            $data['s_key']      = $s_key;
            $data['s_value']    = $s_value;            
            $data['start_date'] = $start_date;           
            $data['end_date']   = $end_date;           
            
            $this->load->view('equip_list',$data);
	}	     
        
    
    
    
    
}