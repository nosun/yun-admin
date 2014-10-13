<?php

    class Data extends CI_Controller{
        
        public function __construct()
        {
            parent::__construct();
        }

        public function index(){
            $this->load->view('data');
        }
        
        public function clear1(){
            $database='one';
            $res=$this->db->query("select device_id, event_action,count(device_id) as number from {$database} GROUP BY device_id, event_action HAVING number>1 and event_action='PanelStateChange' order by number desc;");
            if($res){
                foreach($res->result_array() as $row){
                    $data[]['device_id']= $row['device_id'];
                    $this->delete_wrong_data1($row['device_id']);
                }
            }
        }
        
        public function clear2(){
            $database='one';
            $res=$this->db->query("select device_id, event_action,count(device_id) as number from {$database} GROUP BY device_id, event_action HAVING number>1 and event_action='PanelStateChange' order by number desc;");
            if($res){
                foreach($res->result_array() as $row){
                    $data[]['device_id']= $row['device_id'];
                    $this->delete_wrong_data($row['device_id']);
                }
            }
        }
        //清除非计算数据
        public function suantime(){
            $database='yun_data2';
            $res=$this->db->query('select distinct(device_id) from '.$database)->result_array();
            $alltime=array(0,0);
            $ping=0;
            $all=count($res);
            if($res){
                foreach($res as $row){
                    $data[]['device_id']= $row['device_id'];
                    $onetime=$this->suan($row['device_id']);
                    $alltime[0]=$alltime[0]+$onetime[0];
                    $alltime[1]=$alltime[1]+$onetime[1];
                    if ($onetime[0]<$onetime[1]){$ping++;}
                    //echo  $row['device_id'];echo "<br>";
                    //var_dump($onetime);echo "<br>";
                }
            }
            //var_dump($alltime);
            $data['count']=$all;
            $data['ping']=$ping;
            $data['time']=$alltime;
            $this->load->view('result',$data);
//                    $device_id='b01041b174e70000';
//                   $allt=$this->suan($device_id);
//                   //echo  $row['device_id'];echo "<br>";
//                   var_dump($allt);echo "<br>";
        }
        
        //计算累计时间
        function suan($device_id){
            $database='yun_data2';
            $sql='select min(preserve8) as start, max(preserve8) as end from '.$database.' where device_id="'.$device_id.'"';
            //var_dump($sql);
            $tarr=$this->db->query($sql)->result_array();
            //var_dump($tarr);
            $start=strtotime(substr($tarr[0]['start'],0,10));
            //var_dump($start);
            $end=strtotime(substr($tarr[0]['end'],0,10));
            if($end-$start==0){
                $num=1;
            }else{
                $num=($end-$start)/86400+1;
            }
            //var_dump($num);
            $time1=array(0,0);
            if($num){
                for ($i=0;$i<$num;$i++){
                    $sql='select event_action,param1_value,preserve8 from '.$database.' where preserve8 > "'.date('Y-m-d',($start+$i*86400)).'" and preserve8 < "'.date('Y-m-d',($start+($i+1)*86400)).'" and device_id="'.$device_id.'" order by preserve8 asc';
                    //$sql='select event_action,param1_value,preserve8 from '.$database.' where preserve8 > "2014-10-05" and preserve8 < "2014-10-06" and device_id="'.$device_id.'" order by preserve8 asc';
                    //var_dump($sql);
                    $oarr=$this->db->query($sql)->result_array();
                    $num2=count($oarr);
                    
                    $k=0;
                    //var_dump($oarr);
                    //找到数组的第一个能表达状态的点;
                    $num1=count($oarr)-1;
                    while($k < $num1){
                        if(($oarr[$k]['event_action']=='SystemStart') or ($oarr[$k]['event_action']=='PanelStateChange') or ($oarr[$k]['event_action']=='SystemStop') ){
                            ;   
                        }
                        else{
                            unset($oarr[$k]);
                        }
                        $k++;
                    }
                       
                    $oarr=array_values($oarr);
                    //print_r($oarr);die;
                    $num2=count($oarr)-1;
                    $j=1;
                    $del=array();
                    while($j < $num2){
                        if($oarr[$j]['param1_value']==$oarr[$j-1]['param1_value']){
                            $del[]=$j;
                        }
                        $j++;
                    } 
                    foreach($del as $p){
                        unset($oarr[$p]);
                    }
                    $oarr=array_values($oarr);
                    //var_dump($oarr);die;
                    if(count($oarr)>1){
                            $time=$this->jishi($oarr);
                        }else{
                            $time=array(0,0);
                        }
                        
                    //var_dump($time);
                    $time1[0]=$time1[0]+$time[0];
                    $time1[1]=$time1[1]+$time[1];
                
                }
            }

            return $time1;
        }
        
        function jishi($arr){
            $li=0;//立放 0 arr[0]
            $pi=0;//平放 1 arr[1]
            for ($i=0;$i<count($arr)-1;$i++){
                if($arr[$i]['param1_value']==0){
                    $li=$li+(strtotime($arr[$i+1]['preserve8'])-strtotime($arr[$i]['preserve8']));
                }else{
                    $pi=$pi+(strtotime($arr[$i+1]['preserve8'])-strtotime($arr[$i]['preserve8']));
                }
            }
            return array($li,$pi);
        }
        // 删除时间点相同的数据，精确到秒
        private function delete_wrong_data($device_id){
            $res=$this->db->query('select preserve8,COUNT(preserve8) as number from '.$database.' where device_id="'.$device_id.'" and event_action="PanelStateChange" GROUP BY preserve8 HAVING number>1');
            if($res){
                foreach($res->result_array() as $row){
                    $this->db->query('delete from '.$database.' where device_id="'.$device_id.'" and preserve8="'.$row['preserve8'].'"');
                }
            }
        }
        
        //删除时间点相差5分钟之内的数据，忽略之;
        private function delete_wrong_data1($device_id){
            $res=$this->db->query('select preserve8,param1_value from '.$database.' where device_id="'.$device_id.'" and event_action="PanelStateChange" order by preserve8 asc');
            if($array=$res->result_array()){
                $num= count($array);
                $tarr=array();    
                for($i=0;$i<$num-1;$i++){
                    if(strtotime($array[$i+1]['preserve8'])-strtotime($array[$i]['preserve8']) <='120'){
                        $tarr[]=$array[$i]['preserve8'];
                        $tarr[]=$array[$i+1]['preserve8'];
                    }
                }
                if($tarr){
                    $str='';
                        foreach($tarr as $row){
                            $str.='"'.$row.'",';
                        }
                    $str= rtrim($str,',');
                    $this->db->query('delete from '.$database.' where device_id="'.$device_id.'" and preserve8 in ('.$str.')');
                }
            }
        }   
        
        //对正常数据中的非计算点进行清除。
        private function delete_wrong_data2($device_id){
            $res=$this->db->query('select preserve8,param1_value from '.$database.' where device_id="'.$device_id.'" and event_action="PanelStateChange" order by preserve8 asc');
            if($array=$res->result_array()){
                $num= count($array);
                $tarr=array();    
                for($i=0;$i<$num-1;$i++){
                    if(strtotime($array[$i+1]['preserve8'])-strtotime($array[$i]['preserve8']) <='120'){
                        $tarr[]=$array[$i]['preserve8'];
                        $tarr[]=$array[$i+1]['preserve8'];
                    }
                }
                if($tarr){
                    $str='';
                        foreach($tarr as $row){
                            $str.='"'.$row.'",';
                        }
                    $str= rtrim($str,',');
                    $this->db->query('delete from '.$database.' where device_id="'.$device_id.'" and preserve8 in ('.$str.')');
                }
            }
        }
        
        
    }
