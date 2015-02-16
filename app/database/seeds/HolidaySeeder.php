<?php

class HolidaySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('holidays')->delete();

        $db = App::make('AccessDB');
        $query = new Query('HOLIDAYS', $db->get_dbh());
        $query->where('DURATION', '>', 0);
        $result = $query->get('HOLIDAYID,STARTTIME,DURATION');
        $result_array = [];
        foreach ($result as $row) {
            $start_time = strtotime($row['STARTTIME']);
            $duration = $row['DURATION'] - 1;
            $end_time = strtotime("+$duration days", $start_time);
            $result_array[] = [
                'id' => $row['HOLIDAYID'],
                'start' => $row['STARTTIME'],
                'duration' => $row['DURATION'],
                'end' => date('Y-m-d H:i:s', $end_time)
            ];
        }
        $holiday = array_chunk($result_array, 1000);
        foreach ($holiday as $value) {
            Holiday::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[2] = $result[count($result) - 1]['HOLIDAYID'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
