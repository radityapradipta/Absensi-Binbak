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
            Holiday::create(array(
                'id' => $row['HOLIDAYID'],
                'start' => $row['STARTTIME'],
                'duration' => $row['DURATION']
            ));
        }
    }

}
