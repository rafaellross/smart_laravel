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
        $this->SetTitle("Employee Application");
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

        
        $this->Text(19, 155, "PANTS SIZE: " . str_repeat(".", 30) . "SHIRT SIZE: " . str_repeat(".", 30));        
        $this->Text(45, 154, $application->pants_size);        
        $this->Text(95, 154, $application->shirt_size);        

        $this->Text(19, 160, "ROLE: " . str_repeat(".", 130));        

        $role = '';
        if($application->role == 'P') {

          $role = 'Plumber';

        } elseif ($application->role == 'A') {

          $role = 'Apprentice';

        } elseif ($application->role == 'L') {

          $role = 'Labourer';

        }


        
        $this->Text(35, 159, $role);        

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
              list($width, $height, $type, $attr) = getimagesize($license->image_back);
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

      $this->SetXY($nameX = 3.2, 89.5);
      //Write Given Names
      $given_names = str_split(strtoupper($application->given_names));
      foreach ($given_names as $char) {
        $this->SetXY($nameX+=5, 97);
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


      //To be completed by the Payer
      //Write ABN number
      $this->SetXY($nameX = 3.2, 135);
      $abn = str_split("69133559350");
      foreach ($abn as $key => $char) {
        if (in_array($key, [2, 5, 8])) {
          $nameX+=5;
        }
        $this->SetXY($nameX+=5, 182);
        $this->Write(0, $char);
      }


      //Write E-mail
      $this->SetXY($nameX = 106.8, 178);

      $email = str_split("admin@smartplumbingsolutions.com.au");
      foreach ($email as $key => $char) {

        if ($key == 19) {

          $nameX = 106.8;

        }
        if ($key >= 19) {

          $this->SetXY($nameX+=5, 187);

        } else {

          $this->SetXY($nameX+=5, 178);

        }

        $this->Write(0, $char);

      }


      //Write Legal Name
      $this->SetXY($nameX = 3.2, 207);

      $legal_name = str_split("SMART PLUMBING ADMIN SERVICES PTY LTD");
      foreach ($legal_name as $key => $char) {

        if ($key == 19) {

          $nameX = 3.2;

        }
        if ($key >= 19) {

          $this->SetXY($nameX+=5, 215.5);

        } else {

          $this->SetXY($nameX+=5, 207);

        }

        $this->Write(0, $char);

      }


      //Write Contact person
      $this->SetXY($nameX = 106.6, 200);

      $contact = str_split("MIRIANA");
      foreach ($contact as $key => $char) {

        $this->SetXY($nameX+=5, 200);
        $this->Write(0, $char);

      }


      //Write Phone Number
      $this->SetXY($nameX = 136.6, 208);

      $phone = str_split("0295691576");
      foreach ($phone as $key => $char) {

        $this->SetXY($nameX+=5, 208);
        $this->Write(0, $char);

      }


      //Write Business address
      $this->SetXY($nameX = 3.2, 207);

      $business_address = str_split("1/17 CHESTER STREET");
      foreach ($business_address as $key => $char) {

        $this->SetXY($nameX+=5, 236.4);
        $this->Write(0, $char);

      }

      //Write Business suburb
      $this->SetXY($nameX = 3.2, 247);

      $business_suburb = str_split("CAMPERDOWN");
      foreach ($business_suburb as $key => $char) {

        $this->SetXY($nameX+=5, 255);
        $this->Write(0, $char);

      }

      //Write Business state
      $this->SetXY($nameX = 3.3, 264);

      $business_state = str_split("NSW");
      foreach ($business_state as $key => $char) {

        $this->SetXY($nameX+=4.7, 264);
        $this->Write(0, $char);

      }

      //Write Business post code
      $this->SetXY($nameX+=11, 264);

      $business_state = str_split("2050");
      foreach ($business_state as $key => $char) {

        $this->SetXY($nameX+=5, 264);
        $this->Write(0, $char);

      }






    }

    public function apprentice_form(EmployeeApplication $application) {
        $this->AddPage();
        $this->Image('img/megt.png', 20,10,30,0,'png');
        $this->Image('img/aus-apprenticeship.png', 150,13,30,0,'png');
        $this->SetY(35);

        $line_height = 6;

        $this->SetFont('Helvetica', 'U', 18);
        $this->Cell(0,10, 'Apprenticeship/Traineeship Details',0,1,'C', 0);

        $this->SetFont('Helvetica', '', 12);
        $this->Cell(0,10, 'Traineeship/Apprenticeship qualification to be completed (i.e. Certificate III in Carpentry)',0,1,'C', 0);

        $this->Cell(47,10, 'QUALIFICATION NAME',0,0,'L', 0);
        $this->Cell(0,7, '', 'B',0,'L', 0);
        $this->Ln(20);

        $this->SetFillColor(108,117,125);
        $this->SetFont('Helvetica', 'B', 14);
        $this->Cell(0,$line_height, 'Apprentice/Trainee Details',1,1,'C', 1);
        $this->SetFont('Helvetica', '', 14);

        $this->Cell(65,$line_height, 'Full Legal Name:',1,0,'L', 0);
        $this->Cell(0,$line_height, strtoupper($application->first_name) . " " .  strtoupper($application->last_name),1,1,'L', 0);

        $this->Cell(65,$line_height, 'Date of Birth:',1,0,'L', 0);
        $this->Cell(0,$line_height, Carbon::parse($application->dob)->format('d/m/Y'),1,1,'L', 0);

        $this->Cell(65,$line_height, 'Start date at the business:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->date_commenced,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Address:',1,0,'L', 0);
        $this->Cell(0,$line_height, strtoupper($application->street_address) . " - " . strtoupper($application->suburb) . " - " . $application->post_code,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Phone:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->phone,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Mobile:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->mobile,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Email:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->email,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Full-time or Part time:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->paid_basis == "F" ? 'Full-time' : 'Part time' ,1,1,'L', 0);

        $this->Cell(65,$line_height, 'Hours per week:',1,0,'L', 0);
        $this->Cell(0,$line_height, $application->paid_basis == "F" ? '40' : '20',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Pay Award name:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);
        $this->Ln();

        $this->SetFont('Helvetica', 'B', 14);
        $this->Cell(0,$line_height, 'Employer Details',1,1,'C', 1);
        $this->SetFont('Helvetica', '', 14);

        $this->Cell(65,$line_height, 'ABN:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Entity/ Legal Name:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Trading Name:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, "Employer's Name:",1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Address:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'PO Address:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Phone:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Contact Person:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Email:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->Cell(65,$line_height, 'Mobile:',1,0,'L', 0);
        $this->Cell(0,$line_height, '',1,1,'L', 0);

        $this->MultiCell(65,$line_height, 'Registered training organisation preference',1, 'L');
        $this->SetXY($this->GetX()+65, $this->GetY() - 12.5);
        $this->Cell(0,12.5, '',1,1,'L', 0);

        $this->Ln(5);

        $this->SetFont('Helvetica', 'U', 14);
        $this->Cell(65,7, 'Office Use Only',0,1,'L', 0);

        $this->SetFont('Helvetica', '', 10);
        $this->Cell(31,5, 'RTO - NTIS Code:',0,0,'L', 0);
        $this->Cell(65,5, '', 'B',1,'L', 0);

        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(15,5, 'Campus',0,0,'L', 0);
        $this->Cell(75,5, '', 'B',0,'L', 0);
        $this->Cell(4,5, '', 0,0,'L', 0);//space
        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(15,5, 'work based',0,1,'L', 0);
        $this->Cell(46,5, 'Qualification National Code:',0,0,'L', 0);
        $this->Cell(75,5, '', 'B',0,'L', 0);

        $this->Cell(4,5, '', 0,0,'L', 0);//space
        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(15,5, 'on current RTO scope',0,1,'L', 0);

        $this->Cell(37,5, 'Sign up date and time:',0,0,'L', 0);
        $this->Cell(75,5, '', 'B',1,'L', 0);

        $this->Ln();
        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(25,5, 'TYIMS Check',0,0,'L', 0);

        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(25,5, 'IVETS Check',0,0,'L', 0);

        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(25,5, 'ABN Check',0,0,'L', 0);

        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(20,5, 'NTC',0,0,'L', 0);

        $this->Cell(6,5, '', 1,0,'L', 0);
        $this->Cell(25,5, 'Smart form',0,0,'L', 0);

        //$this->Image('img/logo.jpg', 150, 95, 40);
    }

}
