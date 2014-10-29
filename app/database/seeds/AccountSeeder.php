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
            'password' => Hash::make('binabakti'),
            'employee_id' => 31,
            'role_id' => 1
        ));
    }

}
