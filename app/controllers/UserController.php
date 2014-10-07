<?php

class UserController extends BaseController {

    public function __construct() {
        
    }

    public function edit() {
        return View::make('users.profile');
    }

    public function login() {
        return View::make('users.login');
    }

    public function postSignIn() {
        $validator = Validator::make(Input::all(), array(
                    'username' => 'required',
                    'password' => 'required'
                        )
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $auth = Auth::attempt(array(
                        'username' => Input::get('username'),
                        'password' => Input::get('password')
            ));
            if ($auth) {
                return Redirect::route('allowance');
            } else {
                return Redirect::back()->with('global', 'Username/Password wrong');
            }
        }
        return Redirect::back()->with('global', 'There was a problem signing you in.');
    }
	
	public function manage() {
	    $roles = Role::all();
        return View::make('users.manage',array('roles' => $roles));
    }
	
	public function manageRole($id) {
	    $roles = Role::all();
		$accounts = Account::where('role_id', '=', "$id")->get();
        return View::make('users.manage',array('roles' => $roles, 'role_id' => $id, 'accounts'=>$accounts));
    }
}
