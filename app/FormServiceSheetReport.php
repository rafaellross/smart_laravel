<?php

namespace App;

use App\ReportLogo;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;

class FormServiceSheetReport extends \TCPDI
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


			$this->Text(165, 26.5, $service_sheet->job_no);

			$dt_form = is_null($service_sheet->dt_form) ? null : Carbon::parse($service_sheet->dt_form)->format('d/m/Y');
			if (!is_null($dt_form)) {
					$dt = explode("/", $dt_form);
					$day 			= $dt[0];
					$month 		= $dt[1];
					$year 		= $dt[2];

					$this->Text(161, 38.1, $day);
					$this->Text(176, 38.1, $month);
					$this->Text(190, 38.1, $year);
			}
	}

	public function _contact(FormServiceSheet $service_sheet){
			$this->SetFont('Helvetica', '', 10);
			$this->Text(45, 55, strtoupper($service_sheet->customer_name));
			$this->SetXY(48, 63);
			$this->MultiCell(63, 63.5, substr($service_sheet->customer_address, 0, 75) );
			$this->Text(52, 78.5, $service_sheet->requested_by);

			$this->SetFont('Helvetica', '', 9.5);
			$this->Text(136, 55.5, substr($service_sheet->job_description, 0, 30));

			$this->SetXY(133.5, 63.5);
			$this->MultiCell(68, 64, substr($service_sheet->job_address, 0, 87));

			$this->Text(38, 85.8, $service_sheet->contact_no);

			$this->Text(131.5, 78.5, $service_sheet->site_contact);

			$this->Text(131.5, 85.5, $service_sheet->site_contact_no);

			$this->Text(138.5, 103.8, $service_sheet->read_understood);

			$authority_dt = is_null($service_sheet->authority_dt) ? null : Carbon::parse($service_sheet->authority_dt)->format('d/m/Y');

			if (!is_null($authority_dt)) {
				$dt = explode("/", $authority_dt);
				$day 			= $dt[0];
				$month 		= $dt[1];
				$year 		= $dt[2];

				$this->SetFont('Helvetica', '', 8.0);
				$this->Text(184.5, 112, $day);
				$this->Text(185.5 + 5.5, 112, $month);
				$this->Text(186.5 + 10.5, 112, $year);
			}

			$border_on = false;
			$this->SetXY(19.5, 125);
			$this->MultiCell(185, 64, substr($service_sheet->description, 0, 580) . (str_repeat(' ', 580 - count($service_sheet->description))));

			$this->SetXY(19.2, 158.5);
			$this->SetFont('Helvetica', '', 10.0);
			$this->Cell(31.5, 5.2, $service_sheet->purchase_no_1, $border_on, 0, 'C');
			$this->Cell(153.9, 5.2, $service_sheet->material_no_1, $border_on, 1, 'L');

			$this->SetX(19.2);
			$this->Cell(31.5, 5.2, $service_sheet->purchase_no_2, $border_on, 0, 'C');
			$this->Cell(153.9, 5.2, $service_sheet->material_no_2, $border_on, 1, 'L');

			$this->SetX(19.2);
			$this->Cell(31.5, 5.2, $service_sheet->purchase_no_3, $border_on, 0, 'C');
			$this->Cell(153.9, 5.2, $service_sheet->material_no_3, $border_on, 1, 'L');


			$this->SetXY(19.2, 188.8);
			$this->SetFont('Helvetica', '', 6.0);
			$timesheet_dt_1 = is_null($service_sheet->time_sheet_dt_1) ? null : Carbon::parse($service_sheet->time_sheet_dt_1)->format('d/m/y');
			if (!is_null($timesheet_dt_1)) {
				$this->Cell(10.5, 7.0, $timesheet_dt_1, $border_on, 0, 'C');
			} else {
				$this->Cell(10.5, 7.0, '', $border_on, 0, 'C');
			}


			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_start_1, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_end_1, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_total_1, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_initial_1, $border_on, 1, 'C');


			$this->SetX(19.2);
			$this->SetFont('Helvetica', '', 6.0);
			$timesheet_dt_2 = is_null($service_sheet->time_sheet_dt_2) ? null : Carbon::parse($service_sheet->time_sheet_dt_2)->format('d/m/y');
			if (!is_null($timesheet_dt_2)) {
				$this->Cell(10.5, 7.0, $timesheet_dt_2, $border_on, 0, 'C');
			} else {
				$this->Cell(10.5, 7.0, '', $border_on, 0, 'C');
			}

			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_start_2, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_end_2, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_total_2, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_initial_2, $border_on, 1, 'C');


			$this->SetX(19.2);
			$this->SetFont('Helvetica', '', 6.0);
			$timesheet_dt_3 = is_null($service_sheet->time_sheet_dt_3) ? null : Carbon::parse($service_sheet->time_sheet_dt_3)->format('d/m/y');
			if (!is_null($timesheet_dt_3)) {
				$this->Cell(10.5, 7.0, $timesheet_dt_3, $border_on, 0, 'C');
			} else {
				$this->Cell(10.5, 7.0, '', $border_on, 0, 'C');
			}

			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_start_3, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_end_3, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_total_3, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_initial_3, $border_on, 1, 'C');


			$this->SetX(19.2);
			$this->SetFont('Helvetica', '', 6.0);
			$timesheet_dt_4 = is_null($service_sheet->time_sheet_dt_4) ? null : Carbon::parse($service_sheet->time_sheet_dt_4)->format('d/m/y');
			if (!is_null($timesheet_dt_4)) {
				$this->Cell(10.5, 7.0, $timesheet_dt_4, $border_on, 0, 'C');
			} else {
				$this->Cell(10.5, 7.0, '', $border_on, 0, 'C');
			}

			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_start_4, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_end_4, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_total_4, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_initial_4, $border_on, 1, 'C');


			$this->SetX(19.2);
			$this->SetFont('Helvetica', '', 6.0);
			$timesheet_dt_5 = is_null($service_sheet->time_sheet_dt_5) ? null : Carbon::parse($service_sheet->time_sheet_dt_5)->format('d/m/y');
			if (!is_null($timesheet_dt_5)) {
				$this->Cell(10.5, 7.0, $timesheet_dt_5, $border_on, 0, 'C');
			} else {
				$this->Cell(10.5, 7.0, '', $border_on, 0, 'C');
			}

			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_start_5, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_end_5, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_total_5, $border_on, 0, 'C');
			$this->Cell(10.7, 7.0, $service_sheet->time_sheet_initial_5, $border_on, 1, 'C');

			$this->SetFont('Helvetica', '', 9.0);
			$this->SetXY(111, 211);
			$this->Cell(64, 6, substr($service_sheet->service_call, 0, 33), $border_on, 0, 'L');
			$this->Cell(30, 6, substr($service_sheet->service_call_value, 0, 33), $border_on, 1, 'C');

			$this->SetX(111);
			$this->Cell(64, 6, substr($service_sheet->labour, 0, 33), $border_on, 0, 'L');
			$this->Cell(30, 6, substr($service_sheet->labour_value, 0, 33), $border_on, 1, 'C');

			$this->SetX(111);
			$this->Cell(64, 6, substr($service_sheet->materials, 0, 33), $border_on, 0, 'L');
			$this->Cell(30, 6, substr($service_sheet->materials_value, 0, 33), $border_on, 1, 'C');

			$this->SetX(111);
			$this->Cell(64, 6, substr($service_sheet->equipments, 0, 33), $border_on, 0, 'L');
			$this->Cell(30, 6, substr($service_sheet->equipments_value, 0, 33), $border_on, 1, 'C');

			$this->SetX(111);
			$this->Cell(64, 6, substr($service_sheet->as_per_quote, 0, 33), $border_on, 0, 'L');
			$this->Cell(30, 6, substr($service_sheet->as_per_quote_value, 0, 33), $border_on, 1, 'C');



			$this->SetX(175);
			$this->Cell(30, 6, $service_sheet->gst, $border_on, 1, 'C');

			$this->SetX(175);
			$this->Cell(30, 6, $service_sheet->total, $border_on, 0, 'C');

/*
			//Payment by Cash
			$this->Image('img/tick.png', 55.5, 248.5, 5);


			//Payment by Credit Account
			$this->Image('img/tick.png', 67.5, 248.5, 5);

			//Payment by Credit Card
			$this->Image('img/tick.png', 91.5, 248.5, 5);

			//Payment by Cheque
			$this->Image('img/tick.png', 110.3, 248.5, 5);

*/

	}
}
