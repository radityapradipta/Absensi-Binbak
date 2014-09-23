<?php

class ManualCheckSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('manual_checks')->delete();
		
		ManualCheck::create(array(
			'date_time'		=> '2014-09-22 06:55:00',		
			'is_in'			=> TRUE,
			'employee_id'	=> '4'
		));		
			
	}

}
