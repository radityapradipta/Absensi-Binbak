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
        foreach ($result as $row) {
            Employee::create(array(
                'id' => $row['USERID'],
                'ssn' => $row['SSN'],
                'name' => $row['Name'],
                'is_male' => $row['Gender'] == 'Male' ? 1 : 0,
                'birthday' => $row['BIRTHDAY'],
                'street' => $row['street'],
                'department_id' => $row['DEFAULTDEPTID']
            ));
        }
    }

}
