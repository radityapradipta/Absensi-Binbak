<?php

class Absence extends Eloquent {

    protected $table = 'absences';
    protected $fillable = array('id', 'start_date', 'end_date', 'reason', 'employee_id', 'absence_category_id');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function employee() {
        return $this->belongsTo('Employee');
    }

    public function absenceCategory() {
        return $this->belongsTo('AbsenceCategory');
    }

}
