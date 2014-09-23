<?php

class EmployeeScheduleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('employees_schedules')->delete();
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 1,		
			'schedule_id'	=> 1,
		));
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 1,		
			'schedule_id'	=> 2,
		));
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 2,		
			'schedule_id'	=> 2,
		));
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 3,		
			'schedule_id'	=> 1,
		));
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 4,		
			'schedule_id'	=> 1,
		));
		
		EmployeeSchedule::create(array(
			'employee_id'	=> 5,		
			'schedule_id'	=> 1,
		));		
		
	}

}
