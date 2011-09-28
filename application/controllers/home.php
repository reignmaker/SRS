<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	

	function __construct()
    {
    	parent::__construct();
		$this->load->model('login_model');
    }


	function Index(){
		if ($this->session->userdata('permission') != 'manage') {
			$data['partial'] = 'partials/login';
			
		}
		$data['panel'] = array('user' => $this->user->user,);
		$this->load->view('template',$data);
	}

	function Login(){
		$user = $this->login_model->verify_user($this->input->post('name'),sha1($this->input->post('pwd')))->result();
		if($user){
			$this->session->set_userdata(array(
					'name' => $user[0]->name,
					'permission' => $user[0]->permission,
			));
			
			var_dump($this->session->all_userdata());
		}
			
	}
	function Logout(){
		$this->session->unset_userdata(array('name' =>'','permission'=>'',));
		redirect(base_url());
	}
}