<?php
/*
 *common model 文件
 *@author nosun
 */
class Common_Model extends CI_Model {
	
        function M_common(){
		parent::__construct();
	}
	
	//插入一条数据
	function insert_one($table,$data){
		$this->db->insert($table,$data) ;
		return array(
			'affect_num'=>$this->db->affected_rows() ,
			'insert_id'=>$this->db->insert_id(),
			'sql'=>$this->db->last_query()
		);
	}
	//查询1条数据，返回结果
	function query_one($sql){		
		return $this->db->query($sql)->row_array();
	}
	//查询list data 将查出的数据转化为数组，便于输出
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
	//查询返回的结果
	function query_count($sql){
		$query = $this->db->query($sql);
		$num_array = $query->result_array();
		$num = 0 ;
		if(isset($num_array[0]) && !empty($num_array[0])){
			foreach ($num_array[0] as $k=>$v){
				$num = $v ;
				break ;
			}
		}	
		return $num ;
		
	}
	//删除数据
	function del_data($sql){
	
		$query = $this->db->query($sql);
		return $this->db->affected_rows(); //返回影响的行数
		
	}
	//修改数据
	function update_data($sql){
	
		$query = $this->db->query($sql);
		return $this->db->affected_rows(); //返回影响的行数
	}
	
	

}