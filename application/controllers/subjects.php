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
				),												/*опции предмета нужно вынести в класс*/
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
			'teacher' => array(
				
				),
		);
		$data['title'] = 'Список предметов';
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/subjects';
		$this->load->view('template',$data);
	}
	
	public function add_subject(){
		$options[] = 'Преподаватель';
		$opts = $this->subjects_model->get_teacher();
		foreach ($opts as $row) {	
			$options[$row->id] =  $row->fname;
		}
		
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
			),
			'teacher' => $options,
			);
		
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
			'tid' => $this->input->post('teacher')*1,
		);

		$this->subjects_model->add_subject($data);
		
	}
	public function view($id){
		$data['subject'] = $this->subjects_model->get_subject($id);
		$data['teacher'] = $this->subjects_model->get_teacher($data['subject'][0]->tid);
		$q = $this->subjects_model->view($id);

		$i = 0;
		foreach ($q->result() as $student) {
			$data['subject_students'][$i]['name'] = anchor('students/view/'.$student->id, $student->fname);
			$data['subject_students'][$i]['1'] = array('data'=>$student->cs_first, 'class'=>'mark','rel'=>'cs_first');
			$data['subject_students'][$i]['2'] = array('data'=>$student->fr_first, 'class'=>'mark','rel'=>'fr_first');
			$data['subject_students'][$i]['3'] = array('data'=>$student->cs_second, 'class'=>'mark','rel'=>'cs_second');
			$data['subject_students'][$i]['4'] = array('data'=>$student->fr_second, 'class'=>'mark','rel'=>'fr_second');
			$data['subject_students'][$i]['5'] = array('data'=>$student->cs_third, 'class'=>'mark','rel'=>'cs_third');
			$data['subject_students'][$i]['sum'] = ($student->cs_first <0? 0:$student->cs_first) + ($student->fr_first <0? 0:$student->fr_first)+ ($student->cs_second <0? 0:$student->cs_second) + ($student->fr_second <0? 0:$student->fr_second)
				+ ($student->cs_third <0? 0:$student->cs_third);
			$i++;	
		}


		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/view_subject';
		$this->load->view('template',$data);
	}
	
}