<?php

class Subjects_model extends CI_Model{
	
	public function get_subjects($condition = null){
		$cond =array();
		foreach($condition as $key => $value){
			$between = '';
			if($value){
				if($key == 'course'){
				if($condition['semester'] != 0){
					var_dump($condition['semester']);
				$cond['semester'] = ($value - 1)* 2 + $condition['semester'];

				}else{
					
					$between = $this->get_semester($value);
				}
			}else{
			if($key != 'semester')
				$cond[$key] = $value;

				
			}
			}
		}

		$this->db->select('name, semester, spec')
				 ->from('subjects');
				 if($cond){
				  	$this->db->where($cond);
					if($between){
				 	$this->db->where("semester ".$between);
				 }
				 }
		$q = $this->db->get();
		$i = 0;
		$data = array();
		$data['subjects'] = array();
		foreach($q->result() as $row){
			
			$data['subjects'][$i]['name'] = $row->name;
			$data['subjects'][$i]['spec'] =  $row->spec;
			$data['subjects'][$i]['course'] = ($row->semester - ($row->semester % 2 == 0 ? 2 : 1))/2 +1;
			$data['subjects'][$i]['semester'] = $row->semester % 2 == 0 ? 2 : 1;
			$i++;
		}
		
		return $data['subjects'];
		}
	
	public function add_subject($data){
		$this->db->insert('subjects', $data);
		return;
	}
	
	protected function get_semester($course){
		$between = '';
		$between .= "between ";
		$between .= $course + ($course - 1);
		$between .= " and ";
		$between .= $course + $course;
		return $between;
	}	

	public function view($id){
		$this->db->select('f.cs_first, f.fr_first, f.cs_second, f.fr_second, f.cs_third');
		$this->db->select('students.fname');
		$this->db->select('subjects.spec');
		$this->db->from('frontiers f');
		$this->db->join('students','f.stid = students.id','left');
		$this->db->join('subjects','subjects.id = f.sbid','left');
		$this->db->where('subjects.id',$id);
		$q = $this->db->get();
		return $q;
	}
}