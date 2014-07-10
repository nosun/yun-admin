<?php 

if (! defined('BASEPATH')) {
    exit('Access Denied');
}

/**
 * DiliCMS 用户登录/退出控制器
 *
 * @package     SkywareLink
 * @subpackage  Controllers
 * @category    Controllers
 * @author      nosun
 * @link        http://www.Skyware.com.cn
 */
class Login extends CI_Controller
{
    
    
        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
                //$this->load->library('code');
                $this->config->load('admin.setting');
        }
    /**
     * 默认入口
     *
     * @access  public
     * @return  void
     */	
	public function index()
	{
            	if ($this->session->userdata('uid'))
		{
                        redirect('/admin');
		}
		else
		{       
			$this->load->view('/views_login');	
		}
	}
	
	// ------------------------------------------------------------------------

    /**
     * 退出
     *
     * @access  public
     * @return  void
     */	
	public function quit()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}
        
	// ------------------------------------------------------------------------
    /**
     * 用户登录验证
     *
     * @access  public
     * @return  void
     */	
	public function do_post()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
                
                if ($username AND $password)
                {}
		
	}

	//生成验证码
	function code(){
		$vals = array(
                'word' => '1213313131231',
                'img_path' => './',
                'img_url' => 'http://localhost/yun-admin/123.jpg',
                'font_path' => './fonts/font.ttf',
                'img_width' => '150',
                'img_height' => 30,
                'expiration' => 7200
                );
                $cap = create_captcha($vals);
                var_dump($cap);die;
                echo $cap['image'];	
	}
        
	//校验验证码
	function check_code(){
                @ob_clean() ;
                @session_start() ;
		$yzm = daddslashes(html_escape(strip_tags($this->input->get_post("code"))));//code
		if(strtolower($_SESSION['code']) != strtolower($yzm) ){
			//showmessage("验证码错误","login",3,0);
			exit('验证码不正确');
		}
		exit('success');
	}
}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */