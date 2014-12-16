<?php

class RoleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->delete();

        $role = [
            ['name' => 'Admin'],
            ['name' => 'Yayasan'],
            ['name' => 'SDM'],
            ['name' => 'Keuangan'],
            ['name' => 'Kepsek'],
            ['name' => 'Tata Usaha']
        ];

        Role::insert($role);
    }

}
