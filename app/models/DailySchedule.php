<?php

class DailySchedule extends Eloquent {

    protected $table = 'daily_schedules';
    protected $fillable = array('id', 'name', 'start_time', 'end_time');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function weeklySchedules() {
        return $this->hasMany('WeeklySchedule');
    }

}
