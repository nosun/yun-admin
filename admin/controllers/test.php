<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}
class Test extends CI_Controller {
	function index(){
		$this->load->view("/views_test");
	}
	
}
