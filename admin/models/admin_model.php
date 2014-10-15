<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_model
 *
 * @author Administrator
 */
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
                        ->get($this->db->dbprefix('admins'))
                        ->row();
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
                        ->get($this->db->dbprefix('admins'))
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
        $table_admins = $this->db->dbprefix('admins');
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
                        ->insert($this->db->dbprefix('admins'), $data);
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
                        ->update($this->db->dbprefix('admins'), $data);
    }

    // ------------------------------------------------------------------------
    /**
     * 删除管理员
     *
     * @access public
     * @param uid
     * @return bool
     */
//    public function del_admin($uid) {
//        return $this->db->where('uid', $uid)->delete($this->db->dbprefix('admins'));
//    }
    // ------------------------------------------------------------------------

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

    public function get_admin($id = FALSE, $limit = 0, $offset = 0) {
        $table_admins = $this->db->dbprefix('admins');
        if ($id === FALSE) {
            if ($limit) {
                $this->db->limit($limit);
            }
            if ($offset) {
                $this->db->offset($offset);
            }
            $query = $this->db->select('*')
                    ->from($table_admins)
                    ->order_by('uid', 'asc')
                    ->get();
            return $query->result_array();
        }

        $query = $this->db->get_where($table_admins, array('uid' => $id));
        return $query->row_array();
    }

    public function get_num($tablename) {
        $table = $this->db->dbprefix($tablename);
        return $this->db->count_all($table);
    }

    public function set_admin($id) {
        $table_admins = $this->db->dbprefix('admins');
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
        $table_admins = $this->db->dbprefix('admins');
        $ids = implode(',', $ids);

        $strSql = 'delete from ' . $table_admins . ' where uid in (' . $ids . ')';

        $this->db->query($strSql);
        return;
    }

    public function get_roles($id = FALSE) {
        $table_roles = $this->db->dbprefix('roles');
        if ($id === FALSE) {
            $query = $this->db->select('*')
                    ->from($table_roles)
                    ->order_by('id', 'asc')
                    ->get();
            return $query->result_array();
        }

        $query = $this->db->get_where($table_roles, array('id' => $id));
        return $query->row_array();
    }

    public function set_roles($models = NULL, $id = FALSE) {
        $table_roles = $this->db->dbprefix('roles');
        $data['models'] = $models;
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
        }
        if ($id) {
            $where = array('id' => $id);
            return $this->db->update($table_roles, $data, $where);
        } else {
            return $this->db->insert($table_roles, $data);
        }
    }

    public function del_roles($ids) {
        $table_roles = $this->db->dbprefix('roles');
        $ids = implode(',', $ids);
        $strSql = 'delete from ' . $table_roles . ' where id in (' . $ids . ')';
        $this->db->query($strSql);
        return;
    }

    public function get_power($id = FALSE, $pid = FALSE) {
        $table_power = $this->db->dbprefix('power');
        if ($id === FALSE) {
            $arrWhere = array(
                "pid" => $pid
            );
            $query = $this->db->select('*')
                    ->from($table_power)
                    ->where($arrWhere)
                    ->order_by('id', 'asc')
                    ->get();
            return $query->result_array();
        }
        $query = $this->db->get_where($table_power, array('id' => $id));
        return $query->row_array();
    }

    public function set_power($id) {
        $table_power = $this->db->dbprefix('power');
        $data = array(
            'name' => $this->input->post('name'),
            'pid' => $this->input->post('pid'),
            'controller' => $this->input->post('controller')
        );
        if ($id) {
            $where = array('id' => $id);
            return $this->db->update($table_power, $data, $where);
        } else {
            $this->db->insert($table_power, $data);
            $id = mysql_insert_id();
            $this->change_power($id, 1);
            return;
        }
    }

    public function del_power($ids) {
        $table_power = $this->db->dbprefix('power');
        $str_ids = implode(',', $ids);
        $strSql = 'delete from ' . $table_power . ' where id in (' . $str_ids . ')';
        $this->db->query($strSql);
        foreach ($ids as $id) {
            $this->change_power($id, 0);
        }
        return;
    }

    public function change_power($id, $type) {
        $table_roles = $this->db->dbprefix('roles');
        $roles = $this->get_roles();
        foreach ($roles as $rl) {
            $models = $rl['models'];
            $arr_models = json_decode($models, TRUE);
            if ($type == 1) {
                $arr_models[$id] = 0;
            } else {
                unset($arr_models[$id]);
            }
            $models = json_encode($arr_models);
            $data = array(
                'models' => $models
            );
            $where = array('id' => $rl['id']);
            $this->db->update($table_roles, $data, $where);
        }
        return;
    }

    public function get_jsonstr_power($id = FALSE) {
        if ($id) {
            $arrs = $this->get_roles($id);
            return $arrs['models'];
        } else {
            $arrs = $this->get_power();
            $arr_pid = array();
            foreach ($arrs as $arr) {
                $arr_pid[strval($arr['id'])] = 0;
            }
            return json_encode($arr_pid);
        }
    }

}

?>
