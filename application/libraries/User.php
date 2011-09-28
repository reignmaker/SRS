<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class User {

	var $ci;
    var $user;
	public function __construct()
    {
    	$this->ci =& get_instance();
    	//$this->ci->load->library('session');
        if (!$this->ci->session->userdata('name')) {
            $this->ci->session->set_userdata(array(
                    'name' => 'Гость',
                    'permission' => 'read',
            ));
        }
    $this->user = $this->ci->session->all_userdata();
    }
    public function check_permission(){
    	    if ($this->ci->session->userdata('permission') != 'manage') {
			redirect(base_url());
			echo "Not enough privileges.";
    	}
    }
}