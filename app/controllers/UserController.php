<?php

class UserController extends BaseController {

	public function __construct()
	{
        
    }
	
    public function edit(){
		return View::make('Users.profile');
    }	
	
}
