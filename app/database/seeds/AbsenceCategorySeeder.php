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
			'id'	=> 2,		
			'name'	=> 'vacation'			
		));
		
		AbsenceCategory::create(array(
			'id'	=> 3,			
			'name'	=> 'other'			
		));
		
		AbsenceCategory::create(array(
			'id'	=> 4,			
			'name'	=> 'tugas luar'			
		));
		
		AbsenceCategory::create(array(
			'id'	=> 5,			
			'name'	=> 'izin'			
		));
		
		AbsenceCategory::create(array(
			'id'	=> 6,			
			'name'	=> 'cuti'			
		));
		
		AbsenceCategory::create(array(
			'id'	=> 7,			
			'name'	=> 'sakit'			
		));

		AbsenceCategory::create(array(
			'id'	=> 8,			
			'name'	=> 'lupa'			
		));		
		
	}

}
