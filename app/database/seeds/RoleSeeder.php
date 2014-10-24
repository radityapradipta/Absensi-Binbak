<?php

class RoleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->delete();

        Role::create(array(
            'name' => 'Admin'
        ));

        Role::create(array(
            'name' => 'Yayasan'
        ));

        Role::create(array(
            'name' => 'SDM'
        ));

        Role::create(array(
            'name' => 'Keuangan'
        ));

        Role::create(array(
            'name' => 'Kepsek'
        ));

        Role::create(array(
            'name' => 'Tata Usaha'
        ));
    }

}
