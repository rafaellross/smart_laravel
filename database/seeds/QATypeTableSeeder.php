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
            ["description" => "Default", "title" => "Fit Out"],
            ["description" => "Default", "title" => "Cold Water"],            
			["description" => "Default", "title" => "Gas Meter"],
            ["description" => "Default", "title" => "Gas Rough In"],
            ["description" => "Default", "title" => "Hot Water Unit"],
			["description" => "Default", "title" => "Fire Hose Reels"],
            ["description" => "Default", "title" => "Gas Rough In"],
            ["description" => "Default", "title" => "Gas"],

            ["description" => "Default", "title" => "Hot Water Meter"],
            ["description" => "Default", "title" => "Hot Water Unit"],
            ["description" => "Default", "title" => "Hot Water"],

            ["description" => "Default", "title" => "Hydrant Inground"],
            ["description" => "Default", "title" => "Plant Rooms"],

            ["description" => "Default", "title" => "POD"],
            ["description" => "Default", "title" => "Pumps"],
            ["description" => "Default", "title" => "Sewer Drainage"],

            ["description" => "Default", "title" => "Sewer Rough In"],
            ["description" => "Default", "title" => "Stackwork"],
            ["description" => "Default", "title" => "Storm Water Drainage"],
            ["description" => "Default", "title" => "Sump Pit"],
            ["description" => "Default", "title" => "Trade Waste"],
            ["description" => "Default", "title" => "Water Meter"],
            ["description" => "Default", "title" => "Water Rough In"]
            
    	]);        
    }
}

