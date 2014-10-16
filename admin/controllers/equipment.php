<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipment extends Yun_Controller{
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
            //查询获取device表中设备的数量统计情况。
            $today=strtotime(date('Y-m-d',  time()));
            $data['num_all']=$this->db->query('SELECT id FROM yun_devices')->num_rows();
            $data['num_new']=$this->db->query('SELECT id FROM yun_devices where active_time>'.$today)->num_rows();
            $data['num_online']=$this->equip_model->get_eq_num(0,0,0,'device_online',1);
            $data['num_working']=$this->equip_model->get_eq_num(0,0,0,'device_work',1);            
            $data['num_alarm']=$this->equip_model->get_eq_num(0,0,0,'device_alarm',1);
            $data['num_filter']=$this->db->query('SELECT id FROM yun_devices where filter_time<30')->num_rows();
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
        function eq_state_h(){
            $action=$this->uri->segment('3');
            $day=$this->uri->segment('4');
            if($day){ //search for someday the time format is unix time;
                $data['dataurl']='../../../data/eq_state_h/'.$action.'/'.$day;
                $data['date']=date('Y-m-d',$day);
            }else{ //set the day today
                $data['date']=date('Y-m-d',time());
                $data['dataurl']='../../data/eq_state_h/'.$action.'/'.strtotime($data['date']);
            }
            $data['title']='设备 '.$action.' 状态';
            $data['action']=$action;
            $this->load->view('common/header',$data);
            $this->load->view('equip/eq_state_h'); 
            $this->load->view('common/footer');
        }
        
        function filter(){
            $data['title']='滤网到期';
            //查询获取device表中设备的数量统计情况。
            $data['filter0']=$this->db->query('SELECT id FROM yun_devices where filter_time=0')->num_rows();            
            $data['filter30']=$this->db->query('SELECT id FROM yun_devices where filter_time<30')->num_rows();
            $data['filter60']=$this->db->query('SELECT id FROM yun_devices where filter_time<60')->num_rows();            
            $data['filter90']=$this->db->query('SELECT id FROM yun_devices where filter_time<90')->num_rows(); 
            $data['filter120']=$this->db->query('SELECT id FROM yun_devices where filter_time<120')->num_rows();             
            $this->load->view('common/header',$data);
            $this->load->view('equip/filter'); 
            $this->load->view('common/footer'); 
        }   
        
        function list_s(){ //alarm eq and filter alarm eq
            $action=$this->uri->segment('3'); //type
            $arg1=$this->uri->segment('4'); //arguments 1
            if(!empty($arg1) || $arg1==='0'){ 
                $data['arg1']=$arg1;
                $data['dataurl']='../../../data/eq_list_s/'.$action.'/'.$arg1;
            }else{
                $data['dataurl']='../../data/eq_list_s/'.$action;
            }

            $data['title']='设备 '.$action.' 列表';
            $data['action']=$action;
            $this->load->view('common/header',$data);
            $this->load->view('equip/list_s'); 
            $this->load->view('common/footer');
        }
        
}