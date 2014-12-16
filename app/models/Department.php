<?php

class Department extends Eloquent {

    protected $table = 'departments';
//    protected $fillable = array('id', 'name', 'weekday_nominal', 'weekend_nominal', 'cut_nominal', 'super_department_id');
    protected $fillable = array('id', 'name', 'super_department_id');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function employees() {
        return $this->hasMany('Employee');
    }

    public function superDepartment() {
        return $this->belongsTo('Department');
    }

//    public function edit($input) {
//        $this->weekday_nominal = $input['weekday_nominal'];
//        $this->weekend_nominal = $input['weekend_nominal'];
//        $this->cut_nominal = $input['cut_nominal'];
//        $this->save();
//    }
}
