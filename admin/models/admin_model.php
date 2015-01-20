<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Model extends Yun_Model {

    public $table;
    public function __construct() {
        parent::__construct();
        $this->tb_admin=$this->db->dbprefix('admin');
        $this->tb_role=$this->db->dbprefix('admin_role');
        $this->tb_hold=$this->db->dbprefix('admin_hold');
        $this->tb_admin_log=$this->db->dbprefix('admin_log_login');
    }

    /**
     * 根据管理员ID获取管理员信息
     *
     * @access public
     * @param int
     * @return object
     */
    public function get_admin_by_uid($uid = 0) {
        return $this->db
            ->where('uid', $uid)
            ->get($this->tb_admin)
            ->row();
    }

    public function get_admin($id) {
        $query = $this->db->get_where($this->tb_admin, array('uid' => $id));
        $arr = $query->row_array();
        return $arr;
    }

    public function get_rolesid($id) {
        $query = $this->db->get_where($this->tb_admin, array('uid' => $id));
        $arr = $query->row_array();
        return intval($arr['role']);
    }
    // ------------------------------------------------------------------------
    /**
     * 根据管理员name获取管理员object
     *
     * @access public
     * @param string
     * @return object
     */
    public function get_admin_by_name($name) {
        return $this->db
            ->where('username', $name)
            ->get($this->tb_admin)
            ->row();
    }

    // ------------------------------------------------------------------------
    /**
     * 根据管理员名或者管理员ID称获取该管理员完整的信息(id,name,password,salt,role,role_name,status)
     *
     * @access public
     * @param mixed
     * @return object
     */
    public function get_full_admin($username = '', $type = 'username') {
        if ($type == 'uid') {
            $this->db->where($this->tb_admin . '.uid', $username);
        } else {
            $this->db->where($this->tb_admin . '.username', $username);
        }
        return $this->db
            ->select("$this->tb_admin.uid, $this->tb_admin.username, $this->tb_admin.password, $this->tb_admin.salt,
                        $this->tb_admin.role, $this->tb_role.name, $this->tb_admin.status")
            ->from($this->tb_admin)
            ->join($this->tb_role, "$this->tb_role.id = $this->tb_admin.role")
            ->get()
            ->row();
    }

    public function get_throttle($admin) {
        //get the hold info from the sheet of throttle
        $throttle = $this->db->where('created_at >', date('Y-m-d H:i:s', time() - 7200))
            ->where('user_id', $admin->uid)
            ->limit(1)
            ->get($this->tb_hold)
            ->row();
        return $throttle;
    }

    public function insert_throttle($uid,$loginip){
        $throttle_data['user_id'] = $uid;
        $throttle_data['type'] = 'login';
        $throttle_data['ip'] = $loginip;
        $throttle_data['created_at'] = $throttle_data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tb_hold, $throttle_data);
    }

    function _insert_log_login($username,$loginip,$password,$status){
        $log_data = array(
            'loginip' => $loginip,
            'username' => $username,
            'logintime' => time(),
            'password' => $password,
            'status' => $status
        );
        $this->db->insert($this->tb_admin_log,$log_data);
    }

    // ------------------------------------------------------------------------
    /**
     * 添加管理员
     *
     * @access public
     * @param array
     * @return bool
     */
    public function add_admin($data) {
        $data['salt'] = substr(sha1(time()), -10);
        $data['password'] = sha1($data['password'] . $data['salt']);
        return $this->db
            ->insert($this->tb_admin, $data);
    }

    // ------------------------------------------------------------------------
    /**
     * 修改管理员信息
     *
     * @access public
     * @param int , array
     * @return bool
     */
    public function edit_admin($uid, $data) {
        //如果要更新password，需要在尾部加上salt（时间戳加密）
        if (isset($data['password'])) {
            $data['salt'] = substr(sha1(time()), -10);
            $data['password'] = sha1($data['password'] . $data['salt']);
        }
        return $this->db
            ->where('uid', $uid)
            ->update($this->tb_admin, $data);
    }

    // ------------------------------------------------------------------------
    /**
     * 删除管理员
     *
     * @access public
     * @param uid
     * @return bool
     */

    public function validate() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get($this->tb_admin);

        if ($query->num_rows == 1) {
            return true;
        } else {
            exit("wrong");
        }
    }

    public function admin_list($limit = 0, $start = 0) {
        $this->db->from($this->tb_admin);
        $this->db->order_by('uid', 'asc');
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($start) {
            $this->db->offset($start);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function set_admin($id) {
        $role = intval($this->input->post('role'));
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' => $role,
            'status' => intval($this->input->post('status'))
        );
        if ($id) {
            $arr_ainfo = $this->get_admin($id);
            if ($arr_ainfo['password'] != $this->input->post('password')) {
                $data['salt'] = substr(sha1(time()), -10);
                $password = $this->input->post('password');
                $data['password'] = sha1($password . $data['salt']);
            }
            $where = array('uid' => $id);
            return $this->db->update($this->tb_admin, $data, $where);
        } else {
            $password = $this->input->post('password');
            $data['salt'] = substr(sha1(time()), -10);
            $data['password'] = sha1($password . $data['salt']);
            return $this->db->insert($this->tb_admin, $data);
        }
    }

    public function del_admin($ids) {
        $ids = implode(',', $ids);

        $strSql = 'delete from ' . $this->tb_admin . ' where uid in (' . $ids . ')';

        $this->db->query($strSql);
        return;
    }

}

?>
