<?php

class Equip_Model extends CI_Model{
    
    function get_eqlist($where='',$limit=0,$offset=0){
                

    
    }
    
    function querylist($sql){
        $result =array();
        $query = $this->db->query($sql);
            if($query){
                    foreach($query->result_array() as $row){
                    $result[] = $row ;
            }
        }
        return $result ;
    }
    
    function search($product_id=0,$start_date=0,$end_date=0,$s_key=0,$s_value=0,$limit=0,$offset=0){
        
            $table= $this->db->dbprefix('devices');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
                $where=$where. 'product_id='.$product_id;
            }
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$table.$s_key",$s_value);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($offset)
            {
                $this->db->offset($offset);
            }
            $res=$this->db->from($table)->get()->result();
            
            return($res);
    }
    
    //查询返回的结果
    function query_count($product_id=0,$start_date=0,$end_date=0,$s_key=0,$s_value=0){
        
            $table= $this->db->dbprefix('devices');
            
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
                $where=$where. 'product_id='.$product_id;
            }
            if($start_date){
                $this->db->where("$table.active_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.active_time <",$end_date);
            }
            if($s_key && $s_value){
                $this->db->where("$table.$s_key",$s_value);
            }
            $this->db->from($table)->get()->result();
            
            return $this->db->affected_rows() ;

    }
    
    
    
}