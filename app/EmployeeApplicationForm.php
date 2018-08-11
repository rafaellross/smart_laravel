<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;

class EmployeeApplicationForm extends \TCPDI
{
    public function add(EmployeeApplication $application)
    {
    		// initiate FPDI
    		// add a page
    		$this->AddPage();
    		// set the source file
    		$this->setSourceFile('templates/employee_application.pdf');
    		// import page 1
    		$tplIdx = $this->importPage(1);
    		// use the imported page and place it at position 10,10 with a width of 100 mm
    		$this->useTemplate($tplIdx, 0, 0, 210);

    		// now write some text above the imported page
    		$this->SetFont('Helvetica', '', 10);
    		$this->SetMargins(0, 0, 0);
    		$this->SetXY(40, 35);
    		$nameX = 43.2;
        $this->Text(32, 62, strtoupper($application->first_name) . " " .  strtoupper($application->last_name));
        $this->Text(172, 62.3, Carbon::parse($application->dob)->format('d/m/Y'));
        $this->Text(39, 68, strtoupper($application->street_address) . " - " . strtoupper($application->suburb));
        $this->Text(169, 74.7, $application->post_code);
        $this->Text(35, 80, $application->phone);
        $this->Text(161, 80.8, $application->mobile);
        $this->Text(50, 87, $application->email);

        $this->Text(53, 98.9, $application->tax_file_number);

        //Emergency contactDetails
        $this->Text(62, 111.8, $application->emergency_name);
        $this->Text(160, 111.8, $application->emergency_phone);




        $this->Text(85, 117, $application->date_commenced);

        //Bank details

        $this->Text(49, 123.5, strtoupper($application->bank_acc_name));
        $this->Text(128, 123, $application->bsb);
        $this->Text(173, 123.3, $application->account_number);
        $this->Text(70, 130, $application->superannuation);
        $this->Text(63, 135.5, $application->redundancy);
        $this->Text(57, 141.5, $application->long_service_number);

        $this->SetDrawColor(255, 0, 0);
        if ($application->apprentice) {
          $this->Rect(68, 149.5, 7, 4);
          $this->Text(83, 148, "Year: " . $application->apprentice_year);
        } else {
          $this->Rect(76, 149.5, 5.5, 4);
        }

        $this->Text(51, 167.4, strtoupper($application->first_name) . " " .  strtoupper($application->last_name));

        if (!is_null($application->employee_signature)) {
          $this->Image($application->employee_signature, 128,161,40,0,'png');
        }
        $this->Text(170, 167.4, Carbon::parse($application->form_dt)->format('d/m/Y'));
        $this->SetDrawColor(0, 0, 0);


    }//End

    public function add_licences(EmployeeApplication $application) {
      $startY_lic = 20.5;



      foreach ($application->licenses as $license) {

        try {
            $this->SetMargins(10, 10, 10);

            $this->AddPage('P');




              $this->SetFont('Helvetica', 'B', 12);
              $this->SetFillColor(108,117,125);
              $this->SetTextColor(255,255,255);
              $this->Cell(0,10, $license->license->description,1,1,'C', 1);
              $this->SetTextColor(0,0,0);
              $this->Cell(60,10, "Issue Date:", 'L',0,'L');
              $this->Cell(60,10, "State / Issuer *:", 0,0,'L');
              $this->Cell(70,10, "Card / Licence No *:", 'R',1,'L');

              $this->SetFont('Helvetica', '', 12);
              $this->Cell(60,10, Carbon::parse($license->issue_date)->format('d/m/Y'), 'LB',0,'L');
              $this->Cell(60,10, $license->issuer,'B',0,'L');
              $this->Cell(70,10, $license->number, 'RB',1,'L');

              //Photos
              $this->Ln();
              $this->SetFillColor(108,117,125);
              $this->SetTextColor(255,255,255);
              $this->Cell(0,10, 'Photos',1,1,'C', 1);
              $this->SetTextColor(0,0,0);
              $this->Cell(0,10, "Front", 'LRB',1,'C');
              $this->Cell(0,95, "", 'LRB',1,'L');
              $this->Cell(0,10, "Back", 'LRB',1,'C');
              $this->Cell(0,95, "", 'LRB',0,'L');


              //Picture Front
              list($width, $height, $type, $attr) = getimagesize($license->image_front);
              $this->Image($license->image_front, 15,75, $this->GetPageWidth()-125,0, str_replace("image/", "", image_type_to_mime_type($type)));

              //Picture Back
              list($width, $height, $type, $attr) = getimagesize($license->image_front);
              $this->Image($license->image_back, 15,178, $this->GetPageWidth()-125,0, str_replace("image/", "", image_type_to_mime_type($type)));



        } catch (\Exception $e) {
            //$this->Text(10, 30, "No Photos");
        }

      }
    }


    public function add_policy(EmployeeApplication $application) {

      $this->AddPage();
      // set the source file
      $this->setSourceFile('templates/policy_procedures.pdf');
      $tplIdx = $this->importPage(1);
      // use the imported page and place it at position 10,10 with a width of 100 mm
      $this->useTemplate($tplIdx, 0, 0, 210);

      $this->AddPage();
      $tplIdx = $this->importPage(2);
      // use the imported page and place it at position 10,10 with a width of 100 mm

      $this->useTemplate($tplIdx, 0, 0, 210);
      if (!is_null($application->employee_signature)) {
        $this->Image($application->employee_signature, 65,216,40,0,'png');
      }
      $this->SetFont('Helvetica', 'I', 10);
      $this->Text(22, 209.2, strtoupper($application->first_name) . " " .  strtoupper($application->last_name));

      $this->SetFont('Helvetica', '', 12);
      $this->Text(140, 219.5, Carbon::parse($application->form_dt)->format('d/m/Y'));
    }

    public function add_tfn(EmployeeApplication $application) {
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

  		$nameX = 43.2;


      //Write TFN number
  		$tax_file_number = str_split(strtoupper($application->tax_file_number));
  		foreach ($tax_file_number as $key => $char) {
  			if (in_array($key, [3, 6])) {
  				$nameX+=5;
  			}
  			$this->SetXY($nameX+=5, 34);
  			$this->Write(0, $char);
  		}

      //Write title

      if ($application->gender == 'M') {
        $this->Text(53.3, 68.5, "X");
      }

      //Write Last Name
  		$nameX = 3.2;
  		$lastName = str_split(strtoupper($application->last_name));
  		foreach ($lastName as $char) {
  			$this->SetXY($nameX+=5, 78);
  			$this->Write(0, $char);
  		}

  		$this->SetXY($nameX = 3.2, 89.5);

      //Write First Name
  		$firstName = str_split(strtoupper($application->first_name));
  		foreach ($firstName as $char) {
  			$this->SetXY($nameX+=5, 87.5);
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
  				$this->SetXY($nameX+=5, 89.5+9.5 + 13.5  + 6.5);
  			} else {
  				$this->SetXY($nameX+=5, 89.5+9.5 + 11.5);
  			}
  			$this->Write(0, $char);
  		}

  		$this->SetXY($nameX = 3.2, 109.5);

      //Write Suburb
  		$suburb = str_split(strtoupper($application->suburb));
  		foreach ($suburb as $char) {
  			$this->SetXY($nameX+=5, 128);
  			$this->Write(0, $char);
  		}

  		$this->SetXY($nameX = 3.2, 139);

      //Write State
  		$state = str_split(strtoupper(States::find($application->state)->code));
  		foreach ($state as $char) {
  			$this->SetXY($nameX+=4.9, 137);
  			$this->Write(0, $char);
  		}

      //Write post code
  		$this->SetXY($nameX+=10.99, 137);
  		$post_code = str_split(strtoupper($application->post_code));
  		foreach ($post_code as $char) {
  			$this->SetXY($nameX+=4.8, 137);
  			$this->Write(0, $char);
  		}

      //Write date of birth
  		$this->SetXY($nameX+=108.2, 33);
  		$dob = str_split(Carbon::parse($application->dob)->format('dmY'));
  		foreach ($dob as $key => $char) {
  			if (in_array($key, [2, 4])) {
  				$nameX+=3.3;
  			}
  			$this->SetXY($nameX+=4.8, 33);
  			$this->Write(0, $char);
  		}

      //Write payment basis

      //Full-Time
      if ($application->paid_basis == "F") {
          $this->SetXY(125.7, 46);
          $this->Write(0, "X");
      }

      //Part-Time
      if ($application->paid_basis == "P") {
          $this->SetXY(145.3, 46);
          $this->Write(0, "X");
      }

      //Labour Hire
      if ($application->paid_basis == "L") {
          $this->SetXY(158.6, 46);
          $this->Write(0, "X");
      }

      if ($application->paid_basis == "S") {
          $this->SetXY(182.1, 46);
          $this->Write(0, "X");
      }

      if ($application->paid_basis == "C") {
          $this->SetXY(201.5, 46);
          $this->Write(0, "X");
      }

      //Tax Status
      if ($application->tax_status == 'R') {
          $this->SetXY(135.5, 60);
          $this->Write(0, "X");
      }

      if ($application->tax_status == 'F') {
          $this->SetXY(165.9, 60);
          $this->Write(0, "X");
      }

      if ($application->tax_status == 'H') {
          $this->SetXY(201.7, 60);
          $this->Write(0, "X");
      }

      //Tax-free threshold
      if ($application->claim_threshold) {
          $this->SetXY(116.7, 84);
          $this->Write(0, "X");
      } else {
        $this->SetXY(129.7, 84);
        $this->Write(0, "X");
      }

      //Educational Loan
      if ($application->educational_loan) {
          $this->SetXY(116.7, 102);
          $this->Write(0, "X");
      } else {
        $this->SetXY(201.8, 102);
        $this->Write(0, "X");
      }

      //Financial Supplement
      if ($application->financial_supplement) {
          $this->SetXY(116.7, 114);
          $this->Write(0, "X");
      } else {
        $this->SetXY(201.8, 114);
        $this->Write(0, "X");
      }

      //Write date of form
  		$this->SetXY($nameX=156.2, 135);
  		$form_dt = str_split(Carbon::parse($application->form_dt)->format('dmY'));
  		foreach ($form_dt as $key => $char) {
  			if (in_array($key, [2, 4])) {
  				$nameX+=3.5;
  			}
  			$this->SetXY($nameX+=4.8, 135);
  			$this->Write(0, $char);
  		}

      if (!is_null($application->employee_signature)) {
        $this->Image($application->employee_signature, 113,129,40,0,'png');
      }

    }

}
