<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auto_checks', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->dateTime('date_time');
			$table->boolean('is_in');
			
			// ---------- KEY ----------
			$table->integer('employee_id')->nullable();//foreign key utk join dgn employee
			
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
		Schema::drop('auto_checks');
	}

}
