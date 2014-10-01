<?php

class Employee extends Eloquent {

	protected $table = 'employees';
	protected $fillable = array('id', 'ssn', 'name', 'is_male', 'birthday', 'street', 'department_id');
	public $timestamps = false;		
		
	// ---------- RELATION ----------
	
	public function account() {
		return $this->hasOne('Account');
	}	
	
	public function department() {
		return $this->belongsTo('Department');
	}

	public function schedules() {
		return $this->belongsToMany('Schedule', 'employees_schedules', 'employee_id', 'schedule_id');
	}
	
	public function absences() {
		return $this->hasMany('Absence');
	}
		
	public function autoChecks() {
		return $this->hasMany('AutoCheck');
	}

	public function manualChecks() {
		return $this->hasMany('ManualCheck');
	}	
			
	// ---------- FUNCTION ----------
	
	public function get_absence_data($month, $year){
		//tentukan range waktu (awal bulan-akhir bulan)
		$end_day = MyDate::get_number_of_day($month, $year);	
		$start_time = strtotime("$year-$month-01 00:00:00");
		$end_time = strtotime("$year-$month-$end_day 00:00:00");
		
		//ambil data jadwal		
		$schedule=array();//array jadwal per hari dlm 1 minggu, indeks 1=senin .... 7=minggu
		$weekly_schedules = $this->schedules()->orderBy('start_date', 'DESC')->first()->weekly_schedules()->get();		
		foreach($weekly_schedules as $ws){
			$dailySchedule = $ws->dailySchedule()->first();
			for ($i = $ws['start_day']; $i <= $ws['end_day']; $i++) {
				if($i==7){
					$schedule[0] = $dailySchedule;//di php, hari minggu indeks ke-0, bukan ke-7
				}else{
					$schedule[$i] = $dailySchedule;
				}
			}
		}	
		
		//ambil data uang konsumsi	
		$allowances = $this->department()->first()->allowance()->first();//->allowance();
		$allowance = array('weekday'=>$allowances->weekday_nominal,'weekend'=>$allowances->weekend_nominal,'pulang_awal'=>($allowances->weekday_nominal-$allowances->cut_nominal));
		
		//data utk disimpan
		$data = array(
			'normal_weekday'				=>0,
			'normal_weekend'				=>0,
			'pulang_awal_weekday_before_12'	=>0,
			'pulang_awal_weekday'			=>0,
			'pulang_awal_weekend'			=>0,
			'terlambat'						=>0,
			'lupa'							=>0,
			'tugas_luar'					=>0,
			'other'							=>0,
			'sakit'							=>0,
			'izin'							=>0,
			'alpha'							=>0,
			'masuk_weekday'					=>0,
			'masuk_weekend'					=>0,
			'tidak_masuk'					=>0,
			'konsumsi_weekday'				=>0,
			'konsumsi_weekend'				=>0,
			'konsumsi_pulang_awal'			=>0,
			'konsumsi_total'				=>0
		);

		//iterasi perhari dari awal bulan hingga akhir bulan
		for ($i = $start_time; $i <= $end_time; $i = strtotime("+1 day", $i)) {
			$current_date_start = date('Y-m-d 00:00:00', $i); 
			$current_date_end = date('Y-m-d 23:59:59', $i); 
			$current_day = date('w', $i);
			if($current_day != 0){//hari minggu libur jd tdk dihitung
				$alpha=TRUE;
				
				//periksa cek in-cek out
				$in = $this->autoChecks()->where('date_time', '>=', "$current_date_start")->where('date_time', '<=', "$current_date_end")->where('is_in', '=', TRUE)->first();
				if(is_null($in)){//jk tdk ada di yg auto, check yg manual
					$in = $this->manualChecks()->where('date_time', '>=', "$current_date_start")->where('date_time', '<=', "$current_date_end")->where('is_in', '=', TRUE)->first();
				}
				$out = $this->autoChecks()->where('date_time', '>=', "$current_date_start")->where('date_time', '<=', "$current_date_end")->where('is_in', '=', FALSE)->first();
				if(is_null($out)){//jk tdk ada di yg auto, check yg manual
					$out = $this->manualChecks()->where('date_time', '>=', "$current_date_start")->where('date_time', '<=', "$current_date_end")->where('is_in', '=', FALSE)->first();
				}
				if(is_null($in) xor is_null($out)){//lupa salah satu dari absen masuk/keluar
					$data['lupa']++;
					$alpha=FALSE;
				}else if(!is_null($in) && !is_null($out)){
					if(MyDate::is_late($in['date_time'], $schedule[$current_day]['start_time'])){
						$data['terlambat']++;
						$alpha=FALSE;
					}else if(MyDate::is_early($out['date_time'], $schedule[$current_day]['end_time'])){
						if($current_day==6){//hari sabtu
							$data['pulang_awal_weekend']++;
							$alpha=FALSE;
						}else if(MyDate::is_before_12($out['date_time'])){
							$data['pulang_awal_weekday_before_12']++;
							$alpha=FALSE;
						}else{
							$data['pulang_awal_weekday']++;
							$alpha=FALSE;
						}
					}else{
						if($current_day==6){//hari sabtu
							$data['normal_weekend']++;
							$alpha=FALSE;
						}else{
							$data['normal_weekday']++;
							$alpha=FALSE;
						}
					}
				}
				
				//periksa attendance
				$absence = $this->absences()->where('start_date', '<=', $current_date_start)->where('end_date', '>=', $current_date_start)->first();	
				if(!is_null($absence)){
					$category_id = $absence['absence_category_id'];
					switch($category_id){
						case 3:	
							$data['other']++;			
							break;
						case 4:	
							$data['tugas_luar']++;
							break;
						case 5:	
							$data['izin']++;								
							break;
						case 6:	//cuti dihitung sbg other
							$data['other']++;			
							break;
						case 7:	
							$data['sakit']++;			
							break;						
						case 8:	
							$data['lupa']++;				
							break;
					}
					$alpha=FALSE;					
				}
				
				//tidak ada yang ditemukan
				if($alpha){
					$data['alpha']++;
				}				
			}	
		}

		$data['masuk_weekday'] = $data['normal_weekday']+$data['pulang_awal_weekday_before_12']+$data['pulang_awal_weekday']+$data['terlambat']+$data['lupa']+$data['tugas_luar']+$data['other'];
		$data['masuk_weekend'] = $data['normal_weekend']+$data['pulang_awal_weekend'];
		$data['tidak_masuk'] = $data['sakit']+$data['izin']+$data['alpha'];
		$data['konsumsi_weekday'] = $allowance['weekday']*($data['normal_weekday']+$data['tugas_luar']+$data['other']);
		$data['konsumsi_weekend'] = $allowance['weekend']*$data['normal_weekend'];
		$data['konsumsi_pulang_awal'] = $allowance['pulang_awal']*$data['pulang_awal_weekday'];
		$data['konsumsi_total'] = $data['konsumsi_weekday']+$data['konsumsi_weekend']+$data['konsumsi_pulang_awal'];

		return $data;
	}

}
