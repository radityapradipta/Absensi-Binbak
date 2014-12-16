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
    }

}
