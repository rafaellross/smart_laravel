<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class TimeSheet extends Model
{
    public function days(){
        return $this->hasMany('App\Day');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
    
	public static function pdf(TimeSheet $timeSheet){
		//Font sizes
		$font_large = 12;
		$font_regular = 10;
		$font_sm = 5;

		//Table Dimensions
		$width_first = 20;
		$width_days = 35;
		$height = 10;
        $pdf = new Fpdf();

	    $pdf->SetFont('Arial','',$font_large);

	    //Setup landscape
	    $pdf->AddPage('L');
	    //Write id on the pdf
	    $pdf->Text(280, 10,'#' . $timeSheet->id);

	    $pdf->Cell(17,10,'Name:');
	    $pdf->Cell(80,10, substr ($timeSheet->employee->name , 0, 30 ), 'B');
	    $pdf->Cell(15,10,'W/E:');
	    $pdf->Cell(30,10, Carbon::parse($timeSheet->created_at)->format('d/m/Y'), 'B');
	    $pdf->Ln();
	    $pdf->Ln();

	    $pdf->SetDrawColor(1, 1, 1);
	    $pdf->SetFillColor(192, 192, 192);
	    $pdf->SetFont('Arial','',$font_sm);
	    $pdf->Cell($width_first,5,'', 1);
	    $pdf->SetDrawColor(1, 1, 1);
	    $pdf->SetFillColor(192, 192, 192);
	    $pdf->SetFont('Arial','',$font_sm);
	    

	    foreach (WeekDay::all() as $weekDay) {
	    	if ($weekDay->number < 8) {
	    		$pdf->Cell($width_days,5, strtoupper($weekDay->description),1,0,'C');
	    	}	       
	    }

	    $pdf->Ln();

	    //Write left titles
	    for ($i=0; $i < 4; $i++) { 
		    $pdf->Cell($width_first, 2.5,'START &', 'LR', 2, 'C');
			$pdf->Cell($width_first, 2.5,'FINISH TIME', 'LRB', 2, 'C');
		    $pdf->Cell($width_first, 5,'JOB/HRS', 'LRB', 2, 'C');			
	    }

	    $pdf->Cell($width_first, 5,'TOTAL HRS', 'LRB', 2, 'C');			
		
		
	    $pdf->SetFont('Arial','',$font_regular);
	    $pdf->SetX(30);
	    $pdf->SetY($pdf->GetY()-(4*11.25), false);

	    foreach ($timeSheet->days()->get() as $day) {

	    	foreach ($day->dayJobs()->get() as $job) {
	    		//Write start and end hours	    		
	    		$pdf->Cell($width_days,5, $job->start . " - " . $job->end, 1,2,'C', true);	    			    		
	    		//Write job code
	    		$pdf->Cell($width_days,5, $job->job_id, 1,2,'C', false);	    		
	    	}	    	
	    	$pdf->SetX($pdf->GetX()+$width_days);
	    	$pdf->SetY($pdf->GetY()-(4*10), false);
	    }
    	
    	$pdf->SetY($pdf->GetY()-5, false);
	    //total hrs
	    $pdf->SetFont('Arial','',$font_sm);
	    $pdf->Cell(10,5,'',0,0,'C');
	    $pdf->Cell(25,5,'TOTAL HRS',1,2,'C');
	    $pdf->SetFont('Arial','',$font_regular);
	    for ($i=0; $i < 9; $i++) { 
	    	if ($i == 0 || $i == 8) {
	    		$pdf->Cell(25,5,$timeSheet->total,1,2,'C');
	    	} else {
	    		$pdf->Cell(25,5,'',1,2,'C');	
	    	}
	    	
	    }

        return $pdf;
	}


}
