<?php

class IndexController extends BaseController {
	public function index(){
		return View::make('index');
	}
	
	public function manageAllowance(){
		return View::make('layout.manageAllowance');
	}
	
	public function manageUser(){
		return View::make('layouts.manageUser');
	}
	
	public function convertDocument(){
		return View::make('layouts.convertDocument');
	}
	
	public function editProfile(){
		return View::make('layouts.editProfile');
	}
	
	public function showLogin(){
		return View::make('layouts.login');
	}
	
	/*public function getAllowance(){
		return View::make('layout.allowance');
	}
	*/
}
