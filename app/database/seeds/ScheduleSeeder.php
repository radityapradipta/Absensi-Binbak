<?php

class ScheduleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('schedules')->delete();

        $db = App::make('AccessDB');
        $query = new Query('USER_OF_RUN', $db->get_dbh());
        $result = $query->get('STARTDATE,ENDDATE,USERID,NUM_OF_RUN_ID');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'start_date' => $row['STARTDATE'],
                'end_date' => $row['ENDDATE'],
                'employee_id' => $row['USERID'],
                'weekly_schedule_id' => $row['NUM_OF_RUN_ID']
            ];
        }
        $schedule = array_chunk($result_array, 1000);
        foreach ($schedule as $value) {
            Schedule::insert($value);
        }
    }

}
