<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			// ---------- FIELD ----------
			$table->increments('id');
			$table->string('username', 30);
			$table->string('password', 30);
			$table->string('remember_token', 100)->nullable();
			
			// ---------- KEY ------------
			$table->integer('employee_id')->nullable();//foreign key utk join dgn employee
			$table->integer('role_id')->nullable();//foreign key utk join dgn employee
			
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
		Schema::drop('accounts');
	}

}
