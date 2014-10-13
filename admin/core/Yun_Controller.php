<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Yun_Controller extends CI_Controller
{
	/**
     * _admin
     * 保存当前登录用户的信息
     *
     * @var object
     * @access  public
     **/
	public $_admin = NULL;

	/**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
	public function __construct()
	{
		parent::__construct();
                $this->load->model('admin_model');
		$this->_check_login();
		//$this->load->library('acl');
	}


    /**
     * 检查用户是否登录
     *
     * @access  protected
     * @return  void
     */
	protected function _check_login()
	{
		if ( ! $this->session->userdata('uid'))
		{   
			redirect('login/index');
		}
		else
		{
			$this->_admin = $this->admin_model->get_full_admin($this->session->userdata('uid'), 'uid');
			if ($this->_admin->status != 1)
			{
				$this->message->set('error','您的账号已被冻结，请联系管理员！');
				redirect('message/index');
			}
		}
	}
        
        protected function _check_power(){}


        // ------------------------------------------------------------------------

    /**
     * 加载视图
     *
     * @access  protected
     * @param   string
     * @param   array
     * @return  void
     */
/*	protected function _template($template, $data = array())
	{
		$data['tpl'] = $template;
		$this->load->view('sys_entry', $data);
	}*/
	
	// ------------------------------------------------------------------------

    /**
     * 检查权限
     *
     * @access  protected
     * @param string $action
     * @param string $folder
     * @return  void
     */
/*	protected function _check_permit($action = '', $folder = '')
	{
		if ( ! $this->acl->permit($action, $folder))
		{
			$this->_message('对不起，你没有访问这里的权限！', '', FALSE);
		}
	}*/
	
	// ------------------------------------------------------------------------

    /**
     * 信息提示
     *
     * @access  public
     * @param $msg
     * @param string $goto
     * @param bool $auto
     * @param string $fix
     * @param int $pause
     * @return  void
     */
	public function _message($msg, $goto = '', $auto = TRUE, $fix = '', $pause = 3000)
	{
		if($goto == '')
		{
			$goto = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url();
		}
		else
		{
			$goto = strpos($goto, 'http') !== false ? $goto : backend_url($goto);	
		}
		$goto .= $fix;
		//$this->_template('sys_message', array('msg' => $msg, 'goto' => $goto, 'auto' => $auto, 'pause' => $pause));
		$data = array('msg' => $msg, 'goto' => $goto, 'auto' => $auto, 'pause' => $pause);
                $this->load->view('common/message_1', $data);
		echo $this->output->get_output();
		exit();
	}

}

/* End of file Dili_Controller.php */
/* Location: ./admin/core/Dili_Controller.php */
	
