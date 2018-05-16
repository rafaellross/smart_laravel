<?php 

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;
use Auth;
/**
* This class is used to convert time
*/
class FormDailyCheckListReport extends Fpdf
{

	private $font = ["header" => 12, "label" => 9, "field" => 8, "values" => 7];

	private function _header(FormDailyCheckList $form) {

		$this->AddPage('P');
		
				
		$this->SetFont('Arial','B',$this->font['header']);		
		$this->Cell(95,23, '',1);		
		
		$this->Cell(95,23, ' Week Starting: ' . Carbon::parse($form->dt_form)->format('d/m/Y'), 1, 1);		
		$this->Cell(190, 6, ' SMART PLUMBING DAILY PLANT INSPECTION CHECKLIST', 1, 1, 'C');		
		$this->Cell(190, 6, '', 1, 1, 'C');				
		$this->Image('img/logo.jpg', 45, 11, 30);			
		$this->Ln(5);

		$this->SetFont('Arial','',$this->font['label']);		
		$this->Cell(95, 6, 'WORKING FOR: ' . $form->working_for,1);	
		$this->Cell(95, 6, 'JOB SITE: ' . $form->job_site,1, 1);	

		$this->Cell(95, 6, 'PLANT DESCRIPTION: ' . $form->plant_description,1);	
		$this->Cell(95, 6, 'REGISTRATION or PERMIT NO: ' . $form->reg_permit,1, 1);	


		$this->Cell(95, 6, 'MAKE & MODEL: ' . $form->make_model,1);	
		$this->Cell(95, 6, 'EXPIRY DATE: ' . Carbon::parse($form->expire_dt)->format('d/m/Y'),1, 1);	

		$this->Cell(95, 6, 'SERIAL NO: ' . $form->serial_no,1);	
		$this->Cell(95, 6, 'HOUR METRE/KM READING: ' . $form->km_reading,1, 1);	

		$this->SetFont('Arial','BU',$this->font['label']);	
		$this->Ln();
		$this->Cell(95, 6, 'PLANT OPERATOR DAILY SAFETY CHECKLIST:',0, 1);	
		$this->SetFont('Arial','',$this->font['label']);	
		$this->Write(5, 'Operators are required to check the following items before commencing work. These records form the basis of a plant maintenance procedure and will be subject to random inspection. Keep record with machine at all times.');
		$this->Ln(8);		
		$this->MultiCell(20, 15, '',0, 'L');	
		$this->SetXY($this->GetX()+20, $this->GetY()-15);
		$this->MultiCell(40, 6, 'OK, no obvious defect',0, 'L');	
		
		$this->SetXY($this->GetX()+60, $this->GetY()-6);

		$this->MultiCell(20, 15, '', 0, 'L');	
		$this->SetXY($this->GetX()+80, $this->GetY()-15);
		$this->MultiCell(35, 6, 'Fault, identified, use report below', 0, 'L');	
		$this->SetXY($this->GetX()+115, $this->GetY()-12);
		$this->MultiCell(15, 15, 'N/A', 0, 'C');	
		$this->SetXY($this->GetX()+130, $this->GetY()-15);
		$this->MultiCell(35, 6, 'Fault, identified, use report below', 0, 'L');	

		$this->Image('img/icon-check.png', 15, 104, 10);			
		$this->Image('img/icon-fault.png', 75, 104, 10);			
		$this->Ln();		
		$this->SetDrawColor(255, 0, 0);
		$this->Cell(20, 6, 'Y', 'TLB', 0, 'C');			
		$this->Cell(40, 6, '', 'TB', 0, 'C');			

		$this->Cell(20, 6, 'N', 'TB', 0, 'C');			
		$this->Cell(32.5, 6, '', 'TB', 0, 'C');			

		$this->Cell(20, 6, 'N/A', 'TB', 0, 'C');			
		$this->Cell(57.5, 6, '', 'TBR', 1, 'C');			

		$this->Ln();
		$this->SetDrawColor(0, 0, 0);
		$this->Cell(120, 6, 'BEFORE COMMENCING OPERATIONS CHECK', 1);	
		$this->Cell(10, 6, 'M', 1, 0, 'C');	
		$this->Cell(10, 6, 'T', 1, 0, 'C');	
		$this->Cell(10, 6, 'W', 1, 0, 'C');	
		$this->Cell(10, 6, 'T', 1, 0, 'C');	
		$this->Cell(10, 6, 'F', 1, 0, 'C');	
		$this->Cell(10, 6, 'S', 1, 0, 'C');	
		$this->Cell(10, 6, 'S', 1, 1, 'C');	

		$this->SetFont('Arial','',$this->font['values']);		

		foreach ($form->items as $item) {
			$this->Cell(120, 5,$item->description, 1);	
			$this->Cell(10, 5, $item->monday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->tuesday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->wednesday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->thursday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->friday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->saturday, 1, 0, 'C');	
			$this->Cell(10, 5, $item->sunday, 1, 1, 'C');	
			
		}

		$this->Ln();

		$this->SetFont('Arial','',$this->font['field']);		
		$this->Cell(35, 8, '', 1, 'C');
		
		$this->Cell(25, 8, '', 1, 'C');	
		
		$this->Cell(25, 8, '', 1, 'C');	
		
		$this->Cell(25, 8, '', 1, 'C');	
		
		$this->Cell(25, 8, '', 1, 'C');	
		
		$this->Cell(25, 8, '', 1, 'C');	
		
		$this->Cell(30, 8, '', 1, 'C');	

		$this->Text(15, $this->GetY()+5, "Operators Name");
		$this->SetFont('Arial','',$this->font['values']);
		foreach ($form->operators as $operator) {
			/*
			$this->Cell(35, 5,$operator->op_name, 1);	
			$this->Cell(25, 5, $operator->op_initials, 1, 0, 'C');	
			$this->Cell(25, 5, $operator->op_driver_lic, 1, 0, 'C');	
			$this->Cell(25, 5, $operator->op_ticket, 1, 0, 'C');	
			$this->Cell(25, 5, $operator->op_induction_car, 1, 0, 'C');	
			$this->Cell(25, 5, $operator->op_track_safety, 1, 0, 'C');	
			$this->Cell(30, 5, '', 1, 1, 'C');				
			if ($operator->signature) {
				$this->Image($operator->signature, $this->GetX()+160, $this->GetY()-6.4, 30,0,'png');
			}*/
		}
		/*
		$this->Ln(2);
		$this->Cell(10, 6, 'Details of faults or defects and action taken:',0);	

		$this->Ln();

		

		$this->MultiCell(190, 4, "Fault reported to________________ Position ____________________Date ________________");
		$this->MultiCell(190, 4, "Does fault constitute a safety hazard?");
		$this->MultiCell(190, 4, "Does machine require immediate repair? Y/N Does machine require immediate repair?");
		$this->MultiCell(190, 4, "If yes to either PARK MACHINE UP. Contact the hirer or supervisor and plant operator- detail inside front cover. Machine should not be used until supervisor or plant operator gives clearance for use.");
		*/
		/*
		$this->SetFont('Arial','',$this->font['label']);		
		$this->Cell(10, 6, 'Date:','BT');	

		if (Carbon::parse($form_prestart->dt_form)) {			
			$this->Cell(25,6, Carbon::parse($form_prestart->dt_form)->format('d/m/Y'), 'BT');		
		} else {
			$this->Cell(25,6, null, 'RB',1,'L');
		}

		$this->Cell(10, 6, 'Time:','BT');			
		$this->Cell(25,6, $form_prestart->time, 'BT',0);

		$this->Cell(13, 6, 'Project:','BT');			
		$this->Cell(107,6, $form_prestart->project, 'BT',1);
		$this->Cell(16, 6, 'Foreman:','B');			

		$foreman = Employee::find($form_prestart->foreman);
		
		if ($foreman) {
			$this->Cell(174,6, $foreman->name, 'B',1);
		} else {
			$this->Cell(174,6, null, 'B',1);
		}*/

	}	

	public function _details(FormDailyCheckList $form){
		$this->Ln(10);
		$this->Cell(190,5, 'Details of Discussion', 1, 1, 'L', 1);	

		$this->Line(10, 67, 10, 185);
		$this->Line(200, 67, 200, 185);
		$this->Line(10, 185, 200, 185);
		
		$this->Write(5, $form_prestart->details);
		$this->SetY(190);
	}

	public function _persons(FormDailyCheckList $form){
		$this->Cell(10, 6, 'All persons in attendance must sign below.',0, 1);			
		$sign_width = 35;

		$this->Cell(47.5, 6, 'Name',1, 0, 'C', 1);	
		$this->Cell(47.5, 6, 'Signature',1, 0, 'C', 1);	
		$this->Cell(47.5, 6, 'Name',1, 0, 'C', 1);	
		$this->Cell(47.5, 6, 'Signature',1, 1, 'C', 1);	

		foreach ($form_prestart->persons as $person) {
			$break_ln = false;
			if ($person->number % 2 == 0) {
				$break_ln = true;
			}

			$this->Cell(47.5, 6, $person->name,1, 0, 'L');	
			if ($person->signature) {
				$this->Image($person->signature, $this->GetX()+10, $this->GetY()-1, $sign_width,0,'png');
			}
			
			$this->Cell(47.5, 6, '',1, $break_ln, 'C');				
			
		}		
	}
	
	public function add(FormDailyCheckList $form){		
		$this->_header($form);
		//$this->_details($form_prestart);		
		//$this->_persons($form_prestart);		
		$this->SetTitle("Daily Plant Inspection Checklist ");
	    

		return $this;		       
	}

}