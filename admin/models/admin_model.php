<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Model extends Yun_Model {
    
    public $table;
    public function __construct() {
        parent::__construct();
        $this->table=$this->db->dbprefix('admins');
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
                        ->get($this->table)
                        ->row();
    }

    public function get_admin($id) {
        $query = $this->db->get_where($this->table, array('uid' => $id));
        $arr = $query->row_array();
        return $arr;
    }
    
        public function get_rolesid($id) {
        $query = $this->db->get_where($this->table, array('uid' => $id));
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
                        ->get($this->table)
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
        $table_admins = $this->table;
        $table_roles = $this->db->dbprefix('roles');
        if ($type == 'uid') {
            $this->db->where($table_admins . '.uid', $username);
        } else {
            $this->db->where($table_admins . '.username', $username);
        }
        return $this->db
                        ->select("$table_admins.uid, $table_admins.username, $table_admins.password, $table_admins.salt, $table_admins.role, $table_roles.name, $table_admins.status")
                        ->from($table_admins)
                        ->join($table_roles, "$table_roles.id = $table_admins.role")
                        ->get()
                        ->row();
    }
    
    public function get_throttle($admin) {
        //get the hold info from the sheet of throttle
        $throttle = $this->db->where('created_at >', date('Y-m-d H:i:s', time() - 7200))
                ->where('user_id', $admin->uid)
                ->limit(1)
                ->get('throttles')
                ->row();
        return $throttle;
    }

    public function insert_throttle($uid,$loginip){
        $throttle_data['user_id'] = $uid;
        $throttle_data['type'] = 'login';
        $throttle_data['ip'] = $loginip;
        $throttle_data['created_at'] = $throttle_data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert('throttles', $throttle_data);
    }
    
    function _insert_log_login($username,$loginip,$password,$status){
        $log_data = array(
                            'loginip' => $loginip,
                            'username' => $username,
                            'logintime' => time(),
                            'password' => $password,
                            'status' => $status
                        );
        $this->db->insert("admin_logs",$log_data);
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
                        ->insert($this->table, $data);
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
                        ->update($this->table, $data);
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
        $query = $this->db->get('yun_admins');

        if ($query->num_rows == 1) {
            return true;
        } else {
            exit("wrong");
        }
    }

    public function admin_list($limit = 0, $start = 0) {
            $this->db->from($this->table);
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
        $table_admins = $this->table;
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
            return $this->db->update($table_admins, $data, $where);
        } else {
            $password = $this->input->post('password');
            $data['salt'] = substr(sha1(time()), -10);
            $data['password'] = sha1($password . $data['salt']);
            return $this->db->insert($table_admins, $data);
        }
    }

    public function del_admin($ids) {
        $table_admins = $this->table;
        $ids = implode(',', $ids);

        $strSql = 'delete from ' . $table_admins . ' where uid in (' . $ids . ')';

        $this->db->query($strSql);
        return;
    }

}

?>
