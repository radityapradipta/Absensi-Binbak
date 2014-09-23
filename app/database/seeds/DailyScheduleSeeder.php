<?php

class DailyScheduleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('daily_schedules')->delete();
		
		DailySchedule::create(array(
			'id'		=> 1,		
			'name'		=> 'pagi',
			'start_time'=> '07:00:00',
			'end_time'	=> '12:00:00'
		));		

		DailySchedule::create(array(
			'id'		=> 2,		
			'name'		=> 'siang',
			'start_time'=> '09:00:00',
			'end_time'	=> '14:00:00'
		));		
			
	}

}
