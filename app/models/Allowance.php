<?php

class Allowance extends Eloquent {

    protected $table = 'allowances';
    protected $fillable = array('id', 'weekday_nominal', 'weekend_nominal', 'cut_nominal', 'information');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function weeklySchedules() {
        return $this->hasMany('WeeklySchedule');
    }

    public function edit($input) {
        $this->weekday_nominal = $input['weekday_nominal'];
        $this->weekend_nominal = $input['weekend_nominal'];
        $this->cut_nominal = $input['cut_nominal'];
        $this->save();
    }

}
