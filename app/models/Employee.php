<?php

class Employee extends Eloquent {

	protected $table = 'employees';
	protected $fillable = array('ssn', 'name', 'is_male', 'birthday', 'street', 'department_id');
	public $timestamps = false;
	
	// ---------- RELATION ----------
	
	public function department() {
		return $this->belongsTo('Department');
	}

	public function absences() {
		return $this->hasMany('Absence');
	}
}
