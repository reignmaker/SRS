<?php

class Calendar_model extends CI_Model{
	
	var $conf;
	function Calendar_model(){
		parent::__construct();
		$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => TRUE,
			'next_prev_url' => base_url() . 'index.php/atendance/calendar'
		);
		
		$this->conf['template'] = '

   	{table_open}
   		<table class = "calendar">
	{/table_open}

   	{heading_row_start}
		<tr>
	{/heading_row_start}

   	{heading_previous_cell}
		<th>
			<a href="{previous_url}">&lt;&lt;</a>
		</th>
	{/heading_previous_cell}
   	
	{heading_title_cell}
		<th colspan="{colspan}">{heading}</th>
	{/heading_title_cell}
   	
	{heading_next_cell}
		<th>
			<a href="{next_url}">&gt;&gt;</a>
		</th>
	{/heading_next_cell}

   	{heading_row_end}</tr>{/heading_row_end}

  	{week_row_start}<tr>{/week_row_start}
   	{week_day_cell}<td>{week_day}</td>{/week_day_cell}
   	{week_row_end}</tr>{/week_row_end}

   	{cal_row_start}<tr>{/cal_row_start}
   	{cal_cell_start}<td>{/cal_cell_start}

   	{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
   	{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

   	{cal_cell_no_content}{day}{/cal_cell_no_content}
   	{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

   	{cal_cell_blank}&nbsp;{/cal_cell_blank}

   	{cal_cell_end}</td>{/cal_cell_end}
   	{cal_row_end}</tr>{/cal_row_end}

   	{table_close}</table>{/table_close}
';
	$this->load->library('calendar',$this->conf);
	}
	
	function get_calendar_data($year, $month){
		$year = ($year == '')? date('Y'): $year;
		$month = ($month == '')? date('m'): $month;
		$calendar_data = array();
		$q = $this->db->distinct()
					  ->select('date')
					  ->from('lates')
					  ->where('is_late >', 0)
					  ->like('date',"$year-$month",'after')->get();
		foreach ($q->result() as $row){
			$calendar_data[substr($row->date,8,2)+ 0] = base_url() . "index.php/atendance/lates/$year/$month/".substr($row->date,8,2);
		}
		 return $calendar_data;
	}
	
	

	function generate($year, $month){
	
		$calendar_data = $this->get_calendar_data($year, $month);
		return $this->calendar->generate($year, $month, $calendar_data);
	}
	
	function get_total_days($year, $month){
		return $this->calendar->get_total_days($month, $year);
	}
	/**
	*	Build students lates data
	* 
	*/
	function get_lates($year, $month, $day){
		$like = "";
		if($year == null)$like = ""; 
		elseif($month == null)$like = "$year-";
		elseif($day == null)$like = "$year-$month" ;else $like.="$year-$month-$day";
		$lates = $this->db->distinct()
					  ->select('sid, pair, date')
					  ->from('lates')
					  ->where('is_late >', 0)
					  ->like('date',"$like", 'after')
					  ->get();
		
		return $lates;
	}
	
}