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
            
            //$array_eqs=$this->_time_format($eq_list,'activetime');
            $data=json_encode($eq_list);
            
            if($data){
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }         
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
            
            $array_users=$this->_time_format($user_list,'user_regtime');
            $data=json_encode($array_users);
            if($data){
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }            
            
            $this->_output_json($data);
            
        }
        
        function user_eq_list(){
            $this->load->model('equip_model');
            $uid=$this->uri->segment('3');
            $list=$this->equip_model->get_user_eq_list($uid);
            $data=json_encode($list);
            $this->_output_json($data);
        }
        
        function logs_login(){
            $this->load->model('log_model');
            $s_value    =$this->input->post('s_value');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $logs_list=$this->log_model->get_logs_login($start_date,$end_date,$s_value,$limit,$start);
            $num=$this->log_model->get_logs_login_num($start_date,$end_date,$s_value);
            
            $array_logs=$this->_time_format($logs_list,'logintime');
            $data=json_encode($array_logs);
            
            if($data){
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            
            $this->_output_json($data);
            
        }
        
        function logs_action(){
            $this->load->model('log_model');
            $s_key    =$this->input->post('s_key');            
            $s_value    =$this->input->post('s_value');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $logs_list=$this->log_model->get_logs_action($start_date,$end_date,$s_key,$s_value,$limit,$start);
            $num=$this->log_model->get_logs_action_num($start_date,$end_date,$s_key,$s_value);

            $array_logs=$this->_time_format($logs_list,'time');
            $data=json_encode($array_logs);
            
            if($data){
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            
            $this->_output_json($data);
            
        }
        function _time_format($data,$key){
            foreach ($data as $array){
                $array[$key]=date('Y-m-d h:i',$array[$key]);
                $array_group[]=$array;
            }        
            return $array_group;            
        }
        
        function _time_format1($data,$key){ // out the day number like 7,8,9……
            foreach ($data as $array){
                $array[$key]=date('j',$array[$key])-1;
                $array_group[]=$array;
            }        
            return $array_group;            
        }

        function _string2int($data,$key){ // fetch_array the data type default is string,need change
            foreach ($data as $array){
                $array[$key]=(int)($array[$key]);
                $array_group[]=$array;
            }        
            return $array_group;            
        }        
        
        function eq_new_count(){
            $this->load->model('equip_model');
            $choise     =$this->input->post('choise');
            $product_id =$this->input->post('product_id');
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $now=time();
            $year=  date('Y',$now); //2014
            $month= date('n',$now); //9
            $day=date('j',$now); //1
            $last_month=$month-1;
            $next_month=$month+1;
            $day7=$now-86400*7;//
            
            if($choise==1){ // last month
                $start_date=strtotime($year.'-'.$last_month);
                $end_date=strtotime($year.'-'.$month);
            }elseif($choise==2){ //7 day
                $start_date=$day7;
                $end_date=  strtotime($year.'-'.$month.'-'.$day);
            }else{// this month
                $start_date=strtotime($year.'-'.$month);
                $end_date=strtotime($year.'-'.$next_month);
            }

            $eq_new_num=$this->equip_model->get_eq_new_data($product_id,$start_date,$end_date,$limit,$start);

            $eq_new_num=$this->_time_format1($eq_new_num,'date');
            $eq_new_num=$this->_string2int($eq_new_num, 'eq_num_new');
            $data=json_encode($eq_new_num);
            
            if($data){
                $data='{"rows":'.$data.'}';
            }else{
                $data='{"rows":[]}';
            }
            
            $this->_output_json($data);
            
        }
        
        function eq_all_count(){
            $this->load->model('equip_model');
            $choise     =$this->input->post('choise');
            $product_id =$this->input->post('product_id');
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $now=time();
            $year=  date('Y',$now); //2014
            $month= date('n',$now); //9
            $day=date('j',$now); //1
            $last_month=$month-1;
            $next_month=$month+1;
            $day7=$now-86400*7;//
            
            if($choise==1){ // last month
                $start_date=strtotime($year.'-'.$last_month);
                $end_date=strtotime($year.'-'.$month);
            }elseif($choise==2){ //7 day
                $start_date=$day7;
                $end_date=  strtotime($year.'-'.$month.'-'.$day);
            }else{// this month
                $start_date=strtotime($year.'-'.$month);
                $end_date=strtotime($year.'-'.$next_month);
            }

            $eq_num=$this->equip_model->get_eq_all_data($product_id,$start_date,$end_date,$limit,$start);

            $eq_num=$this->_time_format1($eq_num,'date');
            $eq_num=$this->_string2int($eq_num, 'eq_num_all');
            $data=json_encode($eq_num);
            
            if($data){
                $data='{"rows":'.$data.'}';
            }else{
                $data='{"rows":[]}';
            }
            
            $this->_output_json($data);
            
        }
    }
