<?php

class AllowanceController extends BaseController {

	public function __construct()
	{
        
    }
	
    public function view(){
		$departments = Department::all();
		return View::make('allowances.view',array('departments'=>$departments));
    }
	
	public function viewTable($id, $year, $month){
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

	public function downloadTable($id, $year, $month){
		$contents = "DATA ABSENSI BINA BAKTI\n\n";
		
		$department = Department::find($id);
		$contents.= "Unit: ,".$department->name."\n";
	
		$months = MyDate::get_month_names();
		$contents.= "Bulan: ,".$months[$month-1]."\n";
		$contents.= "Tahun: ,".$year."\n\n";
				
		$contents.="KODE ,NAMA , NORMAL, ,PULANG AWAL, , ,TERLAMBAT ,LUPA ,TUGAS LUAR ,OTHER ,TIDAK MASUK , , ,JUMLAH HARI MASUK, ,JUMLAH HARI TIDAK MASUK ,NOMINAL UANG KONSUMSI \n";
		$contents.=" , ,WEEKDAY ,WEEKEND ,WEEKDAY < 12 ,WEEKDAY >= 12 ,WEEKEND, , , , ,SAKIT ,IZIN ,ALPHA ,WEEKDAY ,WEEKEND , ,WEEKDAY ,WEEKEND ,PULANG AWAL , TOTAL \n";
				
		$employees = Employee::where('department_id', '=', "$id")->get();
		$total=0;
		foreach($employees as $employee){
			$contents.=$employee->ssn.",";
			$contents.=$employee->name.",";
			
			$data = $employee->get_absence_data($month, $year); 
			$total+=$data['konsumsi_total'];
			
			$contents.=$data['normal_weekday'].",";
			$contents.=$data['normal_weekend'].",";
			$contents.=$data['pulang_awal_weekday_before_12'].",";
			$contents.=$data['pulang_awal_weekday'].",";
			$contents.=$data['pulang_awal_weekend'].",";
			$contents.=$data['terlambat'].",";
			$contents.=$data['lupa'].",";
			$contents.=$data['tugas_luar'].",";
			$contents.=$data['other'].",";
			$contents.=$data['sakit'].",";
			$contents.=$data['izin'].",";
			$contents.=$data['alpha'].",";
			$contents.=$data['masuk_weekday'].",";
			$contents.=$data['masuk_weekend'].",";
			$contents.=$data['tidak_masuk'].",";
			$contents.=$data['konsumsi_weekday'].",";
			$contents.=$data['konsumsi_weekend'].",";
			$contents.=$data['konsumsi_pulang_awal'].",";
			$contents.=$data['konsumsi_total'].",";
						
			$contents.="\n";
		}
		$contents.=",,,,,,,,,,,,,,,,,,,,".$total;
		
		$file_name = "allowance.csv";
		$file = public_path(). "/download/allowance.csv";
		File::put($file, $contents);
		return Response::download($file, ("allowance-".strtolower($department->name)."-".$month."-".$year.".csv"), array(
			'Content-Type'              => 'text/csv',
			'Content-Disposition'       => 'attachment;'
		));
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
