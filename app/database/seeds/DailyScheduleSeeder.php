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
        $query->order('SCHCLASSID');
        $result = $query->get('SCHCLASSID,SCHNAME,STARTTIME,ENDTIME');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'id' => $row['SCHCLASSID'],
                'name' => $row['SCHNAME'],
                'start_time' => $row['STARTTIME'],
                'end_time' => $row['ENDTIME']
            ];
        }
        $daily_schedule = array_chunk($result_array, 1000);
        foreach ($daily_schedule as $value) {
            DailySchedule::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[4] = $result[count($result) - 1]['SCHCLASSID'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
