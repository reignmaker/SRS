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
	function get_subjects($stid,$course){
		$where = "sb.semester = get_semester_n(".$course.")";
		$this->db
				->select('sb.name,f.cs_first,f.fr_first,f.cs_second,f.fr_second,f.cs_third')
				->from('subjects sb')
				->join('frontiers f','sb.id = f.sbid','left')
				->where($where);
		$q = $this->db->get();
		return $q;
	}
		function view($id){
		$this->db->select('f.cs_first, f.fr_first, f.cs_second, f.fr_second, f.cs_third');
		$this->db->select('subjects.name');
		$this->db->select('subjects.spec');
		$this->db->from('frontiers f');
		$this->db->join('students','f.stid = students.id','left');
		$this->db->join('subjects','subjects.id = f.sbid','left');
		$this->db->where('students.id',$id);
		$q = $this->db->get();
		return $q;
	}
}