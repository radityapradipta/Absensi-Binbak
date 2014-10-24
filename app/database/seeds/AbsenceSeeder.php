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
        $query->order('DATE');
        $result = $query->get();
        foreach ($result as $row) {
            Absence::create(array(
                'start_date' => $row['STARTSPECDAY'],
                'end_date' => $row['ENDSPECDAY'],
                'reason' => (isset($row['YUANYING']) ? $row['YUANYING'] : ''),
                'employee_id' => $row['USERID'],
                'absence_category_id' => $row['DATEID']
            ));
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[0] = $result[count($result) - 1]['DATE'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
