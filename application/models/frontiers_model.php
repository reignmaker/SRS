<?php

class Frontiers_model extends CI_Model{

	public function get_frontiers($condition = null){
		$cond =array();
		foreach($condition as $key => $value){
		
			if($value){
				if($key!='period')
					$cond[$key] = $value;
			}		
		}
		$this->db->select('students.id, students.fname');
		if($condition['period'] == 1 or $condition['period'] == 'ANY')$this->db->select('f.cs_first');
		if($condition['period'] == 2 or $condition['period'] == 'ANY')$this->db->select('f.fr_first');
		if($condition['period'] == 3 or $condition['period'] == 'ANY')$this->db->select('f.cs_second');
		if($condition['period'] == 4 or $condition['period'] == 'ANY')$this->db->select('f.fr_second');
		if($condition['period'] == 5 or $condition['period'] == 'ANY')$this->db->select('f.cs_third');
		if($condition['period'] == 6 or $condition['period'] == 'ANY')$this->db->select('f.cs_first,f.cs_second,f.cs_third');
		if($condition['period'] == 7 or $condition['period'] == 'ANY')$this->db->select('f.fr_first, f.fr_second');
		$this->db->select('f.sbid');
		$this->db->from('students');
		$this->db->join('frontiers f','f.stid = students.id','left');
		if($cond)$this->db->where($cond);
		$q = $this->db->get();
		return $q;
	}

	public function get_subjects_options($sbid = null){
		$this->db->select('id, name')
					->from('subjects');
					if($sbid) $this->db->where(array('id' => $sbid));
					$q = $this->db->get();
		return $q;
	}

	public function set_mark($stid,$sbid,$data){
		$this->db->where('stid',$stid);
		$this->db->where('sbid',$sbid);
		if($this->db->update('frontiers',$data)) return true;
	}
}