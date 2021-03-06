<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklySchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('weekly_schedules', function(Blueprint $table) {
            // ---------- FIELD ----------
            $table->integer('id')->unsigned();
            $table->tinyInteger('start_day')->unsigned();
            $table->tinyInteger('end_day')->unsigned();

            // ---------- KEY ----------
            $table->integer('daily_schedule_id'); //foreign key utk join dgn schedule sehari2 (wkt mulai & selesai)(kolom SCHCLASSID)
            $table->integer('allowance_id'); //foreign key utk menunjuk nominal uang konsumsi
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
        Schema::drop('weekly_schedules');
    }

}
