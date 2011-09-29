<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller{
	

	public function __construct()
    {
    	parent::__construct();
		$this->load->model('students_model');
		$this->user->check_permission();
		

    }
	public function index(){
		$condition = array(
			'spec' => $this->input->post('spec')!='ANY' ? $this->input->post('spec'):'',
			'course' => $this->input->post('course')!='0' ? $this->input->post('course'): '',
			);
		
		$data['students'] = $this->students_model->get_students($condition);
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
		$data['panel'] = array('user' => $this->user->user,);
		$data['title'] = 'Список студентов';
		$data['partial'] = 'partials/students';
		$this->load->view('template',$data);
	}
	
	
	
	public function add_student(){
		$data['options'] = array(
			'name' => array(
              'name'        => 'fname',
              'id'          => 'fname',
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
			),);
		$data['title'] = 'Добавить студента';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/add_students';
		$this->load->view('template',$data);
	}
	function view($stid){
		$data['student'] = $this->students_model->get_student($stid);
		$data['student_subjects'] = $this->students_model->view($stid);
		$data['options'] = array(
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
				'default' => $data['student']->course,
				),
				'semester' => array(
					'options' => array(
						'1' => '1',
						'2' => '2',
						),
					'selected' => $this->input->post('semester'),
					'default' => '1',
					),
			);
		
		$data['partial'] = 'partials/student';
		$data['panel'] = array('user' => $this->user->user,);
/*		var_dump($data['options']['course']['default']);
		var_dump($data['student']);*/
		$this->load->view('template',$data);
	}
	function add(){
		$data = array(
			'fname' => $this->input->post('fname'),
			'spec' => $this->input->post('spec'),
			'course' => $this->input->post('course')
		);
		$this->students_model->add_student($data);
		redirect('students/add_student');
		echo "Студент ". $data['fname']. "добавлен в базу";
		
	}
	function ext(){
		$condition = array(
			'spec' => $this->input->post('spec')!='ANY' ? $this->input->post('spec'):'',
			'course' => $this->input->post('course')!='0' ? $this->input->post('course'): '',
			);
		$data = $this->students_model->get_students($condition);
		//$students = array();
		foreach($data->result() as $row){
			
			$student = array(
				'fname' => $row->fname,
				'spec' => $row->spec,
				'course' => $row->course
			
			
			);
		
			$students[] = $student;
		}
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output
			    ->set_content_type('text/json');

		$this->output->set_header("Accept-Charset: utf-8");
		$this->output->set_header("Content-Type: text/json; charset=utf-8");

		echo(cyr_json($students));
	}


}

