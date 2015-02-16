<?php

class AutoCheckSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('auto_checks')->delete();

        set_time_limit(0);
        $db = App::make('AccessDB');
        $query = new Query('CHECKINOUT', $db->get_dbh());
        $query->where('CHECKTIME', '>=', '2014-07-01');
        $query->where('CHECKTIME', '<', '2015-02-01');
        $query->order('CHECKTIME');
        $result = $query->get('USERID,CHECKTIME,CHECKTYPE');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ];
        }
        $auto_check = array_chunk($result_array, 1000);
        foreach ($auto_check as $value) {
            AutoCheck::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[1] = '2015-02-01';
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
