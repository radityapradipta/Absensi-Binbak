<?php

class ManualCheckSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('manual_checks')->delete();

        $db = App::make('AccessDB');
        $query = new Query('CHECKEXACT', $db->get_dbh());
        $query->where('EXACTID', '>=', 1455);
        $query->order('EXACTID');
        $result = $query->get('EXACTID,USERID,CHECKTIME,CHECKTYPE');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ];
        }
        $manual_check = array_chunk($result_array, 1000);
        foreach ($manual_check as $value) {
            ManualCheck::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[0] = $result[count($result) - 1]['EXACTID'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
