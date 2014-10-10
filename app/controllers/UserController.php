<?php

class UserController extends BaseController {

    public function __construct() {
        
    }

    public function login() {
        return View::make('users.login');
    }

	public function getSignOut(){
		Auth::logout();
		return Redirect::route('login');
	}
	
    public function postSignIn() {
		$auth = Auth::attempt(array(
					'username' => Input::get('username'),
					'password' => Input::get('password')
		));
		if ($auth) {
			Session::put('username', Input::get('username'));
			return Redirect::intended('dashboard');
		} else {
			return Redirect::back()->with('global', 'Username/Password wrong');
		}
        return Redirect::back()->with('global', 'There was a problem signing you in.');
    }
	
	public function getDashboard(){
		return View::make('layouts.dashboard');
	}
	
    public function manage() {
        $roles = Role::all();
        return View::make('users.manage', array('roles' => $roles));
    }

    public function manageRole($id) {
        $roles = Role::all();
        $accounts = Account::where('role_id', '=', "$id")->get();
        return View::make('users.manage', array('roles' => $roles, 'role_id' => $id, 'accounts' => $accounts));
    }

    public function add() {
        $param = Input::all();
        $emp_id = Employee::where('ssn', '=', $param['ssn'])->pluck('id');
        Account::create(array(
            'username' => $param['username'],
            'password' => Hash::make($param['password']),
            'employee_id' => $emp_id,
            'role_id' => $param['role'],
        ));
        return Response::json(array('valid' => TRUE));
    }

    public function update() {
        $param = Input::all();
        $emp_id = Employee::where('ssn', '=', $param['ssn'])->pluck('id');
        $user = Account::find($param['id']);
        $res = $user->edit(array('username' => $param['username'], 'password' => $param['password'], 'emp' => $emp_id, 'role' => $param['role']));
        return Response::json(array('valid' => $res));
    }

    public function remove() {
        $param = Input::all();
        $res = Account::where('id', '=', $param['id'])->delete();
        return Response::json(array('valid' => $res));
    }

    public function editPassword() {
        return View::make('users.profile');
    }

    public function savePassword() {
        $auth = Auth::attempt(array(
                    'username' => Session::get('username'),
                    'password' => Input::get('old-password')
        ));
        if ($auth) {
            $account = Account::where('username', '=', Session::get('username'))->first();
            $account->password = Hash::make(Input::get('new-password'));
            $account->save();
            return Response::json(array('valid' => TRUE, 'message' => 'The password is successfully changed.'));
        } else {
            return Response::json(array('valid' => FALSE, 'message' => 'The old password is incorrect.'));
        }
    }

}
