<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;

class AnnualLeaveReport extends \TCPDI
{
    public function add(AnnualLeave $annualLeave) {

      $this->SetTitle("Annual Leave Application Form");

      $this->AddPage();

      $this->setSourceFile('templates/Logo.pdf');

      $tplIdx = $this->importPage(1);

      $this->useTemplate($tplIdx, 0, 0, 210);
      $this->SetFont('Helvetica', 'BU', 14);
      $this->Ln(30);
      $this->Cell(0,10, "ANNUAL LEAVE APPLICATION FORM",0,1,'C', 0);
      $this->Ln(5);
      $this->SetFont('Helvetica', 'B', 12);
      $this->Cell(15, 5, "NAME: ",'B',0,'L', 0);
      $this->SetFont('Helvetica', '', 12);

      $this->Cell(75, 5, $annualLeave->employee->name,'B',0,'L', 0);
      $this->SetFont('Helvetica', 'B', 12);
      $this->Cell(30, 5, "",0,0,'L', 0);
      $this->Cell(15, 5, "DATE: ",'B',0,'L', 0);
      $this->SetFont('Helvetica', '', 12);
      $this->Cell(45, 5, Carbon::parse($annualLeave->request_dt)->format('d/m/Y'),'B',0,'L', 0);



      $this->Ln(20);
      $this->SetFont('Helvetica', 'BU', 12);
      $this->Cell(60, 5, "START DATE",'B',0,'C', 0);
      $this->Cell(60, 5, "DAYS/HOURS TAKEN",0,0,'C', 0);
      $this->Cell(60, 5, "DATE RETURN TO WORK", 0,1,'C', 0);

      $this->SetFont('Helvetica', '', 12);

      for ($i=0; $i < 9; $i++) {
        if ($i == 0) {

          $this->Cell(60, 5, Carbon::parse($annualLeave->start_dt)->format('d/m/Y'), 1,0,'C', 0);
          $this->Cell(60, 5, "", 1,0,'C', 0);
          $this->Cell(60, 5, Carbon::parse($annualLeave->return_dt)->format('d/m/Y'), 1,1,'C', 0);


        } else {
          $this->Cell(60, 5, "", 1,0,'C', 0);
          $this->Cell(60, 5, "", 1,0,'C', 0);
          $this->Cell(60, 5, "", 1,1,'C', 0);

        }

      }

      $this->Ln(10);

      $this->SetFont('Helvetica', 'B', 12);
      $this->Cell(120, 5, "EMPLOYEE SIGNATURE:",'B',0,'L', 0);
      $this->Cell(20, 5, "",0,0,'L', 0);
      $this->Cell(15, 5, "DATE:",'B',0,'L', 0);

      $this->SetFont('Helvetica', '', 12);
      $this->Cell(25, 5, Carbon::parse($annualLeave->request_dt)->format('d/m/Y'),'B',1,'L', 0);



      if (!is_null($annualLeave->emp_signature)) {
        $this->Image($annualLeave->emp_signature, 65,136,40,0,'png');
      }


      $this->Ln(10);

      $this->SetFont('Helvetica', 'B', 12);
      $this->Cell(120, 5, "AUTHORISED BY:",'B',0,'L', 0);
      $this->Cell(20, 5, "",0,0,'L', 0);
      $this->Cell(40, 5, "DATE:",'B',1,'L', 0);
      $this->SetFont('Helvetica', 'I', 10);
      $this->Cell(90, 5, "(SITE FOREMAN)",0,0,'R', 0);
      $this->SetFont('Helvetica', 'B', 12);
      $this->Ln(10);

      $this->SetFont('Helvetica', 'B', 12);
      $this->Cell(120, 5, "APPROVED BY:",'B',0,'L', 0);
      $this->Cell(20, 5, "",0,0,'L', 0);
      $this->Cell(40, 5, "DATE:",'B',1,'L', 0);
      $this->SetFont('Helvetica', 'I', 10);
      $this->Cell(90, 5, "(MANAGEMENT APPROVAL)",0,0,'R', 0);
      $this->SetFont('Helvetica', 'B', 12);
      $this->Ln(10);


    }
}
