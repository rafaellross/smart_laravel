<?php

use Illuminate\Database\Seeder;

class QAActitiviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qa_types = App\QATypes::all();
        foreach ($qa_types as $qa_type) {
	    	DB::table('q_a_activities')->insert([
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 1, 
					"description" 	=> "Obtain latest revision approved working drawing",
					"at"			=> "V",
					"requirements"	=> "Management Issue"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 2, 
					"description" 	=> "Material Type",
					"at"			=> "V",
					"requirements"	=> "Verification of Specification"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 3, 
					"description" 	=> "Class",
					"at"			=> "V",
					"requirements"	=> "Verification of Specification"
				],

				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 4, 
					"description" 	=> "Joint Type",
					"at"			=> "V",
					"requirements"	=> "Verification of Specification"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 5, 
					"description" 	=> "Pipe Size",
					"at"			=> "V",
					"requirements"	=> "Plans / Shop Drawings"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 6, 
					"description" 	=> "Outlet Points correctly located & capped off",
					"at"			=> "V",
					"requirements"	=> "Plans / Shop Drawings"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 7, 
					"description" 	=> "Test Results Pass / Fail",
					"at"			=> "N",
					"requirements"	=> "Verification of Specification"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 8, 
					"description" 	=> "Tagging",
					"at"			=> "N",
					"requirements"	=> "Verification of Specification"
				],
				[
					"qa_type" 		=> $qa_type->id, 
					"order" 		=> 9, 
					"description" 	=> "All work is completed",
					"at"			=> "V",
					"requirements"	=> ""
				]

	    	]);
        	
        }
    }
}
