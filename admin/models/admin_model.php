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
        $this->load->database();
    }

    public function get_admin($id = FALSE) {
        $table_admins = $this->db->dbprefix('admins');
        if ($id === FALSE) {
            $query = $this->db->select('*')
                    ->from($table_admins)
                    ->order_by('uid', 'asc')
                    ->get();
            return $query->result_array();
        }

        $query = $this->db->get_where($table_admins, array('uid' => $id));
        return $query->row_array();
    }

    public function set_admin($id) {

        $table_admins = $this->db->dbprefix('admins');
        $password = $this->input->post('password');
        $password = md5($password);
        $roleid = $this->input->post('roleid');
        $roleid = intval($roleid);
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $password,
            'role' => $roleid,
        );
        if ($id) {
            $where = array('uid' => $id);
            return $this->db->update($table_admins, $data, $where);
        } else {
            return $this->db->insert($table_admins, $data);
        }
    }

    public function del_admin($ids) {
        $table_admins = $this->db->dbprefix('admins');
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
        $data = array(
            'name' => $this->input->post('name'),
            'models' => $models,
        );
        if ($id) {
            $where = array('id' => $id);
            return $this->db->update($table_roles, $data, $where);
        } else {
            return $this->db->insert($table_roles, $data);
        }
    }

    public function del_roles($ids) {
        $table_roles = $this->db->dbprefix('roles');
        $strSql = 'delete from ' . $table_roles . ' where uid in (' . $ids . ')';
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
            $id->mysql_insert_id();
            $this->change_power($id, 1);
            return;
        }
    }

    public function del_power($ids) {
        $table_power = $this->db->dbprefix('power');
        $strSql = 'delete from ' . $table_power . ' where uid in (' . $ids . ')';
        $this->db->query($strSql);
        $arr_id = explode(',', $ids);
        foreach ($arr_id as $id) {
            $this->change_power($id, 0);
        }
        return;
    }

    public function change_power($id, $tpe) {
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
            $where = array('id' => $id);
            return $this->db->update($table_roles, $data, $where);
        }
    }

    public function get_jsonstr_power($id) {
        if ($id) {
            $arrs=$this->get_roles($id);
            return $arrs['models'];
        } else {
            $arrs = $this->get_power();
            $arr_pid=array();
            foreach ($arrs as $arr) {
                $arr_pid[strval($arr['id'])] = 0;
            }
            return json_encode($arr_pid);
        }
    }

}

?>
