<?php

class Allowance extends Eloquent {

	protected $table = 'allowances';
	protected $fillable = array('weekday_nominal', 'weekend_nominal', 'cut_nominal');
	public $timestamps = false;
	
	// ---------- RELATION ----------
	
	public function departments() {
		return $this->hasMany('Department');
	}

}


