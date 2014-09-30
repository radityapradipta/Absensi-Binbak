<?php

class AllowanceController extends BaseController {

	public function __construct()
	{
        
    }
	
    public function view(){
		$departments = Department::all();
		return View::make('allowances.view',array('departments'=>$departments));
    }
	
	public function showTable($id, $year, $month){
		$parameters = array('id'=>intval($id), 'year'=>intval($year), 'month'=>intval($month));
		$departments = Department::all();
		
		$y=date('Y');
		$m=date('n');		
		if($year>$y || ($year==$y && $month>$m)){
			return View::make('allowances.view',array('valid'=>FALSE, 'departments'=>$departments, 'parameters'=>$parameters));//data hanya tersedia utk bulan/tahun yg lewat
		}
		
		$employees = Employee::where('department_id', '=', "$id")->get();
		return View::make('allowances.view',array('valid'=>TRUE, 'departments'=>$departments, 'employees'=>$employees, 'parameters'=>$parameters));
	}

	public function manage(){		
		$departments = Department::all();
		return View::make('allowances.manage',array('departments'=>$departments));
	}	
	
	public function manageDepartment($id){	
		$departments = Department::all();
		$dept = Department::find($id);
		return View::make('allowances.manage',array('departments'=>$departments, 'dept'=>$dept));
	}

	public function applyChange(){
		$param = Input::all();
		$allowance=Department::find($param['id'])->allowance()->first();
		$allowance->edit($param);		
		return Response::json(array('valid' => TRUE));
	}
}
