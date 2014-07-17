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
            $this->_output_json($cat_list);
        }
        
        function _output_json($data){
            
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        }
    }
