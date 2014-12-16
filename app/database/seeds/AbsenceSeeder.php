<?php

class AbsenceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('absences')->delete();

        $db = App::make('AccessDB');
        $query = new Query('USER_SPEDAY', $db->get_dbh());
        $query->where('STARTSPECDAY', '>=', '2014-07-01');
        $query->order('DATE,STARTSPECDAY');
        $result = $query->get();
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'start_date' => $row['STARTSPECDAY'],
                'end_date' => $row['ENDSPECDAY'],
                'reason' => (isset($row['YUANYING']) ? $row['YUANYING'] : ''),
                'employee_id' => $row['USERID'],
                'absence_category_id' => $row['DATEID']
            ];
        }
        $absence = array_chunk($result_array, 1000);
        foreach ($absence as $value) {
            Absence::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[0] = $result[count($result) - 1]['DATE'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
