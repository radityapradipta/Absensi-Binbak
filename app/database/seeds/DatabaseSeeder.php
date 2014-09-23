<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('EmployeeSeeder');
		$this->command->info('Employee seeds finished.');
		$this->call('DepartmentSeeder');
		$this->command->info('Department seeds finished.');
		$this->call('AbsenceSeeder');
		$this->command->info('Absence seeds finished.');
		$this->call('AbsenceCategorySeeder');
		$this->command->info('AbsenceCategory seeds finished.');
		$this->call('ScheduleSeeder');
		$this->command->info('Schedule seeds finished.');
		$this->call('WeeklyScheduleSeeder');
		$this->command->info('WeeklySchedule seeds finished.');		
		$this->call('DailyScheduleSeeder');
		$this->command->info('DailySchedule seeds finished.');
		$this->call('EmployeeScheduleSeeder');
		$this->command->info('EmployeeSchedule seeds finished.');
		$this->call('AutoCheckSeeder');
		$this->command->info('AutoCheck seeds finished.');		
		$this->call('ManualCheckSeeder');
		$this->command->info('ManualCheck seeds finished.');				
		
	}

}
