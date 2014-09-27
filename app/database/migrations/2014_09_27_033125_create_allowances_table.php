<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('allowances', function(Blueprint $table)
		{			
			// ---------- FIELD ----------
			$table->increments('id');
			$table->integer('weekday_nominal');
			$table->integer('weekend_nominal');
			$table->integer('cut_nominal');
			
			// ---------- KEY ----------
			
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
		Schema::drop('allowances');
	}

}
