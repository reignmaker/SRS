<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{
	public function __construct()
    {
    	parent::__construct();
		$this->user->check_permission();
    }

	function update($id){
		$this->load->model('login_model');
		$data['profile'] = $this->login_model->get_user($id);
		var_dump($data['profile']->result());
	}
}