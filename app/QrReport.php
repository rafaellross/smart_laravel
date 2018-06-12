<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Url;
use App;
/**
* This class is used to convert time
*/
class QrReport extends Fpdf
{
  public function add(QAUser $qa)
  {
    $this->AddPage();
    $this->SetTitle("QA QR Codes");
    $this->SetFont('Arial','',10);

    $url = new QR_Url(url('/qa_users/' . $qa->id .'/edit'));
    $url->setOutfile('tmp/qr.png')->png();

    $this->Image('tmp/qr.png', ($this->GetPageWidth()/2)-50, 95, 100, 'png');
    //dd(get_class_methods($url));


    //dd($qr = QRCode::url('http://google.com')->png());


    $this->Image('img/logo.jpg', 150, 10, 40, 'jpg');

  }
}
