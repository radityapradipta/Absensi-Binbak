<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->integer('id')->unsigned();
			$table->string('ssn', 6)->nullable();
			$table->string('name', 30);
			$table->boolean('is_male')->nullable();	
			$table->date('birthday')->nullable();
			$table->string('street', 60)->nullable();
			
			// ---------- KEY ----------
			$table->primary('id');
			$table->integer('department_id')->nullable();//foreign key utk join dgn department
			
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
		Schema::drop('employees');
	}

}
