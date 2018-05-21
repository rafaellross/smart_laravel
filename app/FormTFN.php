<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;

class FormTFN extends Fpdi
{
    public function add(EmployeeApplicaton $application)
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
		
		$nameX = 3.2;
		$lastName = str_split(strtoupper($application->last_name));
		foreach ($lastName as $char) {
			$this->SetXY($nameX+=5, 80);
			$this->Write(0, $char);
		}
		
		$this->SetXY($nameX = 3.2, 89.5);

		$firstName = str_split(strtoupper($application->first_name));
		foreach ($firstName as $char) {
			$this->SetXY($nameX+=5, 89.5);
			$this->Write(0, $char);
		}

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

		$suburb = str_split(strtoupper($application->suburb));
		foreach ($suburb as $char) {
			$this->SetXY($nameX+=5, 129.5);
			$this->Write(0, $char);
		}

		$this->SetXY($nameX = 3.2, 139.5);

		$state = str_split(strtoupper(States::find($application->state)->description));
		foreach ($state as $char) {
			$this->SetXY($nameX+=5, 139.5);
			$this->Write(0, $char);
		}




		


		$this->Output();    	
    }
}
