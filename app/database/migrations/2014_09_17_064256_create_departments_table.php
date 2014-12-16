<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('departments', function(Blueprint $table) {
            // ---------- FIELD ----------
            $table->integer('id')->unsigned();
            $table->string('name', 30);

            // ---------- KEY ----------
            $table->primary('id');
            $table->integer('super_department_id')->nullable(); //foreign key utk menunjuk parent departementnya
            // ---------- OPTION ----------
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('departments');
    }

}
