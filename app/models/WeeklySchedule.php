<?php

class WeeklySchedule extends Eloquent {

    protected $table = 'weekly_schedules';
    protected $fillable = array('id', 'start_day', 'end_day', 'daily_schedule_id');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function dailySchedule() {
        return $this->belongsTo('DailySchedule');
    }

}
