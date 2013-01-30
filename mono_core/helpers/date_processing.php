<?php
// Business Object Layer
class DateProcessing {
	// diff
	public $year;
	public $month;
	public $day;
	public $hour;
	public $min;
	public $sec;
	
	public $days;
	 
	function DateProcessing() {
	}
	
	// Get Differense between two days
	function diff($start, $end = false) { 
		// Checks $start and $end format (timestamp only for more simplicity and portability) 
		if(!$end) { $end = new DateTime('now'); } 
		    
		$_day_start_date = (int)($start->format('d'));
		$_day_end_date = (int)($end->format('d'));
		$_month_start_date = (int)($start->format('m'));
		$_month_end_date = (int)($end->format('m'));
		$_year_start_date = (int)($start->format('y'));
		$_year_end_date = (int)($end->format('y'));
		        
		$current_date = mktime (0, 0, 0, $_month_start_date, $_day_start_date, $_year_start_date);
		$old_date = mktime (0, 0, 0, $_month_end_date, $_day_end_date, $_year_end_date);
		
		$difference = (int)($old_date-$current_date);		//разница в секундах
		$difference_in_days = (int)($difference / 86400);	//разница в днях
		//if($difference_in_days == 0)
			//$difference_in_days = 1;
		
		// return all data 
		$this->sec  = $difference;
		$this->min  = (int)($difference / 60);
		$this->hour = (int)($this->min / 60);
		$this->days = $difference_in_days;
		//$this->year    = $diff->format('%y');
		//$this->month    = $diff->format('%m');
		//$this->day      = $diff->format('%d');
		//$this->hour     = $diff->format('%h');
		//$this->min      = $diff->format('%i');
		//$this->sec      = $diff->format('%s');
		    
		return true; 
	} 
}
?>