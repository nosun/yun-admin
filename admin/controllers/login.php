<?php

if (!defined('BASEPATH')) {
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
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
	$this->load->library('message');
        $this->load->model('admin_model');
        
    }

    /**
     * 默认入口
     *
     * @access  public
     * @return  void
     */
    public function index() {
        if ($this->session->userdata('uid')) {
            redirect(site_url('system/index'));
        } else {
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
    public function quit() {
        $this->session->sess_destroy();
        redirect(site_url('login/index'));
    }

    // ------------------------------------------------------------------------
    /**
     * 用户登录验证
     *
     * @access  public
     * @return  void
     */
    public function check_login() {
        
        if($this->check_captcha()== FALSE){
            $this->message->set('error','您输入的验证码不正确，请重试！');
            redirect("login/index");
        };
        
        $loginip = $this->input->ip_address();
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        // check whether the username and password is blank,usually the js has filter this
        if (empty($username) or empty($password)) {
            $this->message->set('error','用户名和密码不能为空!');
            redirect("login/index");     
        }

        //get the info of the input user
        $admin = $this->admin_model->get_full_admin($username);
        if(empty($admin)){
            $this->message->set('error','您输入的账号不存在!');
            redirect("login/index");            
        }

        //check if the user is locked at the sheet of throttle
        $throttle = $this->admin_model->get_throttle($admin);
        if ($throttle) {
            $this->message->set('error','密码输入次数过多，账号被禁用2小时，将在' . date('Y-m-d H:i:s', strtotime($throttle->created_at) + 7200) .'解禁');
            redirect("login/index");  
        } else {
            // if check_pass ok set session log and redirect to admin index page
            if ($admin->password == sha1($password . $admin->salt)) {
                if ($admin->status == 1) {
                    $this->session->set_userdata('uid', $admin->uid);
                    $this->admin_model->_insert_log_login($username,$loginip,'',1);
                    redirect(site_url('system/index'));
                }else{
                    $this->message->set('error','此帐号已经停用,请联系管理员!');
                    redirect("login/index");  
                }
            } else {
                if (!$throttles = $this->session->userdata('throttles_' . $username)) {
                    $this->session->set_userdata('throttles_' . $username, 1);
                } else {
                    $throttles ++;
                    $this->session->set_userdata('throttles_' . $username, $throttles);
                    //hold the user the password input error above 3;
                    if ($throttles > 3) {
                        $this->admin_model->insert_throttle($admin->uid,$loginip);
                        $this->session->set_userdata('throttles_' . $username, 0);
                    }
                }
                $this->message->set('error','您的用户名密码输入不正确!');
                $this->admin_model->_insert_log_login($username,$loginip,$password,0);
                redirect("login/index");  
            }
        }
    }

    //校验验证码
    public function check_captcha() {
        @session_start();
        $this->load->library('securimage/securimage');
        $securimage = new Securimage();
        if ($securimage->check($this->input->post('captcha')) == false) {
            //exit("fail");
            return FALSE;
        } else {
            //exit("sucess");
            return TRUE;
        }
    }

    public function securimage() {
        $this->load->config('securimage');
        $active = $this->config->item('si_active');
        $allsettings = array_merge($this->config->item($active), $this->config->item('si_general'));
        $this->load->library('securimage/securimage');
        $img = new Securimage($allsettings);
        $img->captcha_type = Securimage::SI_CAPTCHA_MATHEMATIC;

        $img->show(APPPATH . 'libraries/securimage/backgrounds/bg6.png');
    }
}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */