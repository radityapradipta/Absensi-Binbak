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
			$table->integer('id')->unsigned();
			$table->date('start_date');
			$table->date('end_date');
			
			// ---------- KEY ----------		
			$table->primary('id');
						
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
