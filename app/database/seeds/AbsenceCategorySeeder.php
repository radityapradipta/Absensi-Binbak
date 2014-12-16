<?php

class AbsenceCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('absence_categories')->delete();

        $absenceCategory = [
            [
                'id' => 2,
                'name' => 'vacation'
            ],
            [
                'id' => 3,
                'name' => 'other'
            ],
            [
                'id' => 4,
                'name' => 'tugas luar'
            ],
            [
                'id' => 5,
                'name' => 'izin'
            ],
            [
                'id' => 6,
                'name' => 'cuti'
            ],
            [
                'id' => 7,
                'name' => 'sakit'
            ],
            [
                'id' => 8,
                'name' => 'lupa'
            ]
        ];

        AbsenceCategory::insert($absenceCategory);
    }

}
