<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teachers extends CI_Controller{
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('teachers_model');
		$this->user->check_permission();
    }

    function index(){
    	$data['teachers'] = $this->teachers_model->get_teachers();
    	$data['title'] = 'Список преподавателей';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/teachers';
		$this->load->view('template',$data);
    	
    }
    	public function add_teacher($msg = NULL){
		$data['options'] = array(
			'name' => array(
              'name'        => 'fname',
              'id'          => 'fname',
			 ),
			
			'degree' => array(
				'id' => 'degree',
				'name' => 'degree',
			),
			'rank' => array(
				'rank' => 'rank',
				'rank' => 'rank',
			),
		);
		$data['msg'] = $msg;
		$data['title'] = 'Добавить преподавателя';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/add_teacher';
		$this->load->view('template',$data);
	}

	function add(){
		$data = array(
			'fname' => $this->input->post('fname'),
			'degree' => $this->input->post('degree'),
			'rank' => $this->input->post('rank'),
		);
		if($data['fname'] OR $data['degree'] OR $data['spec']){
		$result = $this->teachers_model->add_teacher($data);
			if($result == 'success'){
				$data['result'] = "Преподаватель ". $data['fname']. " добавлен в базу";
			}else {
				$data['result'] = "Преподаватель с такими данными уже существует ". anchor('teachers/view/'.$result[0]['id'],$result[0]['fname']).'.'.
				'Возможно, вы хотите ' . anchor('teachers/update/'.$result[0]['id'],'изменить') . ' его(ее) данные?';
			}
			$this->add_teacher($data['result']);
		}
		
	}

}