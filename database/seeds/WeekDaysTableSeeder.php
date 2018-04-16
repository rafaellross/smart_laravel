<?php

use Illuminate\Database\Seeder;

class WeekDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('week_days')->insert([
            [
                'number' => 2,
                'description' => 'Monday',
                'short' => 'mon', 
                'days_to_end' => 6,                               
            ],
            [
                'number' => 3,
                'description' => 'Tuesday',
                'short' => 'tue', 
                'days_to_end' => 5,                               
            ],
            [
                'number' => 4,
                'description' => 'Wednesday',
                'short' => 'wed', 
                'days_to_end' => 4,                               
            ],
            [
                'number' => 5,
                'description' => 'Thursday',
                'short' => 'thu', 
                'days_to_end' => 3,                               
            ],
            [
                'number' => 6,
                'description' => 'Friday',
                'short' => 'fri', 
                'days_to_end' => 2,                               
            ],
            [
                'number' => 7,
                'description' => 'Saturday',
                'short' => 'sat',                
                'days_to_end' => 1,                
            ],
            [
                'number' => 8,
                'description' => 'Sunday',
                'short' => 'sun',                
                'days_to_end' => 0,                
            ],            
        ]);        
    }
}
