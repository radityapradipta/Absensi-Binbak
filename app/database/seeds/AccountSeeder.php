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
            'username' => 'rosenta',
            'password' => Hash::make('binabakti'),
            'employee_id' => 1,
            'role_id' => 1
        ));

        Account::create(array(
            'username' => 'benjamin',
            'password' => Hash::make('binabakti'),
            'employee_id' => 2,
            'role_id' => 2
        ));
    }

}
