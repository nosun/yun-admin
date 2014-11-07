<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User_Model extends CI_Model{
    
    public $tb_user;
    public function __construct() {
        parent::__construct();
        $this->tb_user=$this->db->dbprefix('users');
        $this->load->database();
    }
    
    public function check_passwd($user_name,$login_pwd) {
        $login_pwd  = md5($login_pwd);
        $sql='select id from yun_users where user_name="'.$user_name.'" and login_pwd = "'.$login_pwd.'"';
        $num=$this->db->query($sql)->num_rows();
        if($num==1){
            return true;
        }else{
            return false;
        }
    }
    
}