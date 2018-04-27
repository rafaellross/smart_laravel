<?php

use Illuminate\Database\Seeder;

class LicenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('licenses')->insert([
		["description" => "CIC Construction Induction Card"],
		["description" => "PB Concrete Placing Boom"],
		["description" => "A Class Electrician"],
		["description" => "Construction Wiring"],
		["description" => "AGE A-Grade Electrical Licence"],
		["description" => "C1 Mobile Crane, Slewing to 100 tonne"],
		["description" => "C2 Mobile Crane, Slewing to 20 tonne"],
		["description" => "C6 Mobile Crane, Slewing to 60 tonne"],
		["description" => "CN Non-Slewing Mobile Crane (Over 3 Tonne)"],
		["description" => "CO Mobile Crane, Open"],
		["description" => "CPCCDE3014A Remove Non-Friable Asbestos"],
		["description" => "CS Self-Erecting Tower Crane"],
		["description" => "CT Tower Crane"],
		["description" => "CV Vehicle Loading Crane"],
		["description" => "DG Dogging"],
		["description" => "DLPI Driver's Licence/Photo I.D"],
		["description" => "HM Hoist, Materials"],
		["description" => "HP Hoist, Personnel and Materials"],
		["description" => "LE Excavator"],
		["description" => "LF Forklift Truck"],
		["description" => "LG Grader"],
		["description" => "RA Advanced Rigging"],
		["description" => "RB Basic Rigging"],
		["description" => "RI Intermediate Rigging"],
		["description" => "SA Advanced Scaffolding"],
		["description" => "SB Basic Scaffolding"],
		["description" => "SI Intermediate Scaffolding"],
		["description" => "WP Boom-type Elevating Work Platform"],
		["description" => "WP Elevating Work Platform (Over 11m)"],
		["description" => "Bullying and Harassment Officer"],
		["description" => "Cert IV WHS"],
		["description" => "Dip WHS"],
		["description" => "Environmental Awareness &amp; Spill Kit Training"],
		["description" => "Fire Attach Fire Fighting Training"],
		["description" => "Fire Warden Training"],
		["description" => "Health and Safety Committee Training"],
		["description" => "HSR Training"],
		["description" => "Manual Handling Training"],
		["description" => "Plumbing Registration"],
		["description" => "Rescue Training - Crane Rescue"],
		["description" => "Rescue Training - Jumpform Rescue"],
		["description" => "Return to Work Co-ordinator Training"],
		["description" => "Risk Management Supervisor Training"],
		["description" => "Confined Spaces"],
		["description" => "Delegate Training"],
		["description" => "Electrical Spotter"],
		["description" => "EWP Boom Lift (Under 11mtrs)"],
		["description" => "EWP Scissor Lift"],
		["description" => "EWP Vertical Lift"],
		["description" => "First Aid Advanced (Level 3)"],
		["description" => "First Aid Intermediate (Level 2)"],
		["description" => "General VOC"],
		["description" => "GOTCHA Rescue"],
		["description" => "Impairment Assessor Training"],
		["description" => "Impairment Training"],
		["description" => "LV1 ASP Authorisation Card (Ausgrid work)"],
		["description" => "Prepare Workzone Traffic Management Plan"],
		["description" => "Traffic Implement"],
		["description" => "Traffic Stop Go"],
		["description" => "Working at Heights (Harness)"],
		["description" => "HLTAID001 First Aid CPR "],
		["description" => "LP Line Pump"],
		["description" => "LS Skid Steer Loader"],
		["description" => "TMH Telescopic Materials Handler"],
		["description" => "Delegates Training "]       	
       ]);
    }
}
