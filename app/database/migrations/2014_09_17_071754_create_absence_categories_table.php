<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('absence_categories', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->tinyInteger('id')->unsigned();
			$table->string('name', 15);
			
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
		Schema::drop('absence_categories');
	}

}
