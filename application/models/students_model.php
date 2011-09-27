<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students_model extends CI_Model{
	
	function get_students($condition = null){
		$cond =array();
		foreach($condition as $key => $value){
		
			if($value){
				$cond[$key] = $value;
			}		
		}
		
		$this->db->select('fname, spec, course')
				 ->from('students');
				 if($cond){
				 	$this->db->where($cond);
				 }
		$students = $this->db->get();
		return $students;
	}
	
	function add_student($data){
		
		$this->db->insert('students',$data);
		return;
	
	}
}