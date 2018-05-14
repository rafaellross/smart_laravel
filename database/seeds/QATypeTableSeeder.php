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
			["description" => "Fire Collars", "title" => "Fire Collars"],
			["description" => "Fire Hydrants", "title" => "Fire Hydrants"],
			["description" => "Gas Meter", "title" => "Gas Meter"],
			["description" => "Fire Hose Reels", "title" => "Fire Hose Reels"]
    	]);
        
    }
}