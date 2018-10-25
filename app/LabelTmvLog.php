<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Url;

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





    $this->SetFont('Helvetica','B', 12);


    $qr_code = new QR_Url("smartplumbingsolutions.com.au/administration/tmv_log/" . $tmv_identification->id);


  $qr_code->setMargin(0);
  $qr_code->setOutfile('tmp/qr_fire_' . $tmv_identification->id .'.png')->png();

  $this->Image('tmp/qr_fire_' . $tmv_identification->id .'.png', $this->currentX + 63, $this->currentY + 43, 30);
  $this->Image('img/logo.jpg', $this->currentX + 103, $this->currentY + 13, 30);
  $this->Text($this->currentX + 60, $this->currentY + 76,'TMV Number: ' . $tmv_identification->id);
  $this->Line($this->currentX + 6, $this->currentY+92, $this->currentX + $this->width, $this->currentY + 92);

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
