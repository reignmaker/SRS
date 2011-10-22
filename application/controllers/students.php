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
		
		$q = $this->students_model->get_students($condition);
		$i = 0;
		foreach ($q->result() as $student) {
			$data['students'][$i]['name'] = anchor('students/view/'.$student->id, $student->fname);
			$data['students'][$i]['spec'] = translate_term($student->spec);
			$data['students'][$i]['course'] = $student->course;
			$i++;
		}


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
	
	
	
	public function add_student($msg = NULL){
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
			),
			'yoe' => array(
				'name' => 'yoe',
				'id' => 'yoe'
			),
			'addr' => array(
				'name' => 'address',
				'id' => 'address'
			),
			'phone' => array(
				'name' => 'phone',
				'id' => 'phone'
			),
		);
		$data['msg'] = $msg;
		$data['title'] = 'Добавить студента';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/add_students';
		$this->load->view('template',$data);
	}



	
	function view($stid){
		$condition = array(
		'course' => $this->input->post('course'),
		'semester' => $this->input->post('semester'),
		);
		$data['student'] = $this->students_model->get_student($stid);
		$q = $this->students_model->view($stid);
		$i = 0;
		foreach ($q->result() as $subj) {
			
			$data['student_subjects'][$i]['subj'] = anchor('subjects/view/'.$subj->sbid, $subj->name,array('id'=>$subj->sbid));
			$data['student_subjects'][$i]['1'] = array('data'=>$subj->cs_first, 'class'=>'mark','rel'=>'cs_first');
			$data['student_subjects'][$i]['2'] = array('data'=>$subj->fr_first, 'class'=>'mark','rel'=>'fr_first');
			$data['student_subjects'][$i]['3'] = array('data'=>$subj->cs_second, 'class'=>'mark','rel'=>'cs_second');
			$data['student_subjects'][$i]['4'] = array('data'=>$subj->fr_second, 'class'=>'mark','rel'=>'fr_second');
			$data['student_subjects'][$i]['5'] = array('data'=>$subj->cs_third, 'class'=>'mark','rel'=>'cs_third');
			$data['student_subjects'][$i]['sum'] = ($subj->cs_first <0? 0:$subj->cs_first) + ($subj->fr_first <0? 0:$subj->fr_first)+ ($subj->cs_second <0? 0:$subj->cs_second) + ($subj->fr_second <0? 0:$subj->fr_second)
				+ ($subj->cs_third <0? 0:$subj->cs_third);
			$i++;
		}

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
		$this->load->view('template',$data);
	}

	function update($stid){
		$data['student'] = $this->students_model->get_student($stid);
	}

	function add(){
		$data = array(
			'fname' => $this->input->post('fname'),
			'spec' => $this->input->post('spec'),
			'course' => $this->input->post('course'),
			'yoe' => $this->input->post('yoe'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
		);
		if($data['course'] OR $data['fname'] OR $data['spec']){
		$result = $this->students_model->add_student($data);
			if($result == 'success'){
				$data['result'] = "Студент ". $data['fname']. " добавлен в базу";
			}else {
				$data['result'] = "Студент с такими данными уже существует ". anchor('students/view/'.$result[0]['id'],$result[0]['fname']).'.'.
				'Возможно, вы хотите ' . anchor('students/update/'.$result[0]['id'],'изменить') . ' его(ее) данные?';
			}
			$this->add_student($data['result']);
		}
		
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

