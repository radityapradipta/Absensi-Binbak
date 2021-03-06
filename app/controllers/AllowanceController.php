<?php

class AllowanceController extends BaseController {

    private $departments;
    private $allowances;

    public function __construct() {
        $dept_id = Department::distinct()->lists('super_department_id');
        $this->departments = Department::whereNotIn('id', $dept_id)->where('name', 'NOT LIKE', '%HONORER%')->orderBy('name')->get();
        $this->allowances = Allowance::all();
    }

    public function view() {
        return View::make('allowances.view', array('departments' => $this->departments));
    }

    public function viewTable($id, $year, $month) {
        $parameters = array('id' => intval($id), 'year' => intval($year), 'month' => intval($month));

        $y = date('Y');
        $m = date('n');
        if ($year > $y || ($year == $y && $month > $m)) {
            return View::make('allowances.view', array('valid' => FALSE, 'departments' => $this->departments, 'parameters' => $parameters)); //data hanya tersedia utk bulan/tahun yg lewat
        }

        set_time_limit(0);
        $employees = Employee::where('department_id', '=', "$id")->orderBy('name')->get();
        return View::make('allowances.view', array('valid' => TRUE, 'departments' => $this->departments, 'employees' => $employees, 'parameters' => $parameters));
    }

    public function downloadTable($id, $year, $month) {
        $contents = "DATA ABSENSI BINA BAKTI\n\n";

        $department = Department::find($id);
        $contents.= "Unit: ," . $department->name . "\n";

        $months = MyDate::get_month_names();
        $contents.= "Bulan: ," . $months[$month - 1] . "\n";
        $contents.= "Tahun: ," . $year . "\n\n";

        $contents.="KODE,NAMA,NORMAL,,PULANG AWAL,,,TERLAMBAT,LUPA,TUGAS LUAR,,OTHER,TIDAK MASUK,,,JUMLAH HARI MASUK,,JUMLAH HARI TIDAK MASUK,NOMINAL UANG KONSUMSI\n";
        $contents.=",,WEEKDAY,WEEKEND,WEEKDAY < 12,WEEKDAY >= 12,WEEKEND,,,WEEKDAY,WEEKEND,,SAKIT,IZIN,ALPHA,WEEKDAY,WEEKEND,,WEEKDAY,WEEKEND,PULANG AWAL,TOTAL\n";

        $employees = Employee::where('department_id', '=', $id)->orderBy('name')->get();
        $total = 0;
        foreach ($employees as $employee) {
            $contents.=$employee->ssn . ",";
            $contents.=$employee->name . ",";

            $data = Session::pull($employee->id, 'default');
            $total+=$data['konsumsi_total'];

            $contents.=$data['normal_weekday'] . ",";
            $contents.=$data['normal_weekend'] . ",";
            $contents.=$data['pulang_awal_weekday_before_12'] . ",";
            $contents.=$data['pulang_awal_weekday'] . ",";
            $contents.=$data['pulang_awal_weekend'] . ",";
            $contents.=$data['terlambat'] . ",";
            $contents.=$data['lupa'] . ",";
            $contents.=$data['tugas_luar_weekday'] . ",";
            $contents.=$data['tugas_luar_weekend'] . ",";
            $contents.=$data['other'] . ",";
            $contents.=$data['sakit'] . ",";
            $contents.=$data['izin'] . ",";
            $contents.=$data['alpha'] . ",";
            $contents.=$data['masuk_weekday'] . ",";
            $contents.=$data['masuk_weekend'] . ",";
            $contents.=$data['tidak_masuk'] . ",";
            $contents.=$data['konsumsi_weekday'] . ",";
            $contents.=$data['konsumsi_weekend'] . ",";
            $contents.=$data['konsumsi_pulang_awal'] . ",";
            $contents.=$data['konsumsi_total'] . ",";

            $contents.="\n";
        }
        $contents.=",,,,,,,,,,,,,,,,,,,,," . $total;

//        $file_name = "allowance.csv";
        $file = public_path() . "/download/allowance.csv";
        File::put($file, $contents);
        return Response::download($file, ("allowance-" . strtolower($department->name) . "-" . $month . "-" . $year . ".csv"), array(
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment;'
        ));
    }

    public function manage() {
        return View::make('allowances.manage', array('allowances' => $this->allowances));
    }

    public function manageAllowance($id) {
        $allow = Allowance::find($id);
        return View::make('allowances.manage', array('allowances' => $this->allowances, 'allow' => $allow));
    }

    public function applyChange() {
        $param = Input::all();
        $allowance = Allowance::find($param['id']);
        $allowance->edit($param);
        return Response::json(array('valid' => TRUE));
    }

}
