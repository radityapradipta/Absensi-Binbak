<?php

class AllowanceSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('allowances')->delete();
		
		Allowance::create(array(		
			'weekday_nominal'	=> 10000,
			'weekend_nominal'	=> 5000,
			'cut_nominal'		=> 5000
		));
		
		Allowance::create(array(		
			'weekday_nominal'	=> 20000,
			'weekend_nominal'	=> 5000,
			'cut_nominal'		=> 5000
		));
	}

}
