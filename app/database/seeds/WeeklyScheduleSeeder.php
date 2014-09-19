<?php

class WeeklyScheduleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('weekly_schedules')->delete();
		
		WeeklySchedule::create(array(
			'id'				=> 1,		
			'start_day'			=> 1,
			'end_day'			=> 5,
			'schedule_id'		=> 1,
			'daily_schedule_id'	=> 1
		));				
	}

}
