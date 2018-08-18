<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class TimeSheetSummary extends Fpdf
{
    private $odd = true;
    public function Header() {
      $this->SetTitle("List of Employees");
      $this->SetFont('Arial','I',8);
      $this->SetDrawColor(200,200,200);
      $this->Text(260, 10,'Printed: '. Carbon::now()->format('d/m/Y'));
      $this->Image('img/logo.jpg', 255, 15, 30);
      $this->SetFont('Arial','B', 15);
      $this->Ln(20);
      $this->MultiCell(0 , 25, 'TIMESHEET SUMMARY', 0, 'C');

      $this->SetFont('Arial','B', 8);

      $y = $this->GetY();
      $x = $this->GetX();

      $this->SetFillColor(255,154,0);

      $header_height = 9;
      $this->MultiCell(10 , $header_height, '#', 'LTB', 'C', 1);
      $this->SetXY($x+10, $y);
      $y = $this->GetY();
      $x = $this->GetX();


      $header_height = 9;
      $this->MultiCell(20 , $header_height, 'User', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();


      $header_height = 9;
      $this->MultiCell(20 , $header_height, 'Date', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(70 , $header_height, 'Employee', 'LTB', 'C', 1);
      $this->SetXY($x+70, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(20 , $header_height, 'Total Hours', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(30 , $header_height, 'Normal Hours', 'LTB', 'C', 1);
      $this->SetXY($x+30, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(20 , $header_height, 'Hours 1.5', 'LTB', 'C', 1);
      $this->SetXY($x+20, $y);
      $y = $this->GetY();
      $x = $this->GetX();

      $this->MultiCell(25 , $header_height, 'Hours 2.0', 'LTB', 'C', 1);
      $this->SetXY($x+25, $y);
      $y = $this->GetY();
      $x = $this->GetX();


      $this->MultiCell(25 , $header_height, 'Week End', 'LTB', 'C', 1);
      $this->SetXY($x+25, $y);

      $this->MultiCell(30 , $header_height, 'Job', 'LTRB', 'C', 1);



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

    public function add($timesheets) {
      $this->SetFont('Arial','', 8);
      $this->SetDrawColor(200,200,200);
      $this->SetFillColor(200,200,200);
      $this->AddPage('L');
      foreach ($timesheets as $timesheet) {
        if ($this->odd) {
          $this->odd = false;
        } else {
          $this->odd = true;
        }


        $this->Cell(10 , 5, $timesheet->id, 'LB', 0, 'C', $this->odd);
        $this->Cell(20 , 5, $timesheet->username, 'LB', 0, 'C', $this->odd);

        $this->Cell(20 , 5, Carbon::parse($timesheet->created_at)->format('d/m/Y'), 'LB', 0, 'C', $this->odd);


        $this->Cell(70 , 5, $timesheet->name, 'LB', 0, 'C', $this->odd);
        $this->Cell(20 , 5, $timesheet->total, 'LB', 0, 'C', $this->odd);

        $this->Cell(30 , 5, $timesheet->normal, 'LB', 0, 'C', $this->odd);

        $this->Cell(20 , 5, $timesheet->total_15, 'LB', 0, 'C', $this->odd);

        $this->Cell(25 , 5, $timesheet->total_20, 'LB', 0, 'C', $this->odd);

        $this->Cell(25 , 5, Carbon::parse($timesheet->week_end)->format('d/m/Y'), 'LB', 0, 'C', $this->odd);
        $this->Cell(30 , 5, $timesheet->job, 'LBR', 1, 'C', $this->odd);

      }

      //Total

      $total_hours = 0;
      $total_normal = 0;
      $total_15 = 0;
      $total_20 = 0;

      foreach ($timesheets as $timesheet) {
        $total_hours += Hour::convertToInteger($timesheet->total);
        $total_normal += Hour::convertToInteger($timesheet->normal);
        $total_15 += Hour::convertToInteger($timesheet->total_15);
        $total_20 += Hour::convertToInteger($timesheet->total_20);
      }

      $this->Cell(20 , 5, Hour::convertToHour($total_hours), 'LB', 0, 'C', $this->odd);
      $this->Cell(20 , 5, Hour::convertToHour($total_hours), 'LB', 0, 'C', $this->odd);

      $this->Cell(30 , 5, Hour::convertToHour($total_normal), 'LB', 0, 'C', $this->odd);

      $this->Cell(20 , 5, Hour::convertToHour($total_15), 'LB', 0, 'C', $this->odd);

      $this->Cell(25 , 5, Hour::convertToHour($total_20), 'LB', 0, 'C', $this->odd);
    }
}
