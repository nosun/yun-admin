<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_model
 *
 * @author Administrator
 */
class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_admin($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('admin');
            return $query->result_array();
        }

        $query = $this->db->get_where('admin', array('id' => $id));
        return $query->row_array();
    }
    public function set_admin(){
        $psw = $this->input->post('');
        $data = array(
            'name'=>$this->input->post('name'),
            'realname'=>  $this->input->post('realname'),
            'psw'=>$psw,
            
        );
    }

}
?>
