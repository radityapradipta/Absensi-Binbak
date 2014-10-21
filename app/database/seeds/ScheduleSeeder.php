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
			'start_date'			=> '1900-01-01',
			'end_date'				=> '1999-01-01',
			'employee_id'			=>	1, 
			'weekly_schedule_id'	=>	2
		));		

		Schedule::create(array(	
			'start_date'			=> '1999-01-02',
			'end_date'				=> '2100-01-01',
			'employee_id'			=>	1, 
			'weekly_schedule_id'	=>	1
		));			
		
		Schedule::create(array(	
			'start_date'			=> '1900-01-01',
			'end_date'				=> '2100-01-01',
			'employee_id'			=>	2, 
			'weekly_schedule_id'	=>	1
		));	

		Schedule::create(array(	
			'start_date'			=> '1900-01-01',
			'end_date'				=> '2100-01-01',
			'employee_id'			=>	3, 
			'weekly_schedule_id'	=>	1
		));			

		Schedule::create(array(	
			'start_date'			=> '1900-01-01',
			'end_date'				=> '2100-01-01',
			'employee_id'			=>	4, 
			'weekly_schedule_id'	=>	2
		));				
		
		Schedule::create(array(	
			'start_date'			=> '1900-01-01',
			'end_date'				=> '2100-01-01',
			'employee_id'			=>	5, 
			'weekly_schedule_id'	=>	2
		));		
	}

}
