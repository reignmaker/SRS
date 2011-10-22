<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teachers_model extends CI_Model{
	function get_teachers($condition = null){
		if ($condition) {
		
			$cond =array();
			foreach($condition as $key => $value){
			
				if($value){$cond[$key] = $value;}		
			}
		}
		
		$this->db->select('fname, degree, rank')
				 ->from('teachers');
				 if(isset($cond)){
				 	$this->db->where($cond);
				 }
		$q = $this->db->get();
		return $q;
	}
	function add_teacher($data){
		
			$q = $this->db->get_where('teachers', $data);
			if($q->num_rows == 0){
			$this->db->insert('teachers',$data);
			return 'success';
			}
			return $q->result_array();
	
	}
}