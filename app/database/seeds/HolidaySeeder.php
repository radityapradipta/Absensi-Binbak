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
        foreach ($result as $row) {
            $start_time = strtotime($row['STARTTIME']);
            $duration = $row['DURATION'] - 1;
            $end_time = strtotime("+$duration days", $start_time);
            Holiday::create(array(
                'id' => $row['HOLIDAYID'],
                'start' => $row['STARTTIME'],
                'duration' => $row['DURATION'],
                'end' => date('Y-m-d H:i:s', $end_time)
            ));
        }
    }

}
