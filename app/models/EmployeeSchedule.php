<?php

class EmployeeSchedule extends Eloquent {

    protected $table = 'employees_schedules';
    protected $fillable = array('employee_id', 'schedule_id');
    public $timestamps = false;

    // ---------- RELATION ----------
}
