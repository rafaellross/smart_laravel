<?php

use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([

            ["code" => 'rdo' , "description" =>'RDO'], 
            ["code" => 'pld' , "description" =>'PLD'], 
            ["code" => 'anl' , "description" =>'Annual Leave'], 
            ["code" => 'sick' , "description" =>'Sick Leave'], 
            ["code" => 'tafe' , "description" =>'TAFE'],         
            ["code" => 'holiday' , "description" =>'Public Holiday'],                 
            ["code" => '001' , "description" =>'001 - Office'], 
            ["code" => '002' , "description" =>'002 - Belfield'],         
            ["code" => '099' , "description" =>'099 - Office'],         
            ["code" => '270' , "description" =>'270 - 253-255 Oxford St - Bondi'],          
            ["code" => '314' , "description" =>'314 - Warriewood'],       
            ["code" => '381' , "description" =>'381 - Warriewood - Stage 2'],                 
            ["code" => '372' , "description" =>'372 - Harbord Diggers'], 
            ["code" => '401' , "description" =>'401 - Airport'], 
            ["code" => '417' , "description" =>'417 - Clovelly Rd Clovelly'], 
            ["code" => '427' , "description" =>'427 - Elger St Glebe'], 
            ["code" => '429' , "description" =>'429 - 105 Phillip St Parramatta'], 
            ["code" => '445' , "description" =>'445 - Anzac Memorial'],               
            ["code" => '446' , "description" =>'446 - Woollahra Retirement (ARU)'], 
            ["code" => '458' , "description" =>'458 - Peppers Pokolbin/Spices'], 
            ["code" => '463' , "description" =>'463 - UBS Chifley'], 
            ["code" => '476' , "description" =>'476 - 117 Kurraba Rd Neutral Bay'], 
            ["code" => '481' , "description" =>'481 - 76 Edinburgh Rd Marrickville'], 
            ["code" => '500' , "description" =>'500 - Telstra Manly Belgrave St'], 
            ["code" => '506' , "description" =>'506 - 175 Pitt St'],      
            ["code" => '507' , "description" =>'507 - Dean Revesby'], 
            ["code" => '511' , "description" =>'511 - 12 Philip St Parra (Church St)'], 
            ["code" => '514' , "description" =>'514 - Carr St Coogee'], 
            ["code" => '517' , "description" =>'517 - Kogarah RSL'], 
            ["code" => '518' , "description" =>'518 - Syd Olympic Park],  Homebush'], 
            ["code" => '520' , "description" =>'520 - The Crescent Vaucluse'],      
            ["code" => '525' , "description" =>'525 - Page St Banksmeadow'], 
            ["code" => '528' , "description" =>'528 - AMP 7 Macquarie Place'],        
            ["code" => '535' , "description" =>'535 - Randwick'],         
            ["code" => '538' , "description" =>'538 - 80 Pitt Street'], 
            ["code" => '540' , "description" =>'540 - ASQ Aust Square'], 
            ["code" => '544' , "description" =>'544 - Ben Pritchard Bronte'], 
            ["code" => '545' , "description" =>'545 - Barker College'], 
            ["code" => '547' , "description" =>'547 - 10 Vernon St Lewisham'], 
            ["code" => '548' , "description" =>'548 - 201 Kent Street'], 
            ["code" => '549' , "description" =>'549 - Olphest St Vaucluse'], 
            ["code" => '550' , "description" =>'550 - Marcos Gym'], 
            ["code" => '551' , "description" =>'551 - Mirvac - Marrickville'], 
            ["code" => '554' , "description" =>'554 - Point Piper'],                
            ["code" => '555' , "description" =>'555 - TBS Hurstville Stage 2'],       

        ]);
    }
}


    