<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        $this->call('AbsenceCategorySeeder');
        $this->command->info('AbsenceCategory seeds finished.');
        $this->call('AccountSeeder');
        $this->command->info('Account seeds finished.');
        $this->call('AllowanceSeeder');
        $this->command->info('Allowance seeds finished.');
        $this->call('RoleSeeder');
        $this->command->info('Role seeds finished.');

        $this->call('DailyScheduleSeeder');
        $this->command->info('DailySchedule seeds finished.');
        $this->call('DepartmentSeeder');
        $this->command->info('Department seeds finished.');
        $this->call('EmployeeSeeder');
        $this->command->info('Employee seeds finished.');
        $this->call('HolidaySeeder');
        $this->command->info('Holiday seeds finished.');
        $this->call('ScheduleSeeder');
        $this->command->info('Schedule seeds finished.');
        $this->call('WeeklyScheduleSeeder');
        $this->command->info('WeeklySchedule seeds finished.');
        $this->call('AbsenceSeeder');
        $this->command->info('Absence seeds finished.');
        $this->call('ManualCheckSeeder');
        $this->command->info('ManualCheck seeds finished.');
        $this->call('AutoCheckSeeder');
        $this->command->info('AutoCheck seeds finished.');
    }

}
