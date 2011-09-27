<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	

	public function __construct()
    {
    	parent::__construct();
		$this->load->model('login_model');

    }


	public function Index(){
		$data['partial'] = 'partials/login';
		$this->load->view('template',$data);
	}

	public function Login(){
		$user = $this->login_model->verify_user($this->input->post('name'),sha1($this->input->post('pwd')))->result();
		if($user){
			$this->session->set_userdata(array(
					'name' => $user[0]->name,
					'permission' => $user[0]->permission,
			));
			
			var_dump($this->session->all_userdata());
		}
		else {
				$this->session->set_userdata(array(
					'name' => 'guest',
					'permission' => 'read',
				));
				var_dump($this->session->all_userdata());
			}	
				
	}
}