<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Account extends Eloquent {

    use SoftDeletingTrait;

    protected $table = 'accounts';
    protected $fillable = array('username', 'password', 'remember_token', 'employee_id', 'role_id');
    protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

    // ---------- RELATION ----------

    public function employee() {
        return $this->belongsTo('Employee');
    }

    public function role() {
        return $this->belongsTo('Role');
    }

    // ---------- CRUD ----------

    public function edit($param) {
        $this->username = $param['username'];
        if ($param['password'] != '') {
            $this->password = $param['password'];
        }
        $this->employee_id = $param['emp'];
        $this->role_id = $param['role'];
        return $this->save();
    }

}
