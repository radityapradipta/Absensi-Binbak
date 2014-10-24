<?php

class AutoCheckSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('auto_checks')->delete();

        $db = App::make('AccessDB');
        $query = new Query('CHECKINOUT', $db->get_dbh());
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $query->where('CHECKTIME', '>', $record[2]);
        $query->limit(10000);
        $query->order('CHECKTIME');
        $result = $query->get('USERID,CHECKTIME,CHECKTYPE');
        foreach ($result as $row) {
            AutoCheck::create(array(
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ));
        }
        $record[2] = $result[count($result) - 1]['CHECKTIME'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
