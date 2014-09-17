<?php

class AbsenceCategory extends Eloquent {

	protected $table = 'absence_categories';
	protected $fillable = array('name');
	public $timestamps = false;
	
	// ---------- RELATION ----------
	
	public function absences() {
		return $this->hasMany('Absence');
	}
}
