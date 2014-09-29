<?php

class IndexController extends BaseController {
	public function index(){
		return View::make('index');
	}
	
	public function manageAllowance(){
		return View::make('layout.manageAllowance');
	}
	
	public function manageUser(){
		return View::make('layout.manageUser');
	}
	
	public function convertDocument(){
		return View::make('layout.convertDocument');
	}
	
	public function editProfile(){
		return View::make('layout.editProfile');
	}
	
	public function showLogin(){
		return View::make('layout.login');
	}
	
	/*public function getAllowance(){
		return View::make('layout.allowance');
	}
	*/
}
