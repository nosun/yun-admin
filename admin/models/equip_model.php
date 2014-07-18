<?php

class Equip_Model extends CI_Model{
    
    //this is a common function for deal a result object to a array.
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
    
    //equipment list many condition search
    function get_eq_list($product_id=0,$start_date=0,$end_date=0,$s_key=0,$s_value=0,$limit=0,$offset=0){
        
            $table= $this->db->dbprefix('devices');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
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
            //echo $this->db->last_query();
            return($res);
    }
    
    //search result affected rows for paganation
    function get_eq_num($product_id=0,$start_date=0,$end_date=0,$s_key=0,$s_value=0){
        
            $table= $this->db->dbprefix('devices');
            
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
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
    
    function get_eq_cat($limit='',$offset=0){
        $table  =   $this->db->dbprefix('device_class');
        if ($limit)
        {
            $this->db->limit($limit);
        }
        if ($offset)
        {
            $this->db->offset($offset);
        }
        $this->db->from($table);
        $this->db->order_by("id asc");
        $res=$this->db->get()->result();
        
        return($res);
    }   
    
     function get_eq_cat_num(){
        $table  =   $this->db->dbprefix('device_class');
        $this->db->get($table)->result();
        $num=$this->db->affected_rows();
        return($num);
    }     
    
    function update_eq_cat($id=0,$data=array()) {
        
        $table  =   $this->db->dbprefix('device_class');
        $this->db->where('id',$id);
        $this->db->update($table,$data);
        
    }   
        
    function insert_eq_cat($data=array()) {
        
        $table=$this->db->dbprefix('device_class');
        $this->db->insert($table,$data);
        
    }
    
    function delete_eq_cat($data=array()) {
        $table=$this->db->dbprefix('device_class');
        $this->db->delete($table,$data);
       
    }      
        

    
}