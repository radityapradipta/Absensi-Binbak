<?php

class Role extends Eloquent {

	protected $table = 'roles';
	protected $fillable = array('name');
	public $timestamps = false;		
		
	// ---------- RELATION ----------
	
	public function accounts() {
		return $this->hasMany('Account');
	}

}
