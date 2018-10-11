<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Text;

class LabelTmvLog extends \TCPDI
{
    //
    private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

    private $width = 139;
    private $height = 103.1;

    protected $title = 'TMV Service Log';





  protected $currentX = 4;
  protected $currentY = 0;

  public $labelNumber = 1;



  private function front($tmv_identification, $ln = 0) {

    $rowBreak = 9;


    $this->SetFont('Helvetica','B', $this->font["header"]);

    $this->Text($this->currentX + 55, $this->currentY + 17, $this->title);



    $this->SetFont('Helvetica','', $this->font["label"]);
    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 37, 'Fire Seal Reference: ' . $tmv_identification->fire_seal_ref);

    $this->Line($this->currentX + 6, $this->currentY+50, $this->currentX + $this->width, $this->currentY + 50);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 47, 'Fire Resistance Level (FRL): ' . $tmv_identification->fire_resist_level);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 57, 'Installed By: ' . $tmv_identification->install_by);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 67, 'Installation Date: ' . Carbon::parse($tmv_identification->install_dt)->format('d/m/Y'));

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 77, 'Manufacturer of Fire Stopping System: ' . $tmv_identification->manufacturer);

    $this->SetFont('Helvetica','B', $this->font["values"]);
    $this->Text($this->currentX + 14, $this->currentY + $rowBreak + 87, 'CONTACT THE INSTALLER IN THE EVENT OF DAMAGE OR IF REINSTATEMENT IS REQUIRED');

    $qr_code = new QR_Text(
      "{
          \"id\": $tmv_identification->id,
          \"project\": \"$tmv_identification->description\",
          \"fire_number\": \"$tmv_identification->fire_number\",
          \"fire_seal_ref\" :  \"$tmv_identification->fire_seal_ref\",
          \"fire_resist_level\" :  \"$tmv_identification->fire_resist_level\",
          \"manufacturer\" :  \"$tmv_identification->manufacturer\"

      }");


  $qr_code->setMargin(0);
  $qr_code->setOutfile('tmp/qr_fire_' . $tmv_identification->id .'.png')->png();

  $this->Image('tmp/qr_fire_' . $tmv_identification->id .'.png', $this->currentX + 103, $this->currentY + 53, 30);
  $this->Text($this->currentX + 105, $this->currentY + 86,'Penetration Number: ' . $tmv_identification->fire_number);


    switch ($this->labelNumber) {
      case 1:
        $this->currentX = $this->width + 10;
        $this->labelNumber = 2;
        break;

      case 2:
        $this->currentX = 4;
        $this->currentY = $this->height;
        $this->labelNumber = 3;
        break;

      case 3:
        $this->currentX = $this->width + 10;
        $this->currentY = $this->height;
        $this->labelNumber = 4;
        break;

      case 4:
        $this->currentX = 4;
        $this->currentY = 0;
        $this->labelNumber = 1;
        $this->AddPage('L');

        break;

    }

  }


  public function add($tmv_identification)
  {
    //Render Front

    $this->front($tmv_identification);


    $this->Ln(5);
  }
}
