<?php

class AttendanceController extends BaseController {

	public function __construct()
	{
        
    }
	
    public function index()
    {
		//$employees = Employee::all();
        //return View::make('attendances.index',array('employees'=>$employees));
		$departments = Department::all();
		return View::make('attendances.index',array('departments'=>$departments));
    }
	
	public function showTable($id, $year, $month){
		$parameters = array('id'=>intval($id), 'year'=>intval($year), 'month'=>intval($month));
		$departments = Department::all();
		
		$y=date('Y');
		$m=date('n');		
		if($year>$y || ($year==$y && $month>$m)){
			return View::make('attendances.index',array('valid'=>FALSE, 'departments'=>$departments, 'parameters'=>$parameters));//data hanya tersedia utk bulan/tahun yg lewat
		}
		
		$departments = Department::all();
		$employees = Employee::where('department_id', '=', "$id")->get();	
				
		return View::make('attendances.index',array('valid'=>TRUE, 'departments'=>$departments, 'employees'=>$employees, 'parameters'=>$parameters));
	}
	
}
