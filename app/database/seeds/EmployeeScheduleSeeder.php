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
	}

}
