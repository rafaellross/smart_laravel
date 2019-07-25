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

	private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

	private function _header(QAUser $qa_user) {
		$this->AddPage('L');
		$this->SetFont('Arial','B',$this->font['header']);
		$this->Image('img/water_mark.jpg', 74, 30, 150);
		$this->SetFont('Arial','B',$this->font['header']);
		$this->Cell(125,10,'Smart Plumbing Solutions Pty Ltd',1,0,'L');
		$this->Cell(80,10, $qa_user->title,1,0,'C');
		$this->Cell(70,10, 'Q.A Sign Off',1,1,'C');

		$this->SetFont('Arial','',$this->font['label']);
		$this->Cell(22,5, 'Revision No:','LB',0,'L');
		$this->Cell(160,5, $qa_user->revision, 'RB',0,'L');
		$this->Cell(27,5, 'Date of Update:', 'B',0,'L');
		if (Carbon::parse($qa_user->update_date)) {
			$this->Cell(66,5, Carbon::parse($qa_user->update_date)->format('d/m/Y'), 'RB',1,'L');
		} else {
			$this->Cell(66,5, null, 'RB',1,'L');
		}


		$height_fields = 15;
		$start_fields_y = 25;

		$this->Line(10, $start_fields_y + 20, 285, $start_fields_y + 20);


		$this->Line(10, 25, 10, 25 + $height_fields);
		$this->Text(11, 29,'Project:');

		$this->Line(62, 25, 62, 25 + $height_fields);
		$this->Text(63, 29,'Customer:');

		$this->Line(85+53, 25, 85+53, 25 + $height_fields);
		$this->Text(85+54, 29,'Unit/Area No:');


		$this->Line(100+95, 25, 100+95, 25 + $height_fields);
		$this->Text(100+96, 29,'Site Manager:');
		$this->Text(100+96, 36,'Foreman:');


		$this->Line(60+190, 25, 60+190, 25 + $height_fields);
		$this->Text(60+191, 29,'Distribution');
		$this->Line(285, 25, 285, 25 + $height_fields);

		$this->Line(10, 25 + $height_fields, 285, 25 + $height_fields);

		$this->Line(10, 40, 10, 45);
		$this->Text(11, 43.5, 'Location:');
		$this->Line(285, 40, 285, 45);

		$this->SetFont('Arial','',$this->font['values']);
		$this->SetXY(23, 26);
		$this->MultiCell(40, 4, $qa_user->job->description);

		$this->SetXY(80, 26.1);
		$this->MultiCell(55, 4, $qa_user->customer);

		$this->SetXY(162, 26.1);
		$this->MultiCell(30.5, 4, $qa_user->unit_area);

		$this->SetXY(219, 26.1);
		$this->MultiCell(30, 4, $qa_user->site_manager);

		$this->SetXY(219, 33.1);

		$foreman = Employee::find($qa_user->foreman);

		if (isset($foreman->name)) {
			$this->MultiCell(30, 4, $foreman->name);
		} else {
			$this->MultiCell(30, 4, null);
		}


		$this->SetXY(250, 30.1);

		$this->SetFont('Arial','',$this->font['label']);
		$this->SetFillColor(255,154,0);

		$this->Cell(18,5, 'Builder','T',0,'L', ($qa_user->distribution == 'Builder' ? true : false));
		$this->Cell(17,5, 'Reg Auth.','T',1,'L', ($qa_user->distribution == 'Reg Auth.' ? true : false));

		$this->SetXY(250, 35.1);
		$this->Cell(18,5, 'Client',0,0,'L', ($qa_user->distribution == 'Client' ? true : false));
		$this->Cell(17,5, 'Engineer',0,1,'L', ($qa_user->distribution == 'Engineer' ? true : false));

		$this->SetXY(25, 40.7);
		$this->MultiCell(150, 4, $qa_user->location);

		$this->SetY(45);

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
			if (Carbon::parse($activity->activity_date)) {
				$this->Cell(20,5, Carbon::parse($activity->activity_date)->format('d/m/Y'),'LBR',1,'C');
			} else {
				$this->Cell(20,5, null,'LBR',1,'C');
			}
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
		$this->Line(10, 115, 10, 175);
		$this->Line(285, 115, 285, 175);

		$this->Ln();
		$this->SetLeftMargin(12);
		$this->SetRightMargin(12);
		$this->Write(5, $qa_user->comments);

		$this->SetLeftMargin(10);

		$this->SetY($this->GetY()+8);
	}

	public function _approvals(QAUser $qa_user){
		$this->SetY(175);
		$sign_width = 23;
		$this->Cell(275,5, 'Approved By',1,'C');
		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_1, 'LB','C');
		$this->Cell(76,5, 'Company: ' . $qa_user->approved_company_1,'LB','C');
		$this->Cell(63,5, 'Position: ' . $qa_user->approved_position_1,'LB','C');
		$this->Cell(63,5, 'Signature: ','LRB','C');
    	if (!is_null($qa_user->approved_sign_1)) {
    		$this->Image($qa_user->approved_sign_1, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}

		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_2, 'LB','C');
		$this->Cell(76,5, 'Company: ' . $qa_user->approved_company_2,'LB','C');
		$this->Cell(63,5, 'Position: ' . $qa_user->approved_position_2,'LB','C');
		$this->Cell(63,5, 'Signature: ','LRB','C');
    	if (!is_null($qa_user->approved_sign_2)) {
    		$this->Image($qa_user->approved_sign_2, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}


		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_3, 'LB','C');
		$this->Cell(76,5, 'Company: ' . $qa_user->approved_company_3,'LB','C');
		$this->Cell(63,5, 'Position: ' . $qa_user->approved_position_3,'LB','C');
		$this->Cell(63,5, 'Signature: ','LRB','C');
    	if (!is_null($qa_user->approved_sign_3)) {
    		$this->Image($qa_user->approved_sign_3, $this->GetX()-40, $this->GetY()+0.5, $sign_width,0,'png');
    	}

		$this->Ln();
		$this->Cell(73,5, 'Name: ' . $qa_user->approved_name_4, 'LB','C');
		$this->Cell(76,5, 'Company: ' . $qa_user->approved_company_4,'LB','C');
		$this->Cell(63,5, 'Position: ' . $qa_user->approved_position_4,'LB','C');
		$this->Cell(63,5, 'Signature: ','LRB','C');
    	if (!is_null($qa_user->approved_sign_4)) {
    		$this->Image($qa_user->approved_sign_4, $this->GetX()-40, $this->GetY()+0.4, $sign_width,0,'png');
    	}

	}

	public function _photos(QAUser $qa_user)
	{

		$this->SetFont('Arial','B',12);

		if ($qa_user->photos->count() > 0) {
			foreach ($qa_user->photos as $photo) {
					list($width, $height, $type, $attr) = getimagesize($photo->qa_photo);
					if ($width > $height) {
						$this->AddPage('L');
					} else {
						$this->AddPage('P');
					}
					$this->Cell($this->GetPageWidth(),5,"Photo #" . $photo->photo_number,0,0,'C');
					$this->Image($photo->qa_photo, 15,25, min($this->GetPageWidth()-70, $width-70),0, str_replace("image/", "", image_type_to_mime_type($type)));
			}
		}

	}

	public function add(QAUser $qa_user){
		$this->SetAutoPageBreak(false);
		$this->_header($qa_user);
		$this->_activities($qa_user);
		$this->_comments($qa_user);
		$this->_approvals($qa_user);
		$this->_photos($qa_user);
		$this->SetTitle("Q.A Sign Off - " . $qa_user->title);


		return $this;
	}

}
