<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Parameters;
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
				$this->SetXY($nameX+=5, 89.5+9.5 + 13.5 + 8.5);
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

    //Write Employee Signature
    if (!is_null($application->employee_signature)) {
      $this->Image($application->employee_signature, 113,129,40,0,'png');
    }


    //Employer section

    $parameters = Parameters::find($application->business);
    $nameX=3.2;
    if ($parameters) {
      //Write TFN number
  		$abn = str_split(strtoupper($parameters->abn));
  		foreach ($abn as $key => $char) {
  			if (in_array($key, [2, 5, 8])) {
  				$nameX+=5;
  			}
  			$this->SetXY($nameX+=5, 184);
  			$this->Write(0, $char);
  		}

      //Write Business Name
      $nameX=3.2;
      $nameY=209;
  		$business_name = str_split(strtoupper($parameters->business_name));
  		foreach ($business_name as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX = 3.2;
          $nameY += 8.5;
  			}
  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business Address
      $nameX=3.2;
      $nameY+=21;
  		$business_address = str_split(strtoupper($parameters->business_address));
  		foreach ($business_address as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX = 3.2;
          $nameY += 8.5;
  			}
  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business Suburb
      $nameX=3.2;
      $nameY+=18.5;
  		$business_suburb = str_split(strtoupper($parameters->business_suburb));
  		foreach ($business_suburb as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX = 3.2;
          $nameY += 8.5;
  			}
  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business State
      $nameX=3;
      $nameY+=9;
  		$business_state = str_split(strtoupper($parameters->business_state));
  		foreach ($business_state as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX = 3.2;
          $nameY += 8.5;
  			}
  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business Postcode
      $nameX=28.5;
  		$business_post_code = str_split(strtoupper($parameters->business_post_code));
  		foreach ($business_post_code as $key => $char) {
  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business E-mail
      $nameX=106.5;
      $nameY = 180.5;
  		$business_email = str_split(strtoupper($parameters->business_email));
  		foreach ($business_email as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX=106.7;
          $nameY += 8.5;
  			}

  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business Contact
      $nameX=106.7;
      $nameY += 13;
  		$business_contact = str_split(strtoupper($parameters->business_contact));
  		foreach ($business_contact as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX=106.7;
          $nameY += 8.5;
  			}

  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Business Phone Number
      $nameX=136.7;
      $nameY += 8.5;
  		$business_phone = str_split(strtoupper($parameters->business_phone));
  		foreach ($business_phone as $key => $char) {
        if (in_array($key, [19])) {
  				$nameX=106.7;
          $nameY += 8.5;
  			}

  			$this->SetXY($nameX+=5, $nameY);
  			$this->Write(0, $char);
  		}

      //Write Employer Signature
      if (!is_null($parameters->business_signature)) {
        $this->Image($parameters->business_signature, 113,233,40,0,'png');
      }

      //Write Business Date
  		$this->SetXY($nameX=156.3, 241);
  		$business_dt = str_split(Carbon::parse($application->business_dt)->format('dmY'));
  		foreach ($business_dt as $key => $char) {
  			if (in_array($key, [2, 4])) {
  				$nameX+=3.3;
  			}
  			$this->SetXY($nameX+=4.8, 241);
  			$this->Write(0, $char);
  		}


    }

		$this->Output();
    }
}
