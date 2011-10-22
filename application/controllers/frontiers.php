<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontiers extends CI_Controller{

	public function __construct()
    {
    	parent::__construct();
		$this->load->model('frontiers_model');
		$this->user->check_permission();

    }
	public function index(){
		
		$condition = array(
		'spec' => $this->input->post('spec')!='ANY' ? $this->input->post('spec'):'',
		'course' => $this->input->post('course')!='0' ? $this->input->post('course'): '',
		'sbid' => $this->input->post('subject')!='0' ? $this->input->post('subject'): '',
		'period' => $this->input->post('period'),
		);
		

		$opts = $this->frontiers_model->get_subjects_options();
		$options[] = 'Все предметы';
		foreach ($opts->result() as $row) {	
			$options[$row->id] =  $row->name;
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
			'subject' => array(
				'options' => $options,
				'selected' => $this->input->post('subject'),
				'default' => 'Все предметы',
			),
			'period' => array(
				'options' => array(
					'ANY' => 'Все',
					'cs_first' => 'Текущие I',
					'fr_first' => 'Рубежка I',
					'cs_second' => 'Текущие II',
					'fr_second' => 'Рубежка II',
					'cs_third' => 'Текущие III',
				),
				'selected' => $this->input->post('period'),
				'default' => 'Все',
			),
		);

		$data['caption'][] = ($this->input->post('course')) ?  $this->input->post('course'). ' курс':"Любой курс";
		$data['caption'][] = ($this->input->post('subject')) ?  $options[$this->input->post('subject')]:"Любой предмет";
		if($condition['period'] OR $condition['spec'] OR $condition['course']){
			
		$q = $this->frontiers_model->get_frontiers($condition);
		$i = 0;
		foreach ($q->result() as $row) {
				if (isset($row->fname)) {$data['frontiers'][$i]['name'] = array(
					'data'=>anchor('students/view/'.$row->id, $row->fname). '<input type="hidden" value="'.$row->sbid.'" name="'.$row->name.'">',
					'class'=>'name','id'=>$row->id);}
				$sum = 0;			
				if (isset($row->cs_first)) {$data['frontiers'][$i]['cs_f'] = array('data'=>$row->cs_first,'class'=>'mark','rel'=>'cs_first'); $sum += $row->cs_first <0? 0:$row->cs_first;}
				if (isset($row->fr_first)) {$data['frontiers'][$i]['fr_f'] = array('data'=>$row->fr_first,'class'=>'mark','rel'=>'fr_first'); $sum += $row->fr_first <0? 0:$row->fr_first;}
				if (isset($row->cs_second)) {$data['frontiers'][$i]['cs_s'] = array('data'=>$row->cs_second,'class'=>'mark','rel'=>'cs_second'); $sum += $row->cs_second <0? 0:$row->cs_second;}
				if (isset($row->fr_second)) {$data['frontiers'][$i]['fr_s'] = array('data'=>$row->fr_second,'class'=>'mark','rel'=>'fr_second'); $sum += $row->fr_second <0? 0:$row->fr_second;}
				if (isset($row->cs_third)) {$data['frontiers'][$i]['cs_t'] = array('data'=>$row->cs_third,'class'=>'mark','rel'=>'cs_third'); $sum += $row->cs_third <0? 0:$row->cs_third;}
				$data['frontiers'][$i]['sum'] = array('data' => $sum, 'class'=>'summ');
				$i++;
		}
		}
		$data['theading'] = array();
		if (isset($data['frontiers'])) {
			foreach ($data['frontiers'][0] as $key => $value) {
			switch ($key) {
				case 'check':
					$data['theading'][] = '<input type = "checkbox" class  = "sellect_all">';	
					break;
				case 'name':
					$data['theading'][] = 'Имя';	
					break;
				case 'cs_f':
					$data['theading'][] = 'Текущие I';	
					break;
				case 'fr_f':
					$data['theading'][] = 'Рубежка I';	
					break;
				case 'cs_s':
					$data['theading'][] = 'Текущие II';	
					break;
				case 'fr_s':
					$data['theading'][] = 'Рубежка II';	
					break;
				case 'cs_t':
					$data['theading'][] = 'Текущие III';	
					break;
				case 'sum':
					$data['theading'][] = 'Сумма';	
					break;
				default:
					break;
				}
			
			}
		}
		
		$data['panel'] = array('user' => $this->user->user,);
		$data['partial'] = 'partials/frontiers';
		$this->load->view('template',$data);
		
	}

	public function actions(){
		$field = $this->input->post('field');
		$studId = $this->input->post('id');
		$subjId = $this->input->post('subjId');
		$mark = $this->input->post('val');
		
		$data = array($field => $mark);
		if($this->frontiers_model->set_mark($studId, $subjId, $data)){
		echo "<h3>Успешно!</h3>";
		}else{
			echo "<h3>Ошибка!</h3>";
		}
	}
}
