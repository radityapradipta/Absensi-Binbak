<?php

class AutoCheckSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('auto_checks')->delete();
		
		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 06:55:00',		
			'is_in'			=> TRUE,
			'employee_id'	=> '1'
		));		

		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 06:59:00',		
			'is_in'			=> TRUE,
			'employee_id'	=> '2'
		));		

		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 07:35:00',		
			'is_in'			=> TRUE,
			'employee_id'	=> '3'
		));				

		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 10:55:00',		
			'is_in'			=> FALSE,
			'employee_id'	=> '1'
		));		

		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 15:59:00',		
			'is_in'			=> FALSE,
			'employee_id'	=> '2'
		));		

		AutoCheck::create(array(
			'date_time'		=> '2014-09-22 19:35:00',		
			'is_in'			=> FALSE,
			'employee_id'	=> '3'
		));			
		
	}

}
