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
			'id'					=> 1,		
			'start_date'			=> '2014-08-01',
			'end_date'				=> '2014-08-08',
			'reason'				=> 'LIVE-IN',
			'employee_id'			=> 2,
			'absence_category_id'	=> 4
		));
		
		Absence::create(array(
			'id'					=> 2,		
			'start_date'			=> '2014-09-09 08:00:00',
			'end_date'				=> '2014-09-09 10:00:00',
			'reason'				=> 'Coaching Seminar Guru',
			'employee_id'			=> 4,
			'absence_category_id'	=> 5
		));
		
		Absence::create(array(
			'id'					=> 3,		
			'start_date'			=> '2014-09-15',
			'end_date'				=> '2014-09-16',
			'reason'				=> 'mendampingi karya wisata',
			'employee_id'			=> 3,
			'absence_category_id'	=> 4
		));
		
	}

}
