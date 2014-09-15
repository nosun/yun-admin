<?php

    class Data extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
        }
        
        function eq_cat() {
            $this->load->model('equip_model');
            $start=$this->input->post('start');
            $limit=$this->input->post('limit');
            $cat_list=$this->equip_model->get_eq_cat($limit,$start);
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
            
            if($eq_list){
                $data=json_encode($this->_time_format2($eq_list,'active_time'));
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            
            $this->_output_json($data);
            
        }
        
        function eq_aera(){
            $this->load->model('equip_model');
            $res=$this->db->query("SELECT province ,COUNT(province) as num  FROM `yun_devices` GROUP BY province");
            $num_all=$this->db->query("select id from `yun_devices`")->num_rows();
            $i=0;
            foreach ($res->result() as $row)
            {
               $data[$i]['name']= $row->province;
               $data[$i]['y']=round(($row->num/$num_all)*100);
               $data[$i]['z']= (int)$row->num;
               $i++;
            }
            $data=json_encode($data);
            
            if($data){
                $data=$data;
            }else{
                $data='[]';
            }         
            $this->_output_json($data);
            
        }
        
        function user_aera(){
            $this->load->model('user_model');
            $res=$this->db->query("SELECT province ,COUNT(province) as num  FROM `yun_users` GROUP BY province");
            $num_all=$this->db->query("select id from `yun_users`")->num_rows();
            $i=0;
            foreach ($res->result() as $row)
            {
               $data[$i]['name']= $row->province;
               $data[$i]['y']=round(($row->num/$num_all)*100);
               $data[$i]['z']= (int)$row->num;
               $i++;
            }
            $data=json_encode($data);
            
            if($data){
                $data=$data;
            }else{
                $data='[]';
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
            
            
            
            if($user_list){
                $user_list=$this->_time_format($user_list,'user_regtime');
                $user_list=$this->_get_user_eq_num($user_list);
                $data=json_encode($user_list);
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
            
            if($eq_num){
                $eq_num=$this->_time_format1($eq_num,'date');
                $eq_num=$this->_string2int($eq_num, 'eq_num_all');
                $data=json_encode($eq_num);
            }
            else
            {
                $data='[{}]';
            }
            
            $this->_output_json($data);
            
        }
        
        function eq_state_h(){
            $this->load->model('equip_model');
            $action=  $this->uri->segment('3');           
            $day=  $this->uri->segment('4');
            $date=$this->input->post('date');

            if (!empty($date)){
                $day=  strtotime($date);
            }

            $product_id =$this->input->post('product_id');
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $num=$this->equip_model->get_eq_hour_data($product_id,$action,$day,$limit,$start);
            
            if($num){
                $num=$this->_time_format3($num,'updatetime');
                $num=$this->_string2int($num, 'num');
                $data=json_encode($num);
            }
            else{
                $data='[{"updatetime":"0","num":0}]';
            }
            
            $this->_output_json($data);
        }  
        
        function eq_list_s(){
            $this->load->model('equip_model');
            $action=  $this->uri->segment('3');
            $arg1=  $this->uri->segment('4');
            
            $product_id =$this->input->post('product_id');
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');

            $eq_list=$this->equip_model->get_eq_list_s($product_id,$action,$arg1,$limit,$start);
            $num=$this->equip_model->get_eq_num_s($product_id,$action,$arg1);

            if($eq_list){
                $data=json_encode($this->_time_format2($eq_list,'active_time'));
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            
            $this->_output_json($data);
        }

        function user_count_d(){
            $this->load->model('user_model');
            $action=  $this->uri->segment('3');           
            $month=  $this->uri->segment('4');
            if(!empty($this->input->post('date'))){
                $month=$this->input->post('date');
            }
            
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $pn= explode('-',$month);
            
            $month=strtotime($pn[0].'-'.$pn[1]);
            $month_next=strtotime($pn[0].'-'.($pn[1]+1)); 
            
            $num=$this->user_model->get_user_count_d($action,$month,$month_next,$limit,$start);
            
            if($num){
                $num=$this->_time_format1($num,'updatetime');
                $num=$this->_string2int($num, 'num');
                $data=json_encode($num);
            }
            else{
                $data='[{"updatetime":"0","num":0}]';
            }
            
            $this->_output_json($data);
        }
        
        function user_agent(){
            $this->load->model('user_model');
            $action=$this->uri->segment('3');
            if(empty($action)){
                $action='agent';
            }
            $res=$this->db->query("SELECT ".$action.",COUNT(".$action.") as num  FROM `yun_users` GROUP BY ".$action);
            $num_all=$this->db->query("select id from `yun_users`")->num_rows();
            $i=0;
            foreach ($res->result() as $row)
            {
               $data[$i]['name']= $row->$action;
               $data[$i]['y']=round(($row->num/$num_all)*100);
               $data[$i]['z']= (int)$row->num;
               $i++;
            }
            $data=json_encode($data);
            
            if($data){
                $data=$data;
            }else{
                $data='[]';
            }         
            $this->_output_json($data);
        }
        
        function _get_user_eq_num($data){
            $this->load->model('equip_model');
            foreach ($data as $array){
                $array['num']=$this->equip_model->get_user_eq_num($array['id']);
                $array_group[]=$array;
            }
            return $array_group;    
        }
        function _time_format($data,$key){//out the date time like 2014-07-01 14:00
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
        
        function _time_format2($data,$key){ //out the date like 2014-07-01
            foreach ($data as $array){
                $array[$key]=date('Y-m-d',$array[$key]);
                $array_group[]=$array;
            }        
            return $array_group;            
        }
        
        function _time_format3($data,$key){ // out the hour number like 0~24……
            foreach ($data as $array){
                $array[$key]=date('G',$array[$key]);
                $array_group[]=$array;
            }        
            return $array_group;            
        }
        
        function _time_format4($data,$key){ // out the month number like 1~12 ……
            foreach ($data as $array){
                $array[$key]=date('n',$array[$key]);
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

        function feedback(){
            $this->load->model('feedback_model');
            $product_id =$this->input->post('product_id');
            $category   =$this->input->post('category');
            $status     =$this->input->post('status');
            $id     =$this->input->post('id');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            
            $list=$this->feedback_model->get_list($product_id,$category,$status,$id,$start_date,$end_date,$limit,$start);
            $num=$this->feedback_model->get_num($product_id,$category,$status,$id,$start_date,$end_date);   
            
            $status=array(1=>'新开',2=>'未解决',3=>'处理中',4=>'已解决',5=>'不处理');
            $feed_cate=array(1=>'质量问题',2=>'使用疑难',3=>'业务投诉',4=>'产品建议',5=>'业务咨询');
            if($list){
                $data=$this->_time_format2($list,'addtime');
                $data=$this->chword($data,'status', $status);
                $data=$this->chword($data,'category', $feed_cate);
                $data=  json_encode($data);
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            $this->_output_json($data);
        }
        
        function notice(){
            $this->load->model('notice_model');
            $product_id =$this->input->post('product_id');
            $category   =$this->input->post('category');
            $status     =$this->input->post('status');
            $start_date =strtotime($this->input->post('start_date'));
            $end_date   =strtotime($this->input->post('end_date'));
            $limit      =$this->input->post('limit');
            $start      =$this->input->post('start');
            $list=$this->notice_model->get_list($product_id,$category,$status,$start_date,$end_date,$limit,$start);
            $num=$this->notice_model->get_num($product_id,$category,$status,$start_date,$end_date);   
            $s_status=array(1=>'已发送',2=>'未发送');
            $class=array(1=>'系统消息',2=>'服务消息');
            
            if($list){
                $data=$this->_time_format2($list,'send_time');
                $data=$this->chword($data,'status', $s_status);
                $data=$this->chword($data,'category', $class);
                $data=  json_encode($data);
                $data='{"rows":'.$data.', "results":'.$num.'}';
            }else{
                $data='{"rows":[],"results":0}';
            }
            $this->_output_json($data);
        }
        function chword($data,$key,$words){
            foreach($data as $p){
                $p[$key]=$words[$p[$key]];
                $array_group[]=$p;
            }
            return $array_group;
        }
        
        
    }
