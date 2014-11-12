<?php

class Holiday extends Eloquent {

    protected $table = 'holidays';
    protected $fillable = array('id', 'start', 'duration', 'end');
    public $timestamps = false;

    // ---------- RELATION ----------
}
