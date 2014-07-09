<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}
class Admin extends CI_Controller {
	function index(){
		$this->load->view("/views_index");
	}
}
