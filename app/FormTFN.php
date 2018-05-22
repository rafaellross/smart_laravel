<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class FormTFN extends Fpdi
{
    public function add(EmployeeApplication $application)
    {
		// initiate FPDI

		// add a page
		$this->AddPage();
		// set the source file
		$this->setSourceFile('templates/tfn.pdf');
		// import page 1
		$tplIdx = $this->importPage(5);
		// use the imported page and place it at position 10,10 with a width of 100 mm
		$this->useTemplate($tplIdx, 0, 0, 210);

		// now write some text above the imported page
		$this->SetFont('Helvetica', '', 9);
		$this->SetMargins(0, 0, 0);
		$this->SetXY(40, 35);
		$nameX = 43.2;

    
    //Write TFN number
		$tax_file_number = str_split(strtoupper($application->tax_file_number));
		foreach ($tax_file_number as $key => $char) {
			if (in_array($key, [3, 6])) {
				$nameX+=5;
			}
			$this->SetXY($nameX+=5, 36);
			$this->Write(0, $char);
		}

    //Write Last Name
		$nameX = 3.2;
		$lastName = str_split(strtoupper($application->last_name));
		foreach ($lastName as $char) {
			$this->SetXY($nameX+=5, 80);
			$this->Write(0, $char);
		}

		$this->SetXY($nameX = 3.2, 89.5);

    //Write First Name
		$firstName = str_split(strtoupper($application->first_name));
		foreach ($firstName as $char) {
			$this->SetXY($nameX+=5, 89.5);
			$this->Write(0, $char);
		}

    //Write Street Address
		$this->SetXY($nameX = 3.2, 89.5+9.5);
		$street_address = str_split(strtoupper($application->street_address));
		foreach ($street_address as $key => $char) {
			if ($key == 19) {
				$nameX = 3.2;
			}
			if ($key > 18) {
				$this->SetXY($nameX+=5, 89.5+9.5 + 13.5  + 9.5);
			} else {
				$this->SetXY($nameX+=5, 89.5+9.5 + 13.5);
			}
			$this->Write(0, $char);
		}

		$this->SetXY($nameX = 3.2, 109.5);

    //Write Suburb
		$suburb = str_split(strtoupper($application->suburb));
		foreach ($suburb as $char) {
			$this->SetXY($nameX+=5, 129.5);
			$this->Write(0, $char);
		}

		$this->SetXY($nameX = 3.2, 139);

    //Write State
		$state = str_split(strtoupper(States::find($application->state)->code));
		foreach ($state as $char) {
			$this->SetXY($nameX+=4.9, 139);
			$this->Write(0, $char);
		}

    //Write post code
		$this->SetXY($nameX+=10.9, 139);
		$post_code = str_split(strtoupper($application->post_code));
		foreach ($post_code as $char) {
			$this->SetXY($nameX+=4.8, 139);
			$this->Write(0, $char);
		}

    //Write date of birth
		$this->SetXY($nameX+=108.5, 35);
		$dob = str_split(Carbon::parse($application->dob)->format('dmY'));
		foreach ($dob as $key => $char) {
			if (in_array($key, [2, 4])) {
				$nameX+=3.3;
			}
			$this->SetXY($nameX+=4.8, 35);
			$this->Write(0, $char);
		}

    //Write payment basis

    //Full-Time
    if ($application->paid_basis == "F") {
        $this->SetXY(125.7, 48);
        $this->Write(0, "X");
    }

    //Part-Time
    if ($application->paid_basis == "P") {
        $this->SetXY(145.3, 48);
        $this->Write(0, "X");
    }

    //Labour Hire
    if ($application->paid_basis == "L") {
        $this->SetXY(158.6, 48);
        $this->Write(0, "X");
    }

    if ($application->paid_basis == "S") {
        $this->SetXY(182.1, 48);
        $this->Write(0, "X");
    }

    if ($application->paid_basis == "C") {
        $this->SetXY(201.5, 48);
        $this->Write(0, "X");
    }

    //Tax Status
    if ($application->tax_status == 'R') {
        $this->SetXY(135.5, 62);
        $this->Write(0, "X");
    }

    if ($application->tax_status == 'F') {
        $this->SetXY(165.9, 62);
        $this->Write(0, "X");
    }

    if ($application->tax_status == 'H') {
        $this->SetXY(201.7, 62);
        $this->Write(0, "X");
    }

    //Tax-free threshold
    if ($application->claim_threshold) {
        $this->SetXY(116.7, 86);
        $this->Write(0, "X");
    } else {
      $this->SetXY(129.7, 86);
      $this->Write(0, "X");
    }

    //Educational Loan
    if ($application->educational_loan) {
        $this->SetXY(116.7, 103.5);
        $this->Write(0, "X");
    } else {
      $this->SetXY(201.8, 103.5);
      $this->Write(0, "X");
    }

    //Financial Supplement
    if ($application->financial_supplement) {
        $this->SetXY(116.7, 115.5);
        $this->Write(0, "X");
    } else {
      $this->SetXY(201.8, 115.5);
      $this->Write(0, "X");
    }

    //Write date of form
		$this->SetXY($nameX=156.2, 137);
		$form_dt = str_split(Carbon::parse($application->form_dt)->format('dmY'));
		foreach ($form_dt as $key => $char) {
			if (in_array($key, [2, 4])) {
				$nameX+=3.5;
			}
			$this->SetXY($nameX+=4.8, 137);
			$this->Write(0, $char);
		}

    if (!is_null($application->employee_signature)) {
      $this->Image($application->employee_signature, 113,129,40,0,'png');
    }


		$this->Output();
    }
}
