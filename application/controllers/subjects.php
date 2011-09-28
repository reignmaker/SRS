<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends CI_Controller{
	
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('subjects_model');
		$this->user->check_permission();
    }
	public function index(){
		$condition = array(
			'spec' => $this->input->post('spec')!='ANY' ? $this->input->post('spec'):'',
			'course' => $this->input->post('course')!='0' ? $this->input->post('course'): '',
			'semester' => $this->input->post('semester')!='0' ? $this->input->post('semester')*1: '',
			);
		$data['subjects'] = $this->subjects_model->get_subjects($condition);
		
		$data['options'] =  array(
			'course' => array(
				'options' => array(
					'0'  => 'Любой курс',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					),
				'selected' => $this->input->post('course'),
				'default' => 'Любой курс',
				),
			'semester' => array(
				'options' => array(
					'0'  => 'Любой семестр',
					'1' => '1',
					'2' => '2',
				),
				'selected' => $this->input->post('semester'),
				'default' => 'Любой семестр',
			),
			'spec' => array(
				'options' => array(
					'ANY' => 'Любая специальность',
					'BIT' => 'Прикладная информатика в экономике',
					'PR' => 'Связи с общественностью',
					),
				'selected' => $this->input->post('spec'),
				'default' => 'Любая специальность',
				),
		);
		$data['title'] = 'Список предметов';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/subjects';
		$this->load->view('template',$data);
	}
	
	public function add_subject(){
		$data['options'] = array(
			'name' => array(
              'name'        => 'name',
              'id'          => 'name',
			 ),
			'course' => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			),
			'spec' => array(
			'BIT' => 'Прикладная информатика в экономике',
			'PR' => 'Связи с общественностью',
			),
			'semester' => array(
			'1' => '1',
			'2' => '2',
			),);
		$data['title'] = 'Добавить предмет';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/add_subject';
		$this->load->view('template',$data);
	}
	public function add(){
		$data = array(
			'name' => $this->input->post('name'),
			'spec' => $this->input->post('spec'),
			'semester' => ($this->input->post('course')-1)*2 + $this->input->post('semester'),
		);
		$this->subjects_model->add_subject($data);
		//return "Студент ". $data['fname'] . " добавлен в базу.";
		
	}
	public function view($id){
		$data['panel'] = array('user' => $this->user->user,);
		$data['subject'] = $this->subjects_model->view($id);
		$data['partial'] = 'partials/view_subject';
		$this->load->view('template',$data);
	}
	
}