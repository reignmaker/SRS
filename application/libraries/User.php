<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class User {

	var $ci;
	public function __construct()
    {
    	$this->ci =& get_instance();
    	$this->ci->load->library('session');
    	    	
    }
    public function check_permission(){
    	    if ($this->ci->session->userdata('permission') != 'manage') {
			redirect('/home/');
			echo "Not enough privileges.";
    	}
    }
}