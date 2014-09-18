<?php

class Department extends Eloquent {

	protected $table = 'departments';
	protected $fillable = array('id', 'name', 'super_department_id');
	public $timestamps = false;
	
	// ---------- RELATION ----------
	
	public function employees() {
		return $this->hasMany('Employee');
	}
	
	public function superDepartment() {
		return $this->belongsTo('Department');
	}
}
