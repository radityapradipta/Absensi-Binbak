<?php

class EmployeeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('employees')->delete();
		
		Employee::create(array(
			'ssn'			=> 'BB1000',
			'name'			=> 'ROSENTA',
			'is_male'		=> FALSE,
			'birthday'		=> strtotime("12/27/1977"),
			'street'		=> 'Gg.MesjidBojong Pulus Banjara',
			'department_id'	=> 1
		));
		
		Employee::create(array(
			'ssn'			=> 'BB1005',
			'name'			=> 'BENJAMIN',
			'is_male'		=> TRUE,
			'birthday'		=> strtotime("4/14/1956"),
			'street'		=> 'TKI I Q/31',
			'department_id'	=> 1
		));
		
		Employee::create(array(
			'ssn'			=> 'BB1007',
			'name'			=> 'RIKEU R',
			'is_male'		=> FALSE,
			'birthday'		=> strtotime("8/5/1969"),
			'street'		=> 'Kompl CempakaArum Blok D12/156',
			'department_id'	=> 1
		));
		
		Employee::create(array(
			'ssn'			=> 'BB1014',
			'name'			=> 'RIRIS',
			'is_male'		=> FALSE,
			//'birthday'		=> strtotime("12/27/1977"), null
			'street'		=> 'Jl.Topas Q4/18 Permata Cimahi',
			'department_id'	=> 2
		));
		
		Employee::create(array(
			'ssn'			=> 'BB0102',
			'name'			=> 'RINDARTI',
			'is_male'		=> FALSE,
			'birthday'		=> strtotime("12/6/1963"),
			'street'		=> 'Komp. Margahayu Raya P-15',
			'department_id'	=> 2
		));
	}

}
