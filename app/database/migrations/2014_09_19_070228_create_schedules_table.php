<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedules', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->increments('id');
			$table->date('start_date');
			$table->date('end_date');
			
			// ---------- KEY ----------		
			$table->integer('employee_id');//foreign key utk join dgn employee (kolom USERID)
			$table->integer('weekly_schedule_id');//foreign key utk join dgn weekly_schedule (kolom NUM_OF_RUN_ID)
			
			// ---------- OPTION ----------			
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schedules');
	}

}
