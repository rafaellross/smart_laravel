<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TmvLogReport extends \TCPDI {

  public function add(TmvLog $tmv)
  {
    $this->SetTitle("Annual TMV Service Log");
    // initiate FPDI
    // add a page
    $this->AddPage();
    // set the source file
    $this->setSourceFile('templates/annual_tmv_service_log.pdf');

    $tplIdx = $this->importPage(1);
    // use the imported page and place it at position 10,10 with a width of 100 mm
    $this->useTemplate($tplIdx, 0, 0, 210);
    $this->SetMargins(0, 0, 0);

    if ($tmv->type == 'A') {
      $this->Image('img/tick.png', 106,32,5,0,'png');
    } else {
      $this->Image('img/tick.png', 94.5,25.5,5,0,'png');
    }

    //header
    $this->SetFont('Helvetica', '', 10);
    $this->Text(25, 41, Carbon::parse($tmv->log_dt)->format('d/m/Y'));


    $this->Text(50, 48.5, $tmv->tmv->name_establishment);
    $this->Text(28, 56.5, $tmv->tmv->address);

    $this->Text(154, 56.5, $tmv->tmv->phone);

    $this->Text(37, 64.5, $tmv->tmv->room_number);

    $this->Text(77, 64.5, $tmv->tmv->location_number);

    $this->Text(102.5, 64.5, $tmv->tmv->location);


    $this->Text(37, 72.5, $tmv->tmv->type_valve);

    $this->Text(115, 72.5, $tmv->tmv->size);

    $this->Text(159, 72.5, $tmv->tmv->serial_number);

    if ($tmv->tmv->temp_range == 'C') {

      $this->Image('img/tick.png', 111,79,5,0,'png');

    } else {


      $this->Image('img/tick.png', 153.5,79,5,0,'png');
    }

    //Ticks

    if ($tmv->task_tk_1) {
      $this->Image('img/tick.png', 109.5,100,5,0,'png');
    }

    if ($tmv->task_tk_2) {
      $this->Image('img/tick.png', 109.5,110,5,0,'png');
    }

    if ($tmv->task_tk_3) {
      $this->Image('img/tick.png', 109.5,117.5,5,0,'png');
    }

    if ($tmv->task_tk_4) {
      $this->Image('img/tick.png', 109.5,125.5,5,0,'png');
    }

    if ($tmv->task_tk_5) {
      $this->Image('img/tick.png', 109.5,135.5,5,0,'png');
    }

    if ($tmv->task_tk_6) {
      $this->Image('img/tick.png', 109.5,146,5,0,'png');
    }

    if ($tmv->task_tk_7) {
      $this->Image('img/tick.png', 109.5,154,5,0,'png');
    }

    //Endorsed by 1
    $this->Text(62, 184.5, $tmv->endorsed_by1);

    //Endorsed by Position 1
    $this->Text(113, 184.5, $tmv->endorsed_position1);


    //Endorsed by Signature 1
    if (!is_null($tmv->endorsed1_sig)) {
      $this->Image($tmv->endorsed1_sig, 156,180,40,0,'png');
    }

    //Tests

    //Temp before test
    $this->Text(45, 201, $tmv->temp_bfr_test);

    //Temp reset temp
    $this->Text(100.5, 201, $tmv->temp_reset);
    $this->Text(50, 144.5, $tmv->temp_reset);

    //Thermal shutoff test
    if ($tmv->therm_shutoff) {
      $this->Image('img/tick.png', 162.5,200,5,0,'png');
    } else {
      $this->Image('img/tick.png', 178.5,200,5,0,'png');
    }


    //Serviceman 2
    $this->Text(35, 209.5, $tmv->serviceman2);

    //Endorsed by Position 1
    $this->Text(114, 209.5, $tmv->serviceman2_lic);


    //Endorsed by Signature 1
    if (!is_null($tmv->serviceman2_sig)) {
      $this->Image($tmv->serviceman2_sig, 148,205.3,40,0,'png');
    }


    //Endorsed by 2
    $this->Text(62, 225, $tmv->endorsed_by2);

    //Endorsed by Position 2
    $this->Text(113, 225, $tmv->endorsed_position2);


    //Endorsed by Signature 2
    if (!is_null($tmv->endorsed2_sig)) {
      $this->Image($tmv->endorsed2_sig, 156,221.5,40,0,'png');
    }

    $month = 12;//Carbon::parse($tmv->log_dt)->month;




    switch ($month) {
      case 1:
        $this->Image('img/tick.png', 44.5,239.5,5,0,'png');
        break;

      case 2:
        $this->Image('img/tick.png', 55.5,239.5,5,0,'png');
        break;

      case 3:
        $this->Image('img/tick.png', 66.5,239.5,5,0,'png');
        break;

      case 4:
        $this->Image('img/tick.png', 78,239.5,5,0,'png');
        break;

      case 5:
        $this->Image('img/tick.png', 89.5,239.5,5,0,'png');
        break;

      case 6:
        $this->Image('img/tick.png', 100.5,239.5,5,0,'png');
        break;

      case 7:
        $this->Image('img/tick.png', 111.5,239.5,5,0,'png');
        break;

      case 8:
        $this->Image('img/tick.png', 123.5,239.5,5,0,'png');
        break;

      case 9:
        $this->Image('img/tick.png', 134.5,239.5,5,0,'png');
        break;

      case 10:
        $this->Image('img/tick.png', 146.5,239.5,5,0,'png');
        break;

      case 11:
        $this->Image('img/tick.png', 157.5,239.5,5,0,'png');
        break;

      case 12:
        $this->Image('img/tick.png', 169,239.5,5,0,'png');
        break;
    }
  }


}
