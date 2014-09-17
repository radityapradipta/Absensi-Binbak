<?php

class AbsenceSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('absences')->delete();
		
		Absence::create(array(
			'start'					=> strtotime("9/1/2014"),
			'end'					=> strtotime("9/1/2014 +7 day"),
			'reason'				=> 'LIVE-IN',
			'employee_id'			=> 2,
			'absence_category_id'	=> 4
		));
		
		Absence::create(array(
			'start'					=> strtotime("9/9/2014"),
			'end'					=> strtotime("9/1/2014 +1 day"),
			'reason'				=> 'Coaching Seminar Guru',
			'employee_id'			=> 4,
			'absence_category_id'	=> 5
		));
		
		Absence::create(array(
			'start'					=> strtotime("9/15/2014"),
			'end'					=> strtotime("9/15/2014 +2 day"),
			'reason'				=> 'mendampingi karya wisata',
			'employee_id'			=> 3,
			'absence_category_id'	=> 4
		));
		
	}

}
