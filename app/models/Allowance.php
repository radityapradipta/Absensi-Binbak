<?php

class Allowance extends Eloquent {

    protected $table = 'allowances';
    protected $fillable = array('weekday_nominal', 'weekend_nominal', 'cut_nominal');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function departments() {
        return $this->hasMany('Department');
    }

    // ---------- CRUD ----------

    public function edit($param) {
        $this->weekday_nominal = $param['weekday_nominal'];
        $this->weekend_nominal = $param['weekend_nominal'];
        $this->cut_nominal = $param['cut_nominal'];
        $this->save();
    }

}
