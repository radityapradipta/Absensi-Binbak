<?php

class ScheduleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('schedules')->delete();
		
		Schedule::create(array(
			'id'			=> 1,		
			'start_date'	=> '1900-01-01',
			'end_date'		=> '2100-01-01'
		));		

		Schedule::create(array(
			'id'			=> 2,		
			'start_date'	=> '1900-01-01',
			'end_date'		=> '2100-01-01'
		));		
	}

}
