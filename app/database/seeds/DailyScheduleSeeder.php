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
			'name'		=> 'sekretariat',
			'start_time'=> '07:00:00',
			'end_time'	=> '12:00:00'
		));				
	}

}
