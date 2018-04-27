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
	        ["description" => "Australia Capital Territory"],			
			["description" => "New South Wales"],
			["description" => "Northern Territory"],
			["description" => "Queensland"],
			["description" => "South Australia"],
			["description" => "Tasmania"],
			["description" => "Western Australia"],
			["description" => "Victoria"]    		
    	]);
    }
}
