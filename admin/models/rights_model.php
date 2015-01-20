<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rights_Model extends Yun_Model{

    public function __construct() {
        parent::__construct();
        $this->tb_auth=$this->db->dbprefix('admin_auth');
        $this->tb_role=$this->db->dbprefix('admin_role');

    }


    public function rights_list($limit = 0, $start = 0) {
        $this->db->from($this->tb_auth);
        $this->db->order_by('id', 'asc');
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($start) {
            $this->db->offset($start);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }


    public function get_array_power($rid) {
        $query = $this->db->get_where($this->tb_role, array('id' => $rid));
        $rs = $query->row_array();
        $str = $rs['models'];
        return json_decode($str, true);
    }

    public function get_powerid($str) {
        $query = $this->db->query('select id,controller from ' . $this->tb_auth);
        foreach ($query->result_array() as $row) {
            if (strchr($str, $row['controller'])) {
                return $row['id'];
                break;
            };
        }
    }

    public function set_power($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'pid' => $this->input->post('pid'),
            'controller' => $this->input->post('controller')
        );
        if ($id) {
            $where = array('id' => $id);
            return $this->db->update($this->tb_auth, $data, $where);
        } else {
            $this->db->insert($this->tb_auth, $data);
            $id = mysql_insert_id();
            $this->change_power($id, 1);
            return;
        }
    }

    public function del_power($ids) {
        $str_ids = implode(',', $ids);
        $strSql = 'delete from ' . $this->tb_auth . ' where id in (' . $str_ids . ')';
        $this->db->query($strSql);
        foreach ($ids as $id) {
            $this->change_power($id, 0);
        }
        return;
    }

    public function change_power($id, $type) {
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
            $this->db->update($this->tb_role, $data, $where);
        }
        return;
    }

    public function get_jsonstr_power($id = FALSE) {
        if ($id) {
            $this->load->model('roles_model');
            $arr = $this->roles_model->get_role($id);
            return $arr['models'];
        } else {
            $arrs = $this->rights_list();
            $arr_pid = array();
            foreach ($arrs as $arr) {
                $arr_pid[strval($arr['id'])] = 0;
            }
            return json_encode($arr_pid);
        }
    }
}