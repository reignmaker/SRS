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
					'ANY' => 'Любой период',
					'1' => 'Первый модуль',
					'2' => 'Первая рубежка',
					'3' => 'Второй модуль',
					'4' => 'Вторая рубежка',
					'5' => 'Третий модуль',
					'6' => 'Только модули',
					'7' => 'Только рубежки',
				),
				'selected' => $this->input->post('period'),
				'default' => 'Любой период',
			),
		);

		$data['caption'][]= ($this->input->post('course')) ?  $this->input->post('course'). ' курс':"Любой курс";
		$data['caption'][] = ($this->input->post('subject')) ?  $options[$this->input->post('subject')]:"Любой предмет";
	
		$q = $this->frontiers_model->get_frontiers($condition);
		$i = 0;
		$data['theading'] = array();
		foreach ($q->result() as $row) {
				if (isset($row->fname)) {$data['frontiers'][$i]['name'] = array(
					'data'=>$row->fname. '<input type="hidden" value="'.$row->sbid.'">',
					'class'=>'name','id'=>$row->id);}
				if (isset($row->cs_first)) {$data['frontiers'][$i]['cs_f'] = array('data'=>$row->cs_first,'class'=>'mark','rel'=>'cs_first');}
				if (isset($row->fr_first)) {$data['frontiers'][$i]['fr_f'] = array('data'=>$row->fr_first,'class'=>'mark','rel'=>'fr_first');}
				if (isset($row->cs_second)) {$data['frontiers'][$i]['cs_s'] = array('data'=>$row->cs_second,'class'=>'mark','rel'=>'cs_second');}
				if (isset($row->fr_second)) {$data['frontiers'][$i]['fr_s'] = array('data'=>$row->fr_second,'class'=>'mark','rel'=>'fr_second');}
				if (isset($row->cs_third)) {$data['frontiers'][$i]['cs_t'] = array('data'=>$row->cs_third,'class'=>'mark','rel'=>'cs_third');}
				$data['frontiers'][$i]['mng_mark'] ='
				<a href="'.base_url().'index.php/frontiers/add_mark/'.$row->id.'/'.$row->sbid.'" class = "websymbol addbtn" title = "Поставить">+</a>
				<a href="'.base_url().'index.php/frontiers/upd_mark/'.$row->id.'/'.$row->sbid.'" class = "websymbol updbtn" title = "Изменить">*</a>
				<a href="'.base_url().'index.php/frontiers/del_mark/'.$row->id.'/'.$row->sbid.'" class = "websymbol delbtn" title = "Удалить">×</a>';
				$i++;
		}
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
					$data['theading'][] = 'Первый модуль';	
					break;
				case 'fr_f':
					$data['theading'][] = 'Первая рубежка';	
					break;
				case 'cs_s':
					$data['theading'][] = 'Второй модуль';	
					break;
				case 'fr_s':
					$data['theading'][] = 'Вторая рубежка';	
					break;
				case 'cs_t':
					$data['theading'][] = 'Третий модуль';	
					break;
				case 'mng_mark':
					$data['theading'][] = 'Изменить баллы';	
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
