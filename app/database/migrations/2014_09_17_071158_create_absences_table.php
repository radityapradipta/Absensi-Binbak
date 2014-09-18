<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('absences', function(Blueprint $table)
		{			
			// ---------- FIELD ----------
			$table->integer('id')->unsigned();
			$table->dateTime('start');
			$table->dateTime('end');
			$table->string('reason',200)->nullable();	
			
			// ---------- KEY ----------
			$table->primary('id');
			$table->integer('employee_id');//foreign key utk join dgn employee
			$table->integer('absence_category_id');//foreign key utk menentukan kategori dr ketidakhadiran tsb
			
			// ---------- OPTION ----------
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('absences');
	}

}
