<?php
class Atendance extends CI_Controller{

   public function __construct()
   {
        parent::__construct();
			$this->load->model('Calendar_model');

   }


	public function calendar($year = null, $month = null){
	
	$data['calendar'] = $this->Calendar_model->generate($year,$month);
	$data['total_days'] = $this->Calendar_model->get_total_days($year, $month);
	$this->load->view('calendar', $data);
	}
	
	public function lates($year = null, $month = null, $day = null){
	$this->load->library('table');
	$data['lates'] = $this->Calendar_model->get_lates($year, $month, $day);
	$this->load->view('lates',$data);
	}
	
}
