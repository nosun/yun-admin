<?php

class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    function validate()
    {
            $this->db->where('username', $this->input->post('username'));
            $this->db->where('password', md5($this->input->post('password')));
            $query = $this->db->get('yun_admins');
            
            var_dump($query);die;

            if($query->num_rows == 1)
            {
                    return true;
            }
            else{
                
                    exit("wrong");
            }

    }
	
    
    
    
}

