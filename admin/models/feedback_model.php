<?php

class Feedback_Model extends Yun_Model{
    
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
    function get_list($product_id=0,$category=0,$status=0,$id=0,$start_date=0,$end_date=0,$limit=0,$start=0){
        
            $table= $this->db->dbprefix('feedback');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($category){
                $this->db->where("$table.category",$category);
            }
            if($status){
                $this->db->where("$table.status",$status);
            }
            if($id){
                $this->db->where("$table.id",$id);
            }            
            if($start_date){
                $this->db->where("$table.add_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.add_time <",$end_date);
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
    function get_num($product_id=0,$category=0,$status=0,$id=0,$start_date=0,$end_date=0){
        
            $table= $this->db->dbprefix('feedback');
            if($product_id){
                $this->db->where("$table.product_id",$product_id);
            }
            if($category){
                $this->db->where("$table.category",$category);
            }
            if($status){
                $this->db->where("$table.status",$status);
            }
            if($id){
                $this->db->where("$table.id",$id);
            }            
            if($start_date){
                $this->db->where("$table.add_time >",$start_date);
            }
            if($end_date){
                $this->db->where("$table.add_time <",$end_date);
            }
            
            $this->db->from($table)->get()->result();
            
            return $this->db->affected_rows() ;

    }
}
