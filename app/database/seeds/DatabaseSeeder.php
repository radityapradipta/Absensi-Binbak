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
	}

}
