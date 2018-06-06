<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmployeeApplicationForm extends Fpdi
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
		$this->SetFont('Helvetica', '', 12);
		$this->SetMargins(0, 0, 0);
		$this->SetXY(40, 35);
		$nameX = 43.2;
    $this->Text(33, 65, strtoupper($application->first_name) . " " .  strtoupper($application->last_name));
    $this->Text(175, 65, Carbon::parse($application->dob)->format('d/m/Y'));
    $this->Text(39, 71, strtoupper($application->street_address) . " - " . strtoupper($application->suburb));
    $this->Text(175, 77.5, $application->post_code);
    $this->Text(35, 84, $application->phone);
    $this->Text(163, 84, $application->mobile);
    $this->Text(51, 90, $application->email);

    $this->Text(53, 102.5, $application->tax_file_number);

    $this->Text(175, 65, Carbon::parse($application->dob)->format('d/m/Y'));

    $this->Text(85, 121, $application->date_commenced);
    $this->Text(55, 127, strtoupper($application->bank_acc_name));
    $this->Text(128, 127, $application->bsb);
    $this->Text(173, 127, $application->account_number);
    $this->Text(71, 133.5, $application->superannuation);
    $this->Text(63, 139.5, $application->redundancy);
    $this->Text(57, 145.5, $application->long_service_number);

    $this->SetDrawColor(255, 0, 0);
    if ($application->apprentice) {
      $this->Rect(68, 149.5, 7, 4);
      $this->Text(83, 152, "Year: " . $application->apprentice_year);
    } else {
      $this->Rect(76, 149.5, 5.5, 4);
    }

    $this->Text(53, 170.5, strtoupper($application->first_name) . " " .  strtoupper($application->last_name));

    if (!is_null($application->employee_signature)) {
      $this->Image($application->employee_signature, 128,165,40,0,'png');
    }
    $this->Text(173, 170.5, Carbon::parse($application->form_dt)->format('d/m/Y'));

    $this->Text(20, 180.5, "Licenses / Documents:");

    $startY_lic = 180.5;
    foreach ($application->licenses as $license) {
      $this->Text(20, $startY_lic += 8, $license->license->description);
      $this->Text(20, $startY_lic += 5, "Issuer: " . $license->issuer);
      $this->Text(20, $startY_lic += 5, "Number: " . $license->number);


    }

    foreach ($application->licenses as $license) {
      if (!is_null($license->image_front)) {
      list($width, $height, $type, $attr) = getimagesize($license->image_front);
      if ($width > $height) {
        $this->AddPage('L');
      } else {
        $this->AddPage('P');
      }
      $this->Text(10, 10, $license->license->description);
      $this->Text(10, 15, "Issuer: " . $license->issuer);
      $this->Text(10, 20, "Number: " . $license->number);
      $this->Text(10, 25, "Side: Front");

      $this->Image($license->image_front, 15,25, min($this->GetPageWidth()-70, $width-70),0, str_replace("image/", "", image_type_to_mime_type($type)));

      }

      if (!is_null($license->image_front)) {
      list($width, $height, $type, $attr) = getimagesize($license->image_back);
      if ($width > $height) {
        $this->AddPage('L');
      } else {
        $this->AddPage('P');
      }
      $this->Text(10, 10, "Type: " . $license->license->description);
      $this->Text(10, 15, "Issuer: " . $license->issuer);
      $this->Text(10, 20, "Number: " . $license->number);
      $this->Text(10, 25, "Side: Back");



      $this->Image($license->image_back, 15,25, min($this->GetPageWidth()-70, $width-70),0, str_replace("image/", "", image_type_to_mime_type($type)));

      }

    }
    }

}
