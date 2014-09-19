<?php

class Employee extends Eloquent {

	protected $table = 'employees';
	protected $fillable = array('id', 'ssn', 'name', 'is_male', 'birthday', 'street', 'department_id');
	public $timestamps = false;
		
	// ---------- RELATION ----------
	
	public function department() {
		return $this->belongsTo('Department');
	}

	public function schedules() {
		return $this->belongsToMany('Schedule', 'employees_schedules', 'employee_id', 'schedule_id');
	}
	
	public function absences() {
		return $this->hasMany('Absence');
	}
		
	public function autoChecks() {
		return $this->hasMany('AutoCheck');
	}

	public function manualChecks() {
		return $this->hasMany('ManualCheck');
	}	
			
	// ---------- FUNCTION ----------
	
	public function count_absence_day($month, $year){
		//menentukan akhir bulan 
		$end_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$day = $end_day[$month-1];//index array dari 0 jd hrs -1
		if($month == 2){
			if((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0))){
				$day = 29;
			}
		}	
		
		//query sesuai range awal bulan-akhir bulan 
		$absences = $this->absences()->where('end_date', '>=', "$year-$month-01")->where('start_date', '<=', "$year-$month-$day")->get();		
		$data = array(0,0,0,0,0,0,0,0);	
		foreach ($absences as $a) {
			$start = strtotime($a['start_date']);
			$end = strtotime($a['end_date']);			
			if($start < strtotime("$year-$month-01")){//utk event (cuti, libur, dkk) yg mulai sejak bulan lalu
				$start = strtotime("$year-$month-01");
			}			
			if($end > strtotime("$year-$month-$day")){//utk event (cuti, libur, dkk) yg selesai hingga bulan depan
				$end = strtotime("$year-$month-$day");
			}			
			$long = date("d",($end-$start));  + 1;//jumlah hari tdk masuk						
			$category_id = $a['absence_category_id'];
			$data[$category_id-1] = $data[$category_id-1] + $long;//index array dari 0 jd hrs -1
		}
				
		return $data;
	}

}
