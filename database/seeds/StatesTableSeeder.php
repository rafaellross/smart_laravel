<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('states')->insert([
	        ["code" => "ACT", "description" => "Australia Capital Territory"],			
			["code" => "NSW", "description" => "New South Wales"],
			["code" => "NT", "description" => "Northern Territory"],
			["code" => "QLD", "description" => "Queensland"],
			["code" => "SA", "description" => "South Australia"],
			["code" => "TAS", "description" => "Tasmania"],
			["code" => "WA", "description" => "Western Australia"],
			["code" => "VIC", "description" => "Victoria"]    		
    	]);
    }
}
