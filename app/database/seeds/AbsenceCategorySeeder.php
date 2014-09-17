<?php

class AbsenceCategorySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('absence_categories')->delete();
		
		AbsenceCategory::create(array(
			'name'	=> 'vacation'			
		));
		
		AbsenceCategory::create(array(
			'name'	=> 'other'			
		));
		
		AbsenceCategory::create(array(
			'name'	=> 'tugas luar'			
		));
		
		AbsenceCategory::create(array(
			'name'	=> 'ijin'			
		));
		
		AbsenceCategory::create(array(
			'name'	=> 'cuti'			
		));
		
		AbsenceCategory::create(array(
			'name'	=> 'sakit'			
		));

		AbsenceCategory::create(array(
			'name'	=> 'lupa'			
		));		
		
	}

}
