<?php
abstract class Yun_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    
    
    
    
    
}