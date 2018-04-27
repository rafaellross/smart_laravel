<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(User::class);
        $this->call(JobTableSeeder::class);
        $this->call(WeekDaysTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(LicenseTableSeeder::class);
        $this->call(StatesTableSeeder::class);
    }
}
