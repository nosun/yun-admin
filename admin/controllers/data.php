<?php

    class Data extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
        }
        
        function eq_cat() {
            $this->load->model('equip_model');
            $offset=$this->input->post('start');
            $limit=$this->input->post('limit');
            $cat_list=$this->equip_model->get_eq_cat($limit,$offset);
            $num=$this->equip_model->get_eq_cat_num();
            
            $data=json_encode($cat_list);
            $data='{"rows":'.$data.', "results":'.$num.'}';
            $this->_output_json($data);
        }
        
        function _output_json($data){
            $this->output
                    ->set_content_type('application/json')
                    ->set_output($data);
        }
        
        function eq_list(){
            $this->load->model('equip_model');
            $product_id =$this->input->post('product_id');
            $s_key      =$this->input->post('s_key');
            $s_value    =$this->input->post('s_value');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $eq_list=$this->equip_model->get_eq_list($product_id,$start_date,$end_date,$s_key,$s_value,$limit,$start);
            $num=$this->equip_model->get_eq_num($product_id,$start_date,$end_date,$s_key,$s_value);
            
            $data=json_encode($eq_list);
            $data='{"rows":'.$data.', "results":'.$num.'}';
            $this->_output_json($data);
            
        }
        
        function user_list(){
            $this->load->model('user_model');
            $s_key      =$this->input->post('s_key');
            $s_value    =$this->input->post('s_value');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $user_list=$this->user_model->get_user_list($start_date,$end_date,$s_key,$s_value,$limit,$start);
            $num=$this->user_model->get_user_num($start_date,$end_date,$s_key,$s_value);
            
            $data=json_encode($user_list);
            $data='{"rows":'.$data.', "results":'.$num.'}';
            $this->_output_json($data);
            
        }
        
        function user_eq_list(){
            $this->load->model('equip_model');
            $uid=$this->uri->segment('3');
            $list=$this->equip_model->get_user_eq_list($uid);
            $data=json_encode($list);
            $this->_output_json($data);
        }
        
        function log_list(){
            $this->load->model('log_model');
            $s_key      =$this->input->post('s_key');
            $s_value    =$this->input->post('s_value');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $user_list=$this->user_model->get_user_list($start_date,$end_date,$s_key,$s_value,$limit,$start);
            $num=$this->user_model->get_user_num($start_date,$end_date,$s_key,$s_value);
            
            $data=json_encode($user_list);
            $data='{"rows":'.$data.', "results":'.$num.'}';
            $this->_output_json($data);
            
        }        
    }
