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
                'super_department_id' => $row['SUPDEPTID'],
                'allowance_id' => 1
            ));
        }
    }

}
