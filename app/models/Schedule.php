<?php

class Schedule extends Eloquent {

	protected $table = 'schedules';
	protected $fillable = array('id', 'start_date', 'end_date');
	public $timestamps = false;
		
	// ---------- RELATION ----------

	public function employees() {
		return $this->belongsToMany('Employee', 'employees_schedules', 'schedule_id', 'employee_id');
	}
	
	public function weekly_schedules() {
		return $this->hasMany('WeeklySchedule');
	}

}
