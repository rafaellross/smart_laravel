<?php

namespace App;

use App\ReportLogo;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;

class FormServiceSheetReport extends Fpdi
{

	public function add(FormServiceSheet $service_sheet)
	{
			// initiate FPDI

			// add a page
			$this->AddPage();
			// set the source file
			$this->setSourceFile('templates/Service_Sheet.pdf');
			// import page 1
			$tplIdx = $this->importPage(1);
			// use the imported page and place it at position 10,10 with a width of 100 mm
			$this->useTemplate($tplIdx, 0, 0, 210);
			$this->SetFont('Helvetica', '', 12);
			$this->_header($service_sheet);
			$this->_contact($service_sheet);

	}

	public function _header(FormServiceSheet $service_sheet){
			$this->SetFont('Helvetica', '', 16);


			$this->Text(165, 31.5, $service_sheet->job_no);

			$dt_form = is_null($service_sheet->dt_form) ? null : Carbon::parse($service_sheet->dt_form)->format('d/m/Y');
			if (!is_null($dt_form)) {
					$dt = explode("/", $dt_form);
					$day 			= $dt[0];
					$month 		= $dt[1];
					$year 		= $dt[2];

					$this->Text(161, 43.5, $day);
					$this->Text(176, 43.5, $month);
					$this->Text(190, 43.5, $year);
			}
	}

	public function _contact(FormServiceSheet $service_sheet){
			$this->Text(161, 60, $service_sheet->customer_name);
			$this->Text(176, 60, $service_sheet->customer_address);
			$this->Text(190, 60, $service_sheet->requested_by);

	}
}
