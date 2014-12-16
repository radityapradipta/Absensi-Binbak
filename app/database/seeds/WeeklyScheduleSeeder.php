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
        $result = $query->get('NUM_RUNID,STARTTIME,ENDTIME,SDAYS,EDAYS,SCHCLASSID');
        $result_array = [];
        foreach ($result as $row) {
            $allowance_id = 0;
            if ($row['SDAYS'] != 6) {
                $end = date_parse($row['ENDTIME']);
                $start = date_parse($row['STARTTIME']);
                $duration = (mktime($end['hour'], $end['minute']) - mktime($start['hour'], $start['minute'])) / 3600;
                if ($duration >= 8) {
                    $allowance_id = 1;
                } else if ($duration < 7) {
                    $allowance_id = 3;
                } else {
                    $allowance_id = 2;
                }
            }
            $result_array[] = [
                'id' => $row['NUM_RUNID'],
                'start_day' => $row['SDAYS'],
                'end_day' => $row['EDAYS'],
                'daily_schedule_id' => $row['SCHCLASSID'],
                'allowance_id' => $allowance_id
            ];
        }
        $weekly_schedule = array_chunk($result_array, 1000);
        foreach ($weekly_schedule as $value) {
            WeeklySchedule::insert($value);
        }
    }

}
