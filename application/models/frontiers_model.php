<?php

class Frontiers_model extends CI_Model{

	function get_frontiers($condition = null){
		$cond =array();
		foreach($condition as $key => $value){
		
			if($value){
				if($key!='period')
					$cond[$key] = $value;
			}		
		}
		$this->db->select('students.id, students.fname');

		foreach ($condition['period'] as $period) {
			if ($period == 'ANY') {
				$this->db->select('f.cs_first, f.fr_first, f.cs_second, f.fr_second, f.cs_third');
				break;
			}else{
				$this->db->select('f.'.$period);
			}
		}
		$this->db->select('f.sbid');
		$this->db->from('students');
		$this->db->join('frontiers f','f.stid = students.id','left');
		if($cond)$this->db->where($cond);
		$q = $this->db->get();
		return $q;
	}

	function get_subjects_options($sbid = null){
		$this->db->select('id, name')
					->from('subjects');
					if($sbid) $this->db->where(array('id' => $sbid));
					$q = $this->db->get();
		return $q;
	}

	function set_mark($stid,$sbid,$data){
		$this->db->where('stid',$stid);
		$this->db->where('sbid',$sbid);
		if($this->db->update('frontiers',$data)) return true;
	}
}