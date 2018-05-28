<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class CertificateAwareness extends Fpdf
{

	private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

  private $width = 85.6;
  private $height = 53.98;

  private $title = 'WORKPLACE IMPAIRMENT TRAINING';


	private function _start() {
		$this->SetY($this->GetY()+10);
	}

  private function front($name = '', $ln = 0) {

    $this->SetFont('Arial','', $this->font["label"]);
    $positions = array('X' => $this->GetX(), 'Y' => $this->GetY());
    $this->Image('img/water_mark.jpg', $positions['X']+25, $positions['Y']+13, 40);
		$this->Cell($this->width , 1, '', 'LTR', 1, 'C');
    $this->Cell($this->width , 8, $this->title, 'LR', 1, 'C');
    $this->SetFont('Arial','B', $this->font["field"]);

    $this->Cell($this->width , 3, $name, 'LR', 1, 'C');
		$this->SetFont('Arial','', $this->font["field"]);
		$this->Cell($this->width , 15+10, '', 'LR', 1, 'C');
		$this->Cell($this->width , 5, 'TRAINER: VINCENZO MOLLUSO', 'LR', 1, 'C');
		$this->Cell($this->width , 5, 'ID No OD-002124', 'LR', 1, 'C');

    $this->Cell(($this->width/2)+5 , 6.98, '   D.O.B.:', 'LB', 0, 'L');
    $this->Cell($this->width/2 -5, 6.98, '   Expiry: ' . Carbon::now()->addYear()->format('d/m/Y'), 'BR', 0, 'L');
    $this->SetXY($positions['X'] + $this->width, $positions['Y']);
    $this->Cell(5 , $this->height, '', 0, 0, 'C');
    return $positions;
  }

  private function back() {
      $this->Image('img/back-card.jpg', $this->GetX(), $this->GetY()+1.6, $this->width);
      $this->Cell($this->width , $this->height, '', 1, 1, 'C');

  }

  public function add(Employee $employee)
  {
    //Render Front

    $this->front($employee->name);
    $this->back();



    //Render Front
    //$this->shape(1);
    $this->Ln(5);
  }
}
