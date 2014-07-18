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
    }
