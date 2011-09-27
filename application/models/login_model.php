<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
	public function verify_user($name, $pwd){
		$this->db
				->where('name',$name)
				->where('pwd',$pwd);
		$q = $this->db->get('users',1);
		return $q;
	}
	
}