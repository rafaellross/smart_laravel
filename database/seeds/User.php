<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	"name" => "Rafael Ross",
        	"username" => "rafaellross",
        	"password" => bcrypt('123123'),
        	"administrator" => true
        ]);
    }
}
