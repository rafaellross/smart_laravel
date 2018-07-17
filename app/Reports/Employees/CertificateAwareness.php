<?php

namespace App\Reports\Employees;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use App\Employee;
class CertificateAwareness extends Fpdf
{

	private $zoom = 3.467;
	private $font = ["header" => 15 * 1.5, "label" => 10, "field" => 9, "values" => 7];

  private $width = 85.6;
  private $height = 53.98;

  private $title = 'WORKPLACE IMPAIRMENT TRAINING';

	private function _start() {
		$this->SetY($this->GetY()+10);
	}

  private function front($employee, $ln = 0) {

    $this->SetFont('Arial','', $this->font["label"] * $this->zoom);
    $positions = array('X' => $this->GetX(), 'Y' => $this->GetY());
    //$this->Image('img/logo_hd.jpg', $positions['X']+(25 * $this->zoom), $positions['Y']+(11.5* $this->zoom), 40 * $this->zoom);
		$this->Cell($this->width * $this->zoom , 1 * $this->zoom, '', 0, 1, 'C');
    $this->Cell($this->width * $this->zoom , 8 * $this->zoom, $this->title, 0, 1, 'C');
    $this->SetFont('Arial','B', ($this->font["field"]+2) * $this->zoom);

    $this->Cell($this->width * $this->zoom , 3 * $this->zoom, $employee->name, 0, 1, 'C');
		$this->SetFont('Arial','', $this->font["field"] * $this->zoom);
		$this->Cell($this->width * $this->zoom , (15+10) * $this->zoom, '', 0, 1, 'C');
		$this->Cell($this->width * $this->zoom , 5 * $this->zoom, 'TRAINER: VINCENZO MOLLUSO', 0, 1, 'C');
		$this->Cell($this->width * $this->zoom , 5 * $this->zoom, 'ID No OD-002124', 0, 1, 'C');

    $this->Cell((($this->width/2)+5) * $this->zoom , 6.98 * $this->zoom, '   D.O.B.: ' . (is_null($employee->dob) ? '' : Carbon::parse($employee->dob)->format('d/m/Y')), 0, 0, 'L');
    $this->Cell(($this->width/2 -5) * $this->zoom, 6.98 * $this->zoom, '   Expiry: ' . Carbon::now()->addYear()->format('d/m/Y'), 0, 0, 'L');
    $this->SetXY($positions['X'] + $this->width, $positions['Y']);
    $this->Cell(5 * $this->zoom , $this->height * $this->zoom, '', 0, 0, 'C');
    return $positions;
  }

  private function back() {
      $this->Image('img/back-card_hd.png', -65, -69, $this->width +340);
      //$this->Cell($this->width  * $this->zoom , $this->height  * $this->zoom, '', 1, 1, 'C');

  }

  public function add(Employee $employee)
  {
    //Render Front
		$this->setMargins(0,0,0);
		$this->SetAutoPageBreak(true, 0);
		$this->AddPage('L', [187.3, 297]);
    $this->front($employee);
		$this->AddPage('L', [187.3, 297]);
    $this->back();

    //$this->Ln(5);
  }
}
