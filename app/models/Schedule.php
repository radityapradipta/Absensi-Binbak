<?php

class Schedule extends Eloquent {

    protected $table = 'schedules';
    protected $fillable = array('start_date', 'end_date', 'employee_id', 'weekly_schedule_id');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function employee() {
        return $this->belongsTo('Employee');
    }

    public function weekly_schedule() {
        return $this->belongsTo('WeeklySchedule');
    }

}
