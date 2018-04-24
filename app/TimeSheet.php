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
		$pdf->SetTitle("Time Sheet");
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
	    		$pdf->Cell($width_days,5, Hour::convertToHour($job->start) . (is_null($job->job["code"]) ? "" : "-") . Hour::convertToHour($job->end), 1,2,'C', true);	    			    		
	    		//Write job code
	    		$pdf->Cell($width_days,5, $job->job["code"] .  (is_null($job->job["code"]) ? "" : "/") . Hour::convertToDecimal($job->hours()), 1,2,'C', false);	    		
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
	    for ($i=0; $i < 8; $i++) { 
	    	if ($i == 0) {
	    		$pdf->Cell(25,5, Hour::convertToDecimal($timeSheet->total),1,2,'C');
	    	} else {
	    		$pdf->Cell(25,5,'',1,2,'C');	
	    	}	    
	    }

	    $pdf->SetX(30);
	    $pdf->SetFillColor(255,154,0);
	    //Write totals per day
		foreach ($timeSheet->days()->get() as $day) {
			$pdf->Cell($width_days,5, Hour::convertToDecimal($day->total) == 0 ? "" : Hour::convertToDecimal($day->total), 1,0,'C', true);	
		}

		//Write total week
		$pdf->Cell(10,5,'',0,0,'C');
		$pdf->Cell(25,5,Hour::convertToDecimal($timeSheet->total),1,2,'C');
		$pdf->Ln();
	    $pdf->SetX(10);
        $pdf->Cell($width_first, 8,"By signing this form I take full responsibility for the hours stated above and confirm the information is correct and true.");
    	$pdf->Ln();
		$pdf->Text(11, 105,'Employee Signature   ');
		$pdf->Line(11, 106, 80, 106);
    	$pdf->Line(89, 106, 105, 106);
		$pdf->Image($timeSheet->emp_signature, 40,97.7,40,0,'png');
		$pdf->Text(75, 105,'Date      '. Carbon::parse($timeSheet->created_at)->format('d/m/Y'));

	    $pdf->Text(11, 115,'Authorised By   '. '');	    
	   
	    $pdf->Text(75, 115,'Date      ');
	    $pdf->Line(11, 116, 80, 116);
	    $pdf->Line(89, 116, 105, 116);		

	    $pdf->Image('img/logo.jpg', 150, 95, 40);
	    $pdf->SetFont('Arial','B',15);
	    $pdf->Text(209, 100,'TIME SHEET');
	    $pdf->SetFont('Arial','',8);
	    $pdf->Text(208, 105,'Fax Number 02 8668 4892');
	    $pdf->SetFont('Arial','',8);
	    $pdf->Text(200, 110,'admin@smartplumbingsolutions.com.au');
	    $pdf->SetFont('Arial','B',8);
	    $pdf->Text(207, 115,'Call 1800 69 SMART (76278)');	    

		$pdf->SetFont('Arial','',4);
		$pdf->Text(10, 125,'OFFICE USE ONLY');
		$pdf->Line(10, 126, 275, 126);
		$pdf->Ln();
		$pdf->SetY(132);

		//Start office tables
	    $tb_left_width = 14;
    	$pdf->SetFont('Arial','',$font_sm+2);
	    $pdf->Cell($tb_left_width,5,'JOB',1,0,'C');
	    $pdf->Cell($tb_left_width,5,'HOURS',1,0,'C');
	    $getYtitle = $pdf->GetY();
	    $pdf->Ln();

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
		    $pdf->Cell($tb_left_width,5, $job,1,0,'C');
		    $pdf->Cell($tb_left_width,5, Hour::convertToDecimal($hours),1,0,'C');	    	
		    $pdf->Ln();
	    }

	    $pdf->SetY($getYtitle, false);
	    $pdf->SetX($pdf->GetX()+45);
	    
	    $tb_center_width = 17;

	    $pdf->Cell($tb_center_width,5, '',1,0,'C');
	    foreach (WeekDay::all() as $weekDay) {
	    	if ($weekDay->number < 8) {
	    		$pdf->Cell($tb_center_width,5, strtoupper($weekDay->short),1,0,'C');
	    	}	       
	    }
	    $pdf->Ln();	    

		$pdf->SetX($pdf->GetX()+45);
		$pdf->Cell($tb_center_width,5, 'TOTAL HRS',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$pdf->Cell($tb_center_width,5, Hour::convertToDecimal($day->total) == 0 ? null : Hour::convertToDecimal($day->total),1,0,'C');			
		}
		$pdf->Ln();	    

		$pdf->SetX($pdf->GetX()+45);
		$pdf->Cell($tb_center_width,5, 'NOR',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$pdf->Cell($tb_center_width,5, Hour::convertToDecimal($day->normal) == 0 ? null : Hour::convertToDecimal($day->normal),1,0,'C');			
		}
		$pdf->Ln();	    

		$pdf->SetX($pdf->GetX()+45);
		$pdf->Cell($tb_center_width,5, '1.5',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$pdf->Cell($tb_center_width,5, Hour::convertToDecimal($day->total_15) == 0 ? null : Hour::convertToDecimal($day->total_15),1,0,'C');			
		}
		$pdf->Ln();	    

		$pdf->SetX($pdf->GetX()+45);
		$pdf->Cell($tb_center_width,5, '2.0',1,0,'C');
		foreach ($timeSheet->days()->get() as $day) {
    		$pdf->Cell($tb_center_width,5, Hour::convertToDecimal($day->total_20) == 0 ? null : Hour::convertToDecimal($day->total_20),1,0,'C');			
		}
		$pdf->Ln();	    

		$special_request_width = 20;
		$pdf->Ln();	    
		
		$pdf->SetX($pdf->GetX()+45);

		$pdf->Cell($special_request_width * 2,5, 'Special Requests',1,2,'C', true);
		$pdf->Cell($special_request_width,5, 'PLD',1,2,'C');
		$pdf->Cell($special_request_width,5, 'RDO',1,2,'C');
		$pdf->Cell($special_request_width,5, 'Annual Leave',1,0,'C');

		$pdf->SetY($pdf->GetY()-(10), false);
		$pdf->Cell($special_request_width,5, $timeSheet->pld <= 0 ? null : $timeSheet->pld/60,1,2,'C');
		
		
		$pdf->Cell($special_request_width,5, $timeSheet->rdo <= 0 ? null : $timeSheet->rdo/60,1,2,'C');
		
		$pdf->Cell($special_request_width,5, $timeSheet->anl <= 0 ? null : $timeSheet->anl/60,1,2,'C');

		$tb_right_width = 60;
		$pdf->SetX($pdf->GetX()+128);
		$pdf->SetY($pdf->GetY()-(50), false);
		$pdf->Cell($tb_right_width,5,'TOTAL NORMAL PAY LESS 4HR RDO',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL TIME AND HALF (1.5)',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL DOUBLE TIME (2T)',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL PLD',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL RDO HRS TAKEN	',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL SICK TAKEN',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL HOLIDAY TAKEN',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL TRAVEL DAYS',1,2,'R');
		$pdf->Cell($tb_right_width,5,'TOTAL SITE ALLOW.',1,2,'R');
		$pdf->Cell($tb_right_width,5,'',0,2,'R');
		if ($timeSheet->employee->bonus > 0) {
			$pdf->Cell($tb_right_width,5,'BONUS',1,0,'R');
		} else {
			$pdf->Cell($tb_right_width,5,'',0,0,'R');
		}
		$pdf->SetY($pdf->GetY()-(50), false);
		$pdf->Cell(10,5, $timeSheet->normalLessRdo(),1,2,'C', true);
		$pdf->Cell(10,5, Hour::convertToDecimal($timeSheet->total_15) == 0 ? null : Hour::convertToDecimal($timeSheet->total_15),1,2,'C', true);
		$pdf->Cell(10,5, Hour::convertToDecimal($timeSheet->total_20) == 0 ? null : Hour::convertToDecimal($timeSheet->total_20),1,2,'C', true);
		$pdf->Cell(10,5, $timeSheet->pldTaken()->decimal == 0 ? null : $timeSheet->pldTaken()->decimal,1,2,'C', true);
		$pdf->Cell(10,5, $timeSheet->rdoTaken()->decimal == 0 ? null : $timeSheet->rdoTaken()->decimal,1,2,'C', true);

		$pdf->Cell(10,5, $timeSheet->sickTaken() == 0 ? null : $timeSheet->sickTaken() ,1,2,'C', true);
		$pdf->Cell(10,5, $timeSheet->anlTaken()->decimal == 0 ? null : $timeSheet->anlTaken()->decimal,1,2,'C', true);
		$pdf->Cell(10,5, $timeSheet->travelDays(),1,2,'C', true);
		$pdf->Cell(10,5, $timeSheet->siteAllow() == 0 ? null : $timeSheet->siteAllow()/60,1,2,'C', true);
		$pdf->Cell(10,5, "",0,2,'C', false);
		if ($timeSheet->employee->bonus > 0) {
			$pdf->Cell(10,5, $timeSheet->employee->bonus == 0 ? null : $timeSheet->employee->bonus,1,2,'C', true);
		}
		

        return $pdf;
	}

	public function listHours(){
        
        $result = array();
        foreach ($this->days as $day) {
            foreach ($day->dayJobs as $job) {
                if (isset($job->job->code)) {
                    if (isset($result[$job->job->code])) {
                        $result[$job->job->code] += $job->hours();
                    } else {
                        $result[$job->job->code] = $job->hours();
                    }                                
                }                        
            }
        }
        return $result;
	}

	public static function D($J){
	    return ($J<10? '0':'') . $J;
	}

	public function rdoTaken(){
		$rdo = Hour::convertToInteger($this->rdo);
		if (isset($this->listHours()["rdo"])) {
			$rdo += $this->listHours()["rdo"];
		}
		return new Hour($rdo);
	}

	public function pldTaken(){
		$pld = Hour::convertToInteger($this->pld);
		if (isset($this->listHours()["pld"])) {
			$pld += $this->listHours()["pld"];
		}
		return new Hour($pld);
	}

	public function sickTaken(){
		if (isset($this->listHours()["sick"])) {
			return $this->listHours()["sick"] > 0 ? $this->listHours()["sick"]/60 : null;
		} else {
			return "";	
		}				
	}

	public function normalLessRdo(){
		if ($this->employee->rdo) {
			$deduction = 0;
			$deductCodes = array("sick", "rdo", "anl", "pld");
			foreach ($this->listHours() as $job => $time) {
				if (in_array($job, $deductCodes)) {
					$deduction += $time;
				}
			}
			$result = (Hour::convertToInteger($this->normal) - (4 * 60) - $deduction)/60.0;
			return $result < 0 ? "" : $result;
		} else {
			return Hour::convertToInteger($this->normal) == 0 ? null : Hour::convertToInteger($this->normal)/60;
		}
	}

	public function anlTaken(){
		$anl = Hour::convertToInteger($this->anl);
		if (isset($this->listHours()["anl"])) {
			$anl += $this->listHours()["anl"];
		}
		return new Hour($anl);		
	}

	public function travelDays(){
		if ($this->employee->travel) {
            $travelDays = 0;		
            foreach ($this->days as $day) {
                if ($day->work()) {
                        $travelDays++;
                }                        
            }
            return $travelDays;
        } else {
        	return null;
        }
	}

	public function siteAllow(){
		if ($this->employee->site_allow) {
	        $siteAllow = 0;
	        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday", "rdo");
	        foreach ($this->listHours() as $job => $hours){                
	            if (!in_array($job, $deductCodes)) {
	                $siteAllow += $hours;
	            }                
	        }
	        return $siteAllow;			
		} else {
			return 0;
		}

	}
}
