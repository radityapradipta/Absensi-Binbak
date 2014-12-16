<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailySchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('daily_schedules', function(Blueprint $table) {
            // ---------- FIELD ----------
            $table->integer('id')->unsigned();
            $table->string('name', 30);
            $table->time('start_time');
            $table->time('end_time');

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
    public function down() {
        Schema::drop('daily_schedules');
    }

}
