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
        $this->config->load('setting');
        $this->load->model('admin_model');
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
            redirect(config_item('backend_access').'/system');
		}
		else
		{       
			$this->load->view('system/system_login');	
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
        $this->check_captcha();
        $loginip=$this->input->ip_address();
        $username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
                //redirect(config_item('backend_access') . '/system');
		if ($username AND $password)
		{
			$admin = $this->admin_model->get_full_admin($username);
            
			if ($admin)
			{
                $throttle = $this->db->where('created_at >', date('Y-m-d H:i:s', time() - 7200))
                ->where('user_id', $admin->uid)
                ->limit(1)
                ->get('throttles')
                ->row();

                if ($throttle) 
                {
                    $this->session->set_flashdata('error', "密码输入次数过多，账号被禁用2小时，将在".date('Y-m-d H:i:s', strtotime($throttle->created_at) + 7200).'解禁.');
                    redirect(config_item('backend_access') . '/login');
                }
                if ($admin->password == sha1($password.$admin->salt))
                {
                    if ($admin->status == 1)
                    {
                            $this->session->set_userdata('uid', $admin->uid);
                            $log_data = array(
                                'loginip' => $loginip,
                                'username' => $username,
                                'logintime' => time(),
                                'password' => 'ok',
                                'status' => '1'
                            );
                            $this->db->insert("admin_logs",$log_data);
                            redirect(config_item('backend_access') . '/system');
                    }
                    else
                    {
                            $this->session->set_flashdata('error', "此帐号已经停用,请联系管理员!");
                    }
                }
                else
                {
                    if (! $throttles = $this->session->userdata('throttles_'.$username)) {
                        $this->session->set_userdata('throttles_'.$username, 1);
                    } 
                    else
                    {
                        $throttles ++;
                        $this->session->set_userdata('throttles_'.$username,  $throttles);
                        if ($throttles > 3) {
                            $throttle_data['user_id'] = $admin->uid;
                            $throttle_data['type'] = 'attempt_login';
                            $throttle_data['ip'] = $loginip;
                            $throttle_data['created_at'] =  $throttle_data['updated_at'] = date('Y-m-d H:i:s');
                            $this->db->insert('throttles', $throttle_data);
                            $this->session->set_userdata('throttles_'.$username, 0);
                        }
                    }
                    $this->session->set_flashdata('error', "密码不正确!");
                    $log_data = array(
                        'loginip' => $loginip,
                        'username' => $username,
                        'logintime' => time(),
                        'password'=> $password,
                        'status' => '0'
                    );
                    $this->db->insert("admin_logs",$log_data);
                }
            }
            else
            {
                    $this->session->set_flashdata('error', '不存在的用户!');
            }
		}
		else
		{
			$this->session->set_flashdata('error', '用户名和密码不能为空!');
		}
                redirect(config_item('backend_access') . '/login');
	}
        
	//校验验证码
	function check_captcha(){
        @session_start() ;
        include_once '/securimage/securimage.php';
        $securimage = new Securimage();
        if ($securimage->check($_POST['captcha']) == false)
        {
            echo "error";
            echo "<a href='javascript:history.go(-1)'>back</a> and try again.";
            exit;
        }
	}
}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */