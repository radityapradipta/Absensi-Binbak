<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklySchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weekly_schedules', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->increments('id');
			$table->tinyInteger('start_day')->unsigned();
			$table->tinyInteger('end_day')->unsigned();
			
			// ---------- KEY ----------
			//$table->primary('id'); //(kolom NUM_RUNID)
			$table->integer('daily_schedule_id');//foreign key utk join dgn schedule sehari2 (wkt mulai & selesai)(kolom SCHCLASSID)
			
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
		Schema::drop('weekly_schedules');
	}

}
