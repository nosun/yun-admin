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
    function get_eq_list($product_id=0,$start_date=0,$end_date=0,$s_key=0,$s_value=0,$limit=0,$start=0){
        
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
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->from($table)->get()->result_array();
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
    
    function get_eq_cat($limit='',$start=0){
        $table  =   $this->db->dbprefix('device_class');
        if ($limit)
        {
            $this->db->limit($limit);
        }
        if ($start)
        {
            $this->db->offset($start);
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
        

    function  get_user_eq_list($uid=''){
        $table_u=$this->db->dbprefix('users');
        $table_d=$this->db->dbprefix('devices');
        $table_r=$this->db->dbprefix('dictionarys');
        $sql='SELECT * FROM '.$table_d.' where id in ( select dic_to from '.$table_r.' where dic_from= '.$uid.') ORDER BY id desc';
        return($this->db->query($sql)->result());
    }

    function get_user_eq_num($uid=''){
        $table_u=$this->db->dbprefix('users');
        $table_r=$this->db->dbprefix('dictionarys');
        $sql='select id from '.$table_r.' where dic_from= '.$uid;
        return($this->db->query($sql)->num_rows());
    }
    //device_new_num for chart
    function get_eq_new_data($product_id=0,$start_date=0,$end_date=0,$limit=0,$start=0){
            $table= $this->db->dbprefix('device_count_d');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($start_date){
                $this->db->where("$table.date >=",$start_date);
            }
            if($end_date){
                $this->db->where("$table.date <",$end_date);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->select("date,eq_num_new")->from($table)->get()->result_array();
            return($res);
    }
    
    //device_new_num for chart
    function get_eq_all_data($product_id=0,$start_date=0,$end_date=0,$limit=0,$start=0){
            $table= $this->db->dbprefix('device_count_d');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($start_date){
                $this->db->where("$table.date >=",$start_date);
            }
            if($end_date){
                $this->db->where("$table.date <",$end_date);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->select("date,eq_num_all")->from($table)->get()->result_array();
            //var_dump($res);
            //echo $this->db->last_query();
            return($res);
    }
    function get_eq_hour_data($product_id=0,$action,$day=0,$limit=0,$start=0){
            $table= $this->db->dbprefix('device_count_h');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($day){
                $this->db->where("$table.updatetime >=",$day);
                $this->db->where("$table.updatetime <",$day+86400);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->select("updatetime,num_{$action} as num")->from($table)->get()->result_array();
            //var_dump($res);
            //echo $this->db->last_query();
            return($res);
    }
    
    function get_eq_list_s($product_id,$action,$arg1,$limit,$start){
            $table= $this->db->dbprefix('devices');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($action=='alarm'){
                $this->db->where("$table.device_alarm",1);
            }
            if($action=='filter'){
                $this->db->where("$table.filter_time <=",$arg1);
            }
            if ($limit)
            {
                $this->db->limit($limit);
            }
            if ($start)
            {
                $this->db->offset($start);
            }
            $res=$this->db->from($table)->get()->result_array();
            //echo $this->db->last_query();
            return($res);
    }
    
    function get_eq_num_s($product_id,$action,$arg1){
            $table= $this->db->dbprefix('devices');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($action=='alarm'){
                $this->db->where("$table.device_alarm",1);
            }
            if($action=='filter'){
                $this->db->where("$table.filter_time <=",$arg1);
            }
            
            $this->db->from($table)->get()->result();
            
            return $this->db->affected_rows() ;
    }
}
