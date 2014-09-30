<?php

class DepartmentSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('departments')->delete();
		
		Department::create(array(
			'id'					=> 1,		
			'name'					=> 'BINA BAKTI',
			'super_department_id'	=> 0,
			'allowance_id'			=> 1
		));
		
		Department::create(array(
			'id'					=> 2,		
			'name'					=> 'TKK 1',
			'super_department_id'	=> 1,
			'allowance_id'			=> 2
		));
		
		Department::create(array(
			'id'					=> 3,		
			'name'					=> 'SDK 1',
			'super_department_id'	=> 1,
			'allowance_id'			=> 3
		));
		
		Department::create(array(
			'id'					=> 4,		
			'name'					=> 'SDK 2',
			'super_department_id'	=> 1,
			'allowance_id'			=> 4
		));
	}

}
