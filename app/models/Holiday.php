<?php

class Holiday extends Eloquent {

    protected $table = 'holidays';
    protected $fillable = array('id', 'start', 'duration');
    public $timestamps = false;

    // ---------- RELATION ----------
}
