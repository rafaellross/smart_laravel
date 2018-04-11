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
            ],
            [
                'number' => 3,
                'description' => 'Tuesday',
                'short' => 'tue',                
            ],
            [
                'number' => 4,
                'description' => 'Wednesday',
                'short' => 'wed',                
            ],
            [
                'number' => 5,
                'description' => 'Thursday',
                'short' => 'thu',                
            ],
            [
                'number' => 6,
                'description' => 'Friday',
                'short' => 'fri',                
            ],
            [
                'number' => 7,
                'description' => 'Saturday',
                'short' => 'sat',                
            ],
            [
                'number' => 8,
                'description' => 'Sunday',
                'short' => 'sun',                
            ],            
        ]);        
    }
}
