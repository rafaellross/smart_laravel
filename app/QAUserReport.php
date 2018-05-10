<?php 

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;
use Auth;
/**
* This class is used to convert time
*/
class QAUserReport extends Fpdf
{
	
	private $font = ["header" => 15, "label" => 10, "field" => 9];

	private function _header(QAUser $qa_user) {
		$this->AddPage('L');
		$this->SetFont('Arial','B',$this->font['header']);		
		$this->Image('img/water_mark.jpg', 74, 30, 150);
		$this->SetFont('Arial','B',$this->font['header']);
		$this->Cell(125,10,'Smart Plumbing Solutions Pty Ltd',1,0,'L');
		$this->Cell(80,10, $qa_user->title,1,0,'C');
		$this->Cell(70,10, 'Q.A Sign Off',1,1,'C');
		$this->SetFont('Arial','',$this->font['label']);

		$height_fields = 15;
		$start_fields_y = 15;

		$this->Line(10, $start_fields_y + 20, 285, $start_fields_y + 20);

		
		$this->Line(10, 15, 10, 20 + $height_fields);
		$this->Text(11, 24,'Revision No:');	    	
		$this->SetXY(33, 21.3);		
		$this->MultiCell(15, 4, $qa_user->revision);
		
		$this->Line(45, 20, 45, 20 + $height_fields);
		$this->Text(46, 24,'Customer:');	    	
		$this->SetXY(63, 21.3);		
		$this->MultiCell(50, 4, $qa_user->customer . "kldlçkdlçkdadlçkdalhjdjkdalkjdkjdalkjdalkldjkldjkdjdkkdjhdkdjdkjkdjdjkddjjhdjdjdjdj");


		$this->Line(60+53, 20, 60+53, 20 + $height_fields);
		$this->Text(60+54, 24,'Unit/Area No:');	    	

		$this->Line(60+95, 20, 60+95, 20 + $height_fields);
		$this->Text(60+96, 24,'Site Manager:');	    	

		$this->Line(60+150, 20, 60+150, 20 + $height_fields);
		$this->Text(60+151, 24,'Date of Update:');	    	

		$this->Line(60+190, 20, 60+190, 20 + $height_fields);
		$this->Text(60+191, 24,'Distribution');	    	
		$this->Line(285, 20, 285, 20 + $height_fields);

		$this->Line(10, 25 + $height_fields, 285, 25 + $height_fields);		
		
		$this->Line(10, 35, 10, 40);		
		$this->Text(11, 38.5, 'Location:');	    	
		$this->Line(285, 35, 285, 40);		
		$this->SetY(40);		

	}

	public function _activities(QAUser $qa_user){
		$this->Cell(78,5, 'Activity','LBR',0,'C');
		$this->Cell(15,5, 'A/T','LBR',0,'C');
		$this->Cell(78,5, 'Criteria Requirements','LBR',0,'C');
		$this->Cell(21,5, 'Reference','LBR',0,'C');
		$this->Cell(17,5, 'Yes / No','LBR',0,'C');
		$this->Cell(23,5, 'Installed By','LBR',0,'C');
		$this->Cell(23,5, 'Checked By','LBR',0,'C');
		$this->Cell(20,5, 'Date','LBR',1,'C');
		
		$this->SetFont('Arial','',$this->font['field']);
		foreach ($qa_user->activities as $activity) {
			$this->Cell(78,5, "(" . $activity->order. ") " . $activity->description,'LBR',0,'L');
			$this->Cell(15,5, $activity->at,'LBR',0,'C');
			$this->Cell(78,5, $activity->requirements,'LBR',0,'L');
			$this->Cell(21,5, $activity->reference,'LBR',0,'C');
			$this->Cell(17,5, strtoupper($activity->yes_no),'LBR',0,'C');
			$this->Cell(23,5, $activity->installed_by,'LBR',0,'C');
			$this->Cell(23,5, $activity->checked_by,'LBR',0,'C');
			$this->Cell(20,5, Carbon::parse($activity->activity_date)->format('d/m/Y'),'LBR',1,'C');
		}

		for ($i = 0; $i < 13-$qa_user->activities->count(); $i++) {
			$this->Cell(78,5, '','LBR',0,'L');
			$this->Cell(15,5, '','LBR',0,'C');
			$this->Cell(78,5, '','LBR',0,'L');
			$this->Cell(21,5, '','LBR',0,'C');
			$this->Cell(17,5, '','LBR',0,'C');
			$this->Cell(23,5, '','LBR',0,'C');
			$this->Cell(23,5, '','LBR',0,'C');
			$this->Cell(20,5, '','LBR',1,'C');
		}

		$this->Cell(275,5, 'Random=R   Verify=V   Hold=H   Submit=S   Inspect=I   Witness Points=W   Comments=C   Notification Point=N','LR',1,'C');
	}

	public function _comments(QAUser $qa_user){
		$this->Cell(275,5, 'COMMENTS','T','C');		
		$this->Line(10, 115, 10, 163);
		$this->Line(285, 115, 285, 163);
		$this->Line(10, 163, 285, 163);
		$this->Ln();
		$this->SetLeftMargin(12);
		$this->SetRightMargin(12);
		$this->Write(5, $qa_user->comments);

		$this->SetLeftMargin(10);		

		$this->SetY($this->GetY()+8);		
	}

	public function _approvals(QAUser $qa_user){

		$sign_width = 23;
		$this->Cell(275,5, 'Approved By',1,'C');		
		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_1, 'LB','C');		
		$this->Cell(76,5, 'Company:' . $qa_user->approved_company_1,'LB','C');		
		$this->Cell(63,5, 'Position:' . $qa_user->approved_position_1,'LB','C');		
		$this->Cell(63,5, 'Signature:','LRB','C');				
    	if (!is_null($qa_user->approved_sign_1)) {
    		$this->Image($qa_user->approved_sign_1, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}

		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_2, 'LB','C');		
		$this->Cell(76,5, 'Company:' . $qa_user->approved_company_2,'LB','C');		
		$this->Cell(63,5, 'Position:' . $qa_user->approved_position_2,'LB','C');		
		$this->Cell(63,5, 'Signature:','LRB','C');		
    	if (!is_null($qa_user->approved_sign_2)) {
    		$this->Image($qa_user->approved_sign_2, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}


		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_3, 'LB','C');		
		$this->Cell(76,5, 'Company:' . $qa_user->approved_company_3,'LB','C');		
		$this->Cell(63,5, 'Position:' . $qa_user->approved_position_3,'LB','C');		
		$this->Cell(63,5, 'Signature:','LRB','C');		
    	if (!is_null($qa_user->approved_sign_3)) {
    		$this->Image($qa_user->approved_sign_3, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}

		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_4, 'LB','C');		
		$this->Cell(76,5, 'Company:' . $qa_user->approved_company_4,'LB','C');		
		$this->Cell(63,5, 'Position:' . $qa_user->approved_position_4,'LB','C');		
		$this->Cell(63,5, 'Signature:','LRB','C');		
    	if (!is_null($qa_user->approved_sign_4)) {
    		$this->Image($qa_user->approved_sign_4, $this->GetX()-40, $this->GetY()+0.4, $sign_width,0,'png');
    	}

	}
	public function add(QAUser $qa_user){
		$this->_header($qa_user);
		$this->_activities($qa_user);
		$this->_comments($qa_user);
		$this->_approvals($qa_user);
		$this->SetTitle("Q.A Sign Off - " . $qa_user->title);
	    

		return $this;		       
	}

}