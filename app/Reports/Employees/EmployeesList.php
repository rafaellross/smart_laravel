<?php

namespace App\Reports\Employees;

use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class EmployeesList extends Fpdf
{
    private $odd = true;
    public function Header() {
      $this->SetTitle("List of Employees");
      $this->SetFont('Arial','I',8);
      $this->SetDrawColor(200,200,200);
      $this->Text(175, 10,'Printed: '. Carbon::now()->format('d/m/Y'));
      $this->Image('img/logo.jpg', 170, 15, 30);
      $this->SetFont('Arial','B', 15);
      $this->Ln(5);
      $this->MultiCell(0 , 25, 'LIST OF EMPLOYEES', 0, 'C');

      $this->SetFont('Arial','B', 8);

      $y = $this->GetY();
      $x = $this->GetX();

      $this->SetFillColor(255,154,0);

      $header_height = 9;
      $this->MultiCell(50 , $header_height, 'Name', 'LTB', 'C', 1);
      $this->SetXY($x+50, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(20 , $header_height, 'D.O.B', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(20 , $header_height, 'Phone', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(20 , $header_height, 'Role', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(25 , $header_height, 'Company', 'LTB', 'C', 1);
      $this->SetXY($x+25, $y);
      $y = $this->GetY();
      $x = $this->GetX();


      $this->MultiCell(25 , $header_height, 'Apprentice Year', 'LTB', 'C', 1);
      $this->SetXY($x+25, $y);

      $this->MultiCell(30 , $header_height, 'Apprentice Rollover', 'LTRB', 'C', 1);


    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }

    public function add($employees) {
      $this->SetFont('Arial','', 8);
      $this->SetDrawColor(200,200,200);
      $this->SetFillColor(200,200,200);
      foreach ($employees as $employee) {
        if ($this->odd) {
          $this->odd = false;
        } else {
          $this->odd = true;
        }

    		$this->Cell(50 , 5, $employee->name, 'LB', 0, 'L', $this->odd);
        $this->Cell(20 , 5, (is_null($employee->dob) ? '' : Carbon::parse($employee->dob)->format('d/m/Y')), 'LB', 0, 'C', $this->odd);
        $this->Cell(20 , 5, $employee->phone, 'LB', 0, 'C', $this->odd);

        $this->Cell(20 , 5, $employee->location, 'LB', 0, 'C', $this->odd);

        $this->Cell(25 , 5, ($employee->company == 'M' ? 'Maintenance' : 'Construction'), 'LB', 0, 'C', $this->odd);

        $this->Cell(25 , 5, $employee->apprentice_year, 'LB', 0, 'C', $this->odd);
        $this->Cell(30 , 5, (is_null($employee->anniversary_dt) ? '' : Carbon::parse($employee->anniversary_dt)->format('d/m/Y')), 'LBR', 1, 'C', $this->odd);

      }

    }
}
