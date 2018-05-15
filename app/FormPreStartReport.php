<?php 

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;
use Auth;
/**
* This class is used to convert time
*/
class FormPreStartReport extends Fpdf
{

	private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

	private function _header(FormPreStart $form_prestart) {

		$this->AddPage('P');
		$this->SetFillColor(255,154,0);
				
		$this->SetFont('Arial','B',$this->font['header']);		
		$this->Cell(50,23, '',1);		
		$this->Cell(90,23, 'PRESTART',1, 'BT', 'C', 1);		
		$this->Cell(50,23, '',1);		
		$this->Image('img/logo.jpg', 162, 11, 27);			
		$this->Ln(30);
		
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
		}

	}	

	public function _details(FormPreStart $form_prestart){
		$this->Ln(10);
		$this->Cell(190,5, 'Details of Discussion', 1, 1, 'L', 1);	

		$this->Line(10, 67, 10, 185);
		$this->Line(200, 67, 200, 185);
		$this->Line(10, 185, 200, 185);
		
		$this->Write(5, $form_prestart->details);
		$this->SetY(190);
	}

	public function _persons(FormPreStart $form_prestart){
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
	
	public function add(FormPreStart $form_prestart){		
		$this->_header($form_prestart);
		$this->_details($form_prestart);		
		$this->_persons($form_prestart);		
		$this->SetTitle("PRESTART ");
	    

		return $this;		       
	}

}