<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_schedules', function(Blueprint $table)
		{
			// ---------- FIELD ----------

			
			// ---------- KEY ----------	
			$table->integer('employee_id')->unsigned();//foreign key
			$table->integer('schedule_id')->unsigned();//foreign key
			$table->primary(array('employee_id', 'schedule_id'));//composite primary key
						
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
		Schema::drop('employees_schedules');
	}

}
