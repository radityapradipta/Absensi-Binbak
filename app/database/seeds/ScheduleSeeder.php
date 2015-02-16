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
        $query->order('STARTDATE');
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
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[5] = $result[count($result) - 1]['STARTDATE'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
