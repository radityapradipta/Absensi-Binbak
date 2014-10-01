<?php

class Account extends Eloquent {

	protected $table = 'accounts';
	protected $fillable = array('username', 'password','remember_token','employee_id','role_id');
	protected $hidden = array('password', 'remember_token');
	public $timestamps = false;		
		
	// ---------- RELATION ----------
	
	public function employee() {
		return $this->belongsTo('Employee');
	}
	
	public function role() {
		return $this->belongsTo('Role');
	}
}
