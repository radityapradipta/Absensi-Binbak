<?php

class AttendanceController extends BaseController {

	public function __construct()
	{
        
    }
	
    public function index()
    {
		$employees = Employee::all();
		//$results = $this->guru->getData();
		//$g1=array('kode'=>'BB0113','nama'=>'Esther');
		//$g2=array('kode'=>'BB0125','nama'=>'Gloria');
		//$guru=array($g1,$g2);
        return View::make('attendances.index',array('employees'=>$employees));
    }

}
