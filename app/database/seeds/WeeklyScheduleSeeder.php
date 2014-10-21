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
			'daily_schedule_id'	=> 1
		));


		WeeklySchedule::create(array(
			'id'				=> 2,		
			'start_day'			=> 6,
			'end_day'			=> 7,
			'daily_schedule_id'	=> 1
		));			
		
		WeeklySchedule::create(array(
			'id'				=> 3,		
			'start_day'			=> 1,
			'end_day'			=> 3,
			'daily_schedule_id'	=> 1
		));

		WeeklySchedule::create(array(
			'id'				=> 4,		
			'start_day'			=> 4,
			'end_day'			=> 7,
			'daily_schedule_id'	=> 2
		));				
	}

}
