<?php if (!defined('BASEPATH')) { exit('Access Denied');}

class Dcache extends Yun_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function equip_cat(){
        $this->load->model('equip_model');
        $result=$this->equip_model->get_eq_cat(10,0);
        foreach($result as $row){
            $data[$row['id']]=$row['model'];
        }
        $this->cache->write($data, 'equip_cat');
        redirect('system/cache');
        
    }
    
    public function feedback_cat(){
        $data=  $feed_cate=array(1=>'质量问题',2=>'使用疑难',3=>'业务投诉',4=>'产品建议',5=>'业务咨询');
        $this->cache->write($data, 'feedback_cat');
        redirect('system/cache');
    }
    
    
}