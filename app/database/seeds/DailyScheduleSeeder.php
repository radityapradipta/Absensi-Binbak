<?php

class DailyScheduleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('daily_schedules')->delete();

        $db = App::make('AccessDB');
        $query = new Query('SCHCLASS', $db->get_dbh());
        $result = $query->get('SCHCLASSID,SCHNAME,STARTTIME,ENDTIME');
        foreach ($result as $row) {
            DailySchedule::create(array(
                'id' => $row['SCHCLASSID'],
                'name' => $row['SCHNAME'],
                'start_time' => $row['STARTTIME'],
                'end_time' => $row['ENDTIME']
            ));
        }
    }

}
