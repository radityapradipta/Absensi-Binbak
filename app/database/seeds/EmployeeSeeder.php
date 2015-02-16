<?php

class EmployeeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('employees')->delete();

        $db = App::make('AccessDB');
        $query = new Query('USERINFO', $db->get_dbh());
        $query->order('USERID');
        $result = $query->get('USERID,SSN,Name,Gender,BIRTHDAY,street,DEFAULTDEPTID');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'id' => $row['USERID'],
                'ssn' => $row['SSN'],
                'name' => $row['Name'],
                'is_male' => $row['Gender'] == 'Male' ? 1 : 0,
                'birthday' => $row['BIRTHDAY'],
                'street' => $row['street'],
                'department_id' => $row['DEFAULTDEPTID']
            ];
        }
        $employee = array_chunk($result_array, 1000);
        foreach ($employee as $value) {
            Employee::insert($value);
        }
        $convert_file = public_path() . '\Last Convert.txt';
        $record = explode(';', file_get_contents($convert_file));
        $record[7] = $result[count($result) - 1]['USERID'];
        $file = fopen($convert_file, 'w');
        fwrite($file, implode(';', $record));
        fclose($file);
    }

}
