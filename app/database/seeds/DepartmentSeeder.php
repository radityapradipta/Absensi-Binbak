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
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'id' => $row['DEPTID'],
                'name' => $row['DEPTNAME'],
                'super_department_id' => $row['SUPDEPTID']
            ];
        }
        $department = array_chunk($result_array, 1000);
        foreach ($department as $value) {
            Department::insert($value);
        }
    }

}
