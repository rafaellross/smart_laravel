<?php

use Illuminate\Database\Seeder;

class QATypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('q_a_types')->insert([
			["description" => "Default", "title" => "Fire Collars"],
			["description" => "Default", "title" => "Fire Hydrants"],
			["description" => "Default", "title" => "Gas Meter"],
            ["description" => "Default", "title" => "Gas Rough In"],
            ["description" => "Default", "title" => "Hot Water Unit"],
			["description" => "Default", "title" => "Fire Hose Reels"]
    	]);        
    }
}
