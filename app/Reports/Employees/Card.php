<?php

namespace App\Reports\Employees;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Text;
use App\Employee;

class Card extends Fpdf
{

	private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

  private $width = 85.6;
  private $height = 53.98;

  private $title = 'EMPLOYEE ID CARD';

	private function _start() {
		$this->SetY($this->GetY()+10);
	}

  private function front($employee, $ln = 0) {

    $this->SetFont('Arial','', $this->font["label"]);
    $positions = array('X' => $this->GetX(), 'Y' => $this->GetY());

		$this->Cell($this->width , 1, '', 'LTR', 1, 'C');
    $this->Cell($this->width , 8, $this->title, 'LR', 1, 'C');
    $this->SetFont('Arial','B', $this->font["field"]);

    $this->Cell($this->width , 3, $employee->name, 'LR', 1, 'C');
		$this->SetFont('Arial','', $this->font["field"]);
		$this->Cell($this->width , 15+10, '', 'LR', 1, 'C');
		$this->Cell($this->width , 5, '', 'LR', 1, 'C');
		$this->Cell($this->width , 5, '', 'LR', 1, 'C');


		$url = new QR_Text("{\"id\": $employee->id, \"name\": \"$employee->name\" }");
    $url->setOutfile('tmp/qr_' . $employee->id .'.png')->png();

		$this->Image('tmp/qr_' . $employee->id .'.png', $positions['X']+23, $positions['Y']+13, 40);


    $this->Cell(($this->width/2)+5 , 6.98, ' ' . (is_null($employee->dob) ? '' : Carbon::parse($employee->dob)->format('d/m/Y')), 'LB', 0, 'L');
    $this->Cell($this->width/2 -5, 6.98, '', 'BR', 0, 'L');
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

    $this->front($employee);
    $this->back();

    $this->Ln(5);
  }
}
