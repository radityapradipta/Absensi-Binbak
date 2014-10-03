<?php

class AutoCheck extends Eloquent {

    protected $table = 'auto_checks';
    protected $fillable = array('date_time', 'is_in', 'employee_id');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function employee() {
        return $this->belongsTo('Employee');
    }

}
