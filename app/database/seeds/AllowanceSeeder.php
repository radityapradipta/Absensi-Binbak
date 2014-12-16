<?php

class AllowanceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('allowances')->delete();

        $allowance = [
            [
                'weekday_nominal' => 20000,
                'weekend_nominal' => 5000,
                'cut_nominal' => 5000,
                'information' => '>= 8 jam weekday'
            ],
            [
                'weekday_nominal' => 15000,
                'weekend_nominal' => 5000,
                'cut_nominal' => 5000,
                'information' => '>= 7 jam < 8 jam weekday'
            ],
            [
                'weekday_nominal' => 10000,
                'weekend_nominal' => 5000,
                'cut_nominal' => 5000,
                'information' => '< 7 jam weekday'
            ]
        ];

        Allowance::insert($allowance);
    }

}
