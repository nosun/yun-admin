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
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_admin_by_uid($uid = 0)
    {
        return $this->db
                    ->where('uid', $uid)
                    ->get($this->db->dbprefix('admins'))
                    ->row();
    }
    
    // ------------------------------------------------------------------------
    /**
     * 根据管理员name获取管理员object
     * 
     * @access  public
     * @param   string
     * @return  object
     */
    public function get_admin_by_name($name)
    {
        return $this->db
                    ->where('username', $name)
                    ->get($this->db->dbprefix('admins'))
                    ->row();
    }
    
    // ------------------------------------------------------------------------
    /**
     * 根据管理员名或者管理员ID称获取该管理员完整的信息(id,name,password,salt,role,role_name,status)
     *
     * @access  public
     * @param   mixed
     * @return  object
     */
    public function get_full_admin($username = '', $type = 'username')
    {
        $table_admins = $this->db->dbprefix('admins');
        $table_roles = $this->db->dbprefix('roles');
        if ($type == 'uid')
        {
            $this->db->where($table_admins . '.uid', $username);
        }
        else
        {
            $this->db->where($table_admins . '.username', $username);
        }
        return $this->db
                    ->select("$table_admins.uid, $table_admins.username, $table_admins.password, $table_admins.salt, $table_admins.role, $table_roles.name, $table_admins.status")
                    ->from($table_admins)
                    ->join($table_roles, "$table_roles.id = $table_admins.role")
                    ->get()
                    ->row();
    }
    
    // ------------------------------------------------------------------------
    /**
     * 添加管理员
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_admin($data)
    {
        $data['salt'] = substr(sha1(time()), -10);
        $data['password'] = sha1($data['password'].$data['salt']);
        return $this->db
                    ->insert($this->db->dbprefix('admins'), $data);
    }
    
    // ------------------------------------------------------------------------
    /**
     * 修改管理员信息
     *
     * @access  public
     * @param   int , array
     * @return  bool
     */
    public function edit_admin($uid, $data)
    {
        //如果要更新password，需要在尾部加上salt（时间戳加密）
        if (isset($data['password']))
        {
            $data['salt'] = substr(sha1(time()), -10);
            $data['password'] = sha1($data['password'].$data['salt']);
        }
        return $this->db
                    ->where('uid', $uid)
                    ->update($this->db->dbprefix('admins'), $data); 
    }
    
    // ------------------------------------------------------------------------
    /**
     * 删除管理员
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
    public function del_admin($uid)
    {
        return $this->db->where('uid', $uid)->delete($this->db->dbprefix('admins'));
    }

    // ------------------------------------------------------------------------
    
    public function validate()
    {
            $this->db->where('username', $this->input->post('username'));
            $this->db->where('password', md5($this->input->post('password')));
            $query = $this->db->get('yun_admins');

            if($query->num_rows == 1)
            {
                    return true;
            }
            else{            
                    exit("wrong");
            }
    }
}
?>
