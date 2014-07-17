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
                $s_key      =$this->input->get('s_key')?$this->input->get('s_key'):0;
                $s_value    =$this->input->get('s_value')?$this->input->get('s_value'):0;
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
            $config['base_url'] = site_url('equipments/eq_list').'/'.$segments;
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
        
        function index(){
            $data['title']  = '设备概况';
            $this->load->view('equip_index',$data);    
            
        }
        
        
        
}