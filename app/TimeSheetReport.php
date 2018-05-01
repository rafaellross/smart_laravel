<?php 

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;
/**
* This class is used to convert time
*/
class TimeSheetReport extends Fpdf
{

	public function add(TimeSheet $timeSheet){
		//Font sizes
		$font_large = 12;
		$font_regular = 10;
		$font_sm = 5;

		//Table Dimensions
		$width_first = 20;
		$width_days = 35;
		$height = 10;        
		$this->SetTitle("Time Sheet");
	    $this->SetFont('Arial','',$font_large);

	    //Setup landscape
	    $this->AddPage('L');
	    //Write id on the pdf
	    $this->Text(280, 10,'#' . $timeSheet->id);

	    $this->Cell(17,10,'Name:');
	    $this->Cell(80,10, substr ($timeSheet->employee->name , 0, 30 ), 'B');
	    $this->Cell(15,10,'W/E:');
	    $this->Cell(30,10, Carbon::parse($timeSheet->created_at)->format('d/m/Y'), 'B');
	    $this->Ln();
	    $this->Ln();

	    $this->SetDrawColor(1, 1, 1);
	    $this->SetFillColor(192, 192, 192);
	    $this->SetFont('Arial','',$font_sm);
	    $this->Cell($width_first,5,'', 1);
	    $this->SetDrawColor(1, 1, 1);
	    $this->SetFillColor(192, 192, 192);
	    $this->SetFont('Arial','',$font_sm);
	    

	    foreach (WeekDay::all() as $weekDay) {
	    	if ($weekDay->number < 8) {
	    		$this->Cell($width_days,5, strtoupper($weekDay->description),1,0,'C');
	    	}	       
	    }

	    $this->Ln();

	    //Write left titles
	    for ($i=0; $i < 4; $i++) { 
		    $this->Cell($width_first, 2.5,'START &', 'LR', 2, 'C');
			$this->Cell($width_first, 2.5,'FINISH TIME', 'LRB', 2, 'C');
		    $this->Cell($width_first, 5,'JOB/HRS', 'LRB', 2, 'C');			
	    }

	    $this->Cell($width_first, 5,'TOTAL HRS', 'LRB', 2, 'C');			
		
		
	    $this->SetFont('Arial','',$font_regular);
	    $this->SetX(30);
	    $this->SetY($this->GetY()-(4*11.25), false);

	    foreach ($timeSheet->days()->get() as $day) {

	    	foreach ($day->dayJobs()->get() as $job) {
	    		//Write start and end hours	    		
	    		$this->Cell($width_days,5, Hour::convertToHour($job->start) . (is_null($job->job["code"]) ? "" : "-") . Hour::convertToHour($job->end), 1,2,'C', true);	    			    		
	    		//Write job code
	    		$this->Cell($width_days,5, $job->job["code"] .  (is_null($job->job["code"]) ? "" : "/") . Hour::convertToDecimal($job->hours()), 1,2,'C', false);	    		
	    	}	    	
	    	$this->SetX($this->GetX()+$width_days);
	    	$this->SetY($this->GetY()-(4*10), false);
	    }
    	
    	$this->SetY($this->GetY()-5, false);
	    //total hrs
	    $this->SetFont('Arial','',$font_sm);
	    $this->Cell(10,5,'',0,0,'C');
	    $this->Cell(25,5,'TOTAL HRS',1,2,'C');
	    $this->SetFont('Arial','',$font_regular);
	    for ($i=0; $i < 8; $i++) { 
	    	if ($i == 0) {
	    		$this->Cell(25,5, Hour::convertToDecimal($timeSheet->total),1,2,'C');
	    	} else {
	    		$this->Cell(25,5,'',1,2,'C');	
	    	}	    
	    }

	    $this->SetX(30);
	    $this->SetFillColor(255,154,0);
	    //Write totals per day
		foreach ($timeSheet->days()->get() as $day) {
			$this->Cell($width_days,5, Hour::convertToDecimal($day->total) == 0 ? "" : Hour::convertToDecimal($day->total), 1,0,'C', true);	
		}

		//Write total week
		$this->Cell(10,5,'',0,0,'C');
		$this->Cell(25,5,Hour::convertToDecimal($timeSheet->total),1,2,'C');
		$this->Ln();
	    $this->SetX(10);
        $this->Cell($width_first, 8,"By signing this form I take full responsibility for the hours stated above and confirm the information is correct and true.");
    	$this->Ln();
		$this->Text(11, 105,'Employee Signature   ');
		$this->Line(11, 106, 80, 106);
    	$this->Line(89, 106, 105, 106);
    	if (!is_null($timeSheet->emp_signature)) {
    		$this->Image($timeSheet->emp_signature, 40,97.7,40,0,'png');
    	}
		
		$this->Text(75, 105,'Date      '. Carbon::parse($timeSheet->created_at)->format('d/m/Y'));

	    $this->Text(11, 115,'Authorised By   '. '');	    
	   
	    $this->Text(75, 115,'Date      ');
	    $this->Line(11, 116, 80, 116);
	    $this->Line(89, 116, 105, 116);		

	    $this->Image('img/logo.jpg', 150, 95, 40);
	    $this->SetFont('Arial','B',15);
	    $this->Text(209, 100,'TIME SHEET');
	    $this->SetFont('Arial','',8);
	    $this->Text(208, 105,'Fax Number 02 8668 4892');
	    $this->SetFont('Arial','',8);
	    $this->Text(200, 110,'admin@smartplumbingsolutions.com.au');
	    $this->SetFont('Arial','B',8);
	    $this->Text(207, 115,'Call 1800 69 SMART (76278)');	    

		$this->SetFont('Arial','',4);
		$this->Text(10, 125,'OFFICE USE ONLY');
		$this->Line(10, 126, 275, 126);
		$this->Ln();
		$this->SetY(132);

		//Start office tables
	    $tb_left_width = 14;
    	$this->SetFont('Arial','',$font_sm+2);
	    $this->Cell($tb_left_width,5,'JOB',1,0,'C');
	    $this->Cell($tb_left_width,5,'HOURS',1,0,'C');
	    $getYtitle = $this->GetY();
	    $this->Ln();

	    //Write left table
	    $listHours = $timeSheet->listHours();
	    arsort($listHours);


	    //Sum tafe, sick and public holiday to the main job
	    if (isset($listHours["tafe"])) {
	    	$listHours[key($listHours)] += $listHours["tafe"];
	    	unset($listHours["tafe"]);
	    }

	    if (isset($listHours["sick"])) {
	    	$listHours[key($listHours)] += $listHours["sick"];
	    	unset($listHours["sick"]);
	    }

	    if (isset($listHours["holiday"])) {
	    	$listHours[key($listHours)] += $listHours["holiday"];
	    	unset($listHours["holiday"]);
	    }

	    if ($timeSheet->pldTaken()->integer > 0) {
	    	if (isset($listHours["001"])) {
	    		$listHours["001"] += $timeSheet->pldTaken()->integer;
	    	} else {
	    		$listHours["001"] = $timeSheet->pldTaken()->integer;
	    	}
	    }

	    if (isset($listHours["rdo"])) {
	    	unset($listHours["rdo"]);
	    }

	    if ($timeSheet->rdoTaken()->integer > 0) {
	    	if (isset($listHours["001"])) {
	    		$listHours["001"] += $timeSheet->rdoTaken()->integer;
	    	} else {
	    		$listHours["001"] = $timeSheet->rdoTaken()->integer;
	    	}
	    }

	    if ($timeSheet->anlTaken()->integer > 0) {
	    	if (isset($listHours["001"])) {
	    		$listHours["001"] += $timeSheet->anlTaken()->integer;
	    	} else {
	    		$listHours["001"] = $timeSheet->anlTaken()->integer;
	    	}
	    }

	    foreach ($listHours as $job => $hours) {
		    $this->Cell($tb_left_width,5, $job,1,0,'C');
		    $this->Cell($tb_left_width,5, Hour::convertToDecimal($hours),1,0,'C');	    	
		    $this->Ln();
	    }

	    $this->SetY($getYtitle, false);
	    $this->SetX($this->GetX()+45);
	    
	    $tb_center_width = 17;

	    $this->Cell($tb_center_width,5, '',1,0,'C');
	    foreach (WeekDay::all() as $weekDay) {
	    	if ($weekDay->number < 8) {
	    		$this->Cell($tb_center_width,5, strtoupper($weekDay->short),1,0,'C');
	    	}	       
	    }
	    $this->Ln();	    

		$this->SetX($this->GetX()+45);
		$this->Cell($tb_center_width,5, 'TOTAL HRS',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$this->Cell($tb_center_width,5, Hour::convertToDecimal($day->total) == 0 ? null : Hour::convertToDecimal($day->total),1,0,'C');			
		}
		$this->Ln();	    

		$this->SetX($this->GetX()+45);
		$this->Cell($tb_center_width,5, 'NOR',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$this->Cell($tb_center_width,5, Hour::convertToDecimal($day->normal) == 0 ? null : Hour::convertToDecimal($day->normal),1,0,'C');			
		}
		$this->Ln();	    

		$this->SetX($this->GetX()+45);
		$this->Cell($tb_center_width,5, '1.5',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$this->Cell($tb_center_width,5, Hour::convertToDecimal($day->total_15) == 0 ? null : Hour::convertToDecimal($day->total_15),1,0,'C');			
		}
		$this->Ln();	    

		$this->SetX($this->GetX()+45);
		$this->Cell($tb_center_width,5, '2.0',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$this->Cell($tb_center_width,5, Hour::convertToDecimal($day->total_20) == 0 ? null : Hour::convertToDecimal($day->total_20),1,0,'C');			
		}
		$this->Ln();	    

		$special_request_width = 20;
		$this->Ln();	    
		
		$this->SetX($this->GetX()+45);

		$this->Cell($special_request_width * 2,5, 'Special Requests',1,2,'C', true);
		$this->Cell($special_request_width,5, 'PLD',1,2,'C');
		$this->Cell($special_request_width,5, 'RDO',1,2,'C');
		$this->Cell($special_request_width,5, 'Annual Leave',1,0,'C');

		$this->SetY($this->GetY()-(10), false);
		$this->Cell($special_request_width,5, $timeSheet->pld <= 0 ? null : $timeSheet->pld/60,1,2,'C');
		
		
		$this->Cell($special_request_width,5, $timeSheet->rdo <= 0 ? null : $timeSheet->rdo/60,1,2,'C');
		
		$this->Cell($special_request_width,5, $timeSheet->anl <= 0 ? null : $timeSheet->anl/60,1,2,'C');

		$tb_right_width = 60;
		$this->SetX($this->GetX()+128);
		$this->SetY($this->GetY()-(50), false);
		$this->Cell($tb_right_width,5,'TOTAL NORMAL PAY LESS 4HR RDO',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL TIME AND HALF (1.5)',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL DOUBLE TIME (2T)',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL PLD',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL RDO HRS TAKEN	',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL SICK TAKEN',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL HOLIDAY TAKEN',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL TRAVEL DAYS',1,2,'R');
		$this->Cell($tb_right_width,5,'TOTAL SITE ALLOW.',1,2,'R');
		$this->Cell($tb_right_width,5,'',0,2,'R');
		if ($timeSheet->employee->bonus > 0) {
			$this->Cell($tb_right_width,5,'BONUS',1,0,'R');
		} else {
			$this->Cell($tb_right_width,5,'',0,0,'R');
		}
		$this->SetY($this->GetY()-(50), false);
		$this->Cell(10,5, $timeSheet->normalLessRdo(),1,2,'C', true);
		$this->Cell(10,5, Hour::convertToDecimal($timeSheet->total_15) == 0 ? null : Hour::convertToDecimal($timeSheet->total_15),1,2,'C', true);
		$this->Cell(10,5, Hour::convertToDecimal($timeSheet->total_20) == 0 ? null : Hour::convertToDecimal($timeSheet->total_20),1,2,'C', true);
		$this->Cell(10,5, $timeSheet->pldTaken()->decimal == 0 ? null : $timeSheet->pldTaken()->decimal,1,2,'C', true);
		$this->Cell(10,5, $timeSheet->rdoTaken()->decimal == 0 ? null : $timeSheet->rdoTaken()->decimal,1,2,'C', true);

		$this->Cell(10,5, $timeSheet->sickTaken() == 0 ? null : $timeSheet->sickTaken() ,1,2,'C', true);
		$this->Cell(10,5, $timeSheet->anlTaken()->decimal == 0 ? null : $timeSheet->anlTaken()->decimal,1,2,'C', true);
		$this->Cell(10,5, $timeSheet->travelDays(),1,2,'C', true);
		$this->Cell(10,5, $timeSheet->siteAllow() == 0 ? null : $timeSheet->siteAllow()/60,1,2,'C', true);
		$this->Cell(10,5, "",0,2,'C', false);
		if ($timeSheet->employee->bonus > 0) {
			$this->Cell(10,5, $timeSheet->employee->bonus == 0 ? null : $timeSheet->employee->bonus,1,2,'C', true);
		}

		$this->SetFont('Arial','B',$font_large);	 
		$certificates = TimeSheetCertificate::where('time_sheet_id', $timeSheet->id)->get();
		Debugbar::info(TimeSheetCertificate::where('time_sheet_id', $timeSheet->id)->get()->count());
		if ($certificates->count() > 0) {
			foreach ($certificates as $certificate) {				
					list($width, $height, $type, $attr) = getimagesize($certificate->certificate_img);
					if ($width > $height) {
						$this->AddPage('L');
					} else {
						$this->AddPage('P');
					}
					$this->Cell($this->GetPageWidth(),5,"Medical Certificate for Time Sheet #".$timeSheet->id . " - (" . $timeSheet->employee->name . ")",0,0,'C');
					$this->Image($certificate->certificate_img, 15,25, min($this->GetPageWidth()-70, $width-70),0, str_replace("image/", "", image_type_to_mime_type($type)));							
			}		
		}

		
		
		return $this;		       
	}

}