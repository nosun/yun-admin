<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends Yun_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('message');
	}
	
	function index()
	{
                $data['title']="消息提示";
		$this->load->view('common/message',$data);
	}
	
	function message()
	{
		$this->message->set('message','this is just a message');
		$this->index();
	}

	function notice()
	{
		$data = array(
					'message'=>'this is just a message',
					'notice'=>'this is just a notice'
					);
		$this->message->set($data);
		$this->index();
	}

	function error()
	{
		$this->message->set('message','this is just a message');
		$this->message->set('error','this is an error');
		redirect(site_url('1'));
	}
	
}