<?php

class WeeklyScheduleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('weekly_schedules')->delete();

        $db = App::make('AccessDB');
        $query = new Query('NUM_RUN_DEIL', $db->get_dbh());
        $result = $query->get('NUM_RUNID,SDAYS,EDAYS,SCHCLASSID');
        foreach ($result as $row) {
            WeeklySchedule::create(array(
                'id' => $row['NUM_RUNID'],
                'start_day' => $row['SDAYS'],
                'end_day' => $row['EDAYS'],
                'daily_schedule_id' => $row['SCHCLASSID']
            ));
        }
    }

}
