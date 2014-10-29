<?php

class DepartmentSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('departments')->delete();

        $db = App::make('AccessDB');
        $query = new Query('DEPARTMENTS', $db->get_dbh());
        $result = $query->get('DEPTID,DEPTNAME,SUPDEPTID');
        foreach ($result as $row) {
            Department::create(array(
                'id' => $row['DEPTID'],
                'name' => $row['DEPTNAME'],
                'weekday_nominal' => 20000,
                'weekend_nominal' => 5000,
                'cut_nominal' => 5000,
                'super_department_id' => $row['SUPDEPTID']
            ));
        }
    }

}
