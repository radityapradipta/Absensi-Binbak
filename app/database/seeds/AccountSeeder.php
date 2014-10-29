<?php

class AccountSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('accounts')->delete();

        Account::create(array(
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'employee_id' => 1,
            'role_id' => 1
        ));

    }

}
