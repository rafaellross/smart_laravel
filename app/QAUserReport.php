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
		$this->Image('img/water_mark.jpg', 74, 30, 150);
		$this->SetFont('Arial','B',$this->font['header']);
		$this->Cell(125,10,'Smart Plumbing Solutions Pty Ltd',1,0,'L');
		$this->Cell(80,10, $qa_user->title,1,0,'C');
		$this->Cell(70,10, 'Q.A Sign Off',1,1,'C');

		$this->SetFont('Arial','',$this->font['label']);
		$this->Cell(125+80,5,'Revision No:' . $qa_user->revision,1,0,'L');
		$this->Cell(70,5, 'Date of Update:' . Carbon::parse($qa_user->update_date)->format('d/m/Y'),1,1,'L');

		$this->Cell(13,5, 'Project','L',1,'L');
		$this->Cell(13,10, '','LB',1,'L');
		$this->SetXY($this->GetX()+13, $this->GetY()-10);
		$this->MultiCell(36,5, substr($qa_user->job->description, 0, 30) ,'B','L');

		$this->SetXY($this->GetX()+13+36, $this->GetY()-15);
		$this->Cell(17,5, 'Customer','L',1,'L');
		$this->SetX($this->GetX()+13+36);
		$this->Cell(17,10, '','LB',1,'L');
		$this->SetXY($this->GetX()+13+36+17, $this->GetY()-10);
		$this->MultiCell(36,10, substr($qa_user->customer, 0, 30) ,'B','L');

		$this->SetXY($this->GetX()+13+36+53, $this->GetY()-15);
		$this->Cell(23,5, 'Unit/Area No.','L',1,'L');
		$this->SetX($this->GetX()+13+36+53);
		$this->Cell(23,10, '','LB',1,'L');
		$this->SetXY($this->GetX()+13+36+53+23, $this->GetY()-10);
		$this->MultiCell(36,10, substr($qa_user->unit_area, 0, 30) ,'B','L');

		$this->SetXY($this->GetX()+13+36+53+23+36, $this->GetY()-15);
		$this->Cell(25,5, 'Site Manager:','L',0,'L');
		$this->Cell(55,5, $qa_user->site_manager,0,1,'L');		
		$this->SetXY($this->GetX()+13+36+53+23+36, $this->GetY());
		$this->Cell(25,5, 'Foreman:','L',0,'L');
		$this->Cell(55,5, $qa_user->foreman_name->name, 0,1,'L');
		$this->SetXY($this->GetX()+13+36+53+23+36, $this->GetY());
		$this->Cell(80,5, '','LB',0,'L');

		$this->SetXY($this->GetX(), $this->GetY()-10);
		$this->Cell(34,5, 'Distribution','LBR',1,'L');
		$this->SetXY($this->GetX()+241, $this->GetY());

		$this->SetFillColor(255,154,0);

		$this->Cell(16,5, 'Builder','L',0,'L', ($qa_user->distribution == 'Builder' ? true : false));
		$this->Cell(18,5, 'Reg Auth.','R', 1,'L', ($qa_user->distribution == 'Reg Auth.' ? true : false));
		
		$this->SetXY($this->GetX()+241, $this->GetY());
		$this->Cell(16,5, 'Client','LB',0,'L', ($qa_user->distribution == 'Client' ? true : false));
		$this->Cell(18,5, 'Engineer','RB',1,'L', ($qa_user->distribution == 'Engineer' ? true : false));
		

		$this->Cell(275,5, 'Location: ' . $qa_user->location,'LBR',1,'L');


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
		$this->Cell(275,5, 'COMMENTS','LRT','C');		
		$this->Ln();
		$this->SetLeftMargin(12);
		$this->SetRightMargin(12);
		$this->Write(5, $qa_user->comments);

		$this->SetLeftMargin(10);
		$this->Rect(10, 125, 275, 39.5);

		$this->SetY($this->GetY()+4.5);		
	}

	public function _approvals(QAUser $qa_user){
		$this->Cell(275,5, 'Approved By',1,'C');		
		$this->Ln();
		$this->Cell(73,5, 'Name', 'LB','C');		
		$this->Cell(76,5, 'Company','LB','C');		
		$this->Cell(63,5, 'Position','LB','C');		
		$this->Cell(63,5, 'Signature','LRB','C');		

		$this->Ln();
		$this->Cell(73,5, 'Name', 'LB','C');		
		$this->Cell(76,5, 'Company','LB','C');		
		$this->Cell(63,5, 'Position','LB','C');		
		$this->Cell(63,5, 'Signature','LRB','C');		

		$this->Ln();
		$this->Cell(73,5, 'Name', 'LB','C');		
		$this->Cell(76,5, 'Company','LB','C');		
		$this->Cell(63,5, 'Position','LB','C');		
		$this->Cell(63,5, 'Signature','LRB','C');		

		$this->Ln();
		$this->Cell(73,5, 'Name', 'LB','C');		
		$this->Cell(76,5, 'Company','LB','C');		
		$this->Cell(63,5, 'Position','LB','C');		
		$this->Cell(63,5, 'Signature','LRB','C');		
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