<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('holidays', function(Blueprint $table)
		{
			$table->integer('id')->unsigned();
			$table->date('start');
			$table->tinyInteger('duration')->unsigned();
			
			// ---------- KEY ----------
			$table->primary('id');
			
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
		Schema::drop('holidays');
	}

}
