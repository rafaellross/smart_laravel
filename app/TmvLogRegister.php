<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class TmvLogRegister extends Fpdf
{
    //
private $font = ["header" => 15, "label" => 7, "field" => 9, "values" => 7];

  private $width = 150;
  private $height = 53.98;

  private $title = 'Annual TMV Service Log - Register';

  public $job;
  public $address;
  public $phone;

  protected $y = 0;
  protected $rowHeight = 20;



  function Header()
  {
      ini_set("memory_limit","-1");
      // Select Arial bold 15
      $this->SetFont('Arial','B',14);
      // Move to the right
      $this->SetFillColor(255,154,0);
      // Framed title

      $widthField   = 150;
      $widthImage   = 65;
      $this->Cell(265, 10,'Annual TMV Service Log',1,1,'C', true);
      $this->SetFont('Arial','B',11);
      $this->Cell(50, 5,'Name of Establishment:',1,0,'C');
      $this->Cell($widthField, 5, $this->job,1,0,'L');

      $this->Cell($widthImage, 5, '','R',1,'L');






      $this->Cell(50, 6,'Phone:',1,0,'C');
      $this->Cell($widthField, 6, $this->phone,1,0,'L');
      $this->Cell($widthImage, 6, '','R',1,'L');

      $this->Cell(50, 6,'Address:',1,0,'C');
      $this->Cell($widthField, 6, $this->address,1,0,'L');
      $this->Cell($widthImage, 6, '','RB',1,'L');



      $this->Image('img/logo.jpg', 234, 22, 20);





      // Line break
      $this->Ln(1);

      $this->SetFont('Arial','',8);

      $this->Cell(18 , 41, 'Test Date', 'LTRB', 0, 'C', 1);
      $this->Cell(13 , 41, 'TMV ID', 'LTRB', 0, 'C', 1);
      $this->Cell(35 , 41, 'Location', 'LTRB', 0, 'C', 1);
      $this->Cell(20 , 41, 'Type of Valve', 'LTRB', 0, 'C', 1);
      $this->Cell(15 , 41, 'Size', 'LTRB', 0, 'C', 1);
      $this->Cell(22 , 41, 'Serial Number', 'LTRB', 0, 'C', 1);
      $this->Cell(12 , 41, '', 'LTRB', 0, 'C', 1);
      $this->SetFont('Arial','I',7);

      //Vertical columns

      $this->TextWithRotation($this->GetX()-8, 77,'Replace all O-ring seals. Lubricate', 90);
      $this->TextWithRotation($this->GetX()-5, 77,'rings, seals & threads with High', 90);
      $this->TextWithRotation($this->GetX()-2, 77,'Temperature Silicone Grease.', 90);


      $this->Cell(13 , 41, '', 'LTRB', 0, 'C', 1);
      $this->TextWithRotation($this->GetX()-7, 77,'Remove, inspect & clean or', 90);
      $this->TextWithRotation($this->GetX()-4, 77,'replace in line filters.', 90);

      $this->Cell(10 , 41, '', 'LTRB', 0, 'C', 1);
      $this->TextWithRotation($this->GetX()-4, 77,'Flush out valve body & fittings', 90);

      $this->Cell(10 , 41, '', 'LTRB', 0, 'C', 1);
      $this->TextWithRotation($this->GetX()-4, 77,'Reassemble valve & install.', 90);

      $this->Cell(10 , 41, '', 'LTRB', 0, 'C', 1);
      $this->TextWithRotation($this->GetX()-6, 77,'Check temperature range / reset', 90);
      $this->TextWithRotation($this->GetX()-3, 77,'as per commissioning instructions.', 90);


      $this->SetFont('Arial','I',7);
      $this->Cell(8 , 41, '', 'LTRB', 0, 'C', 1);
      $this->TextWithRotation($this->GetX()-3, 77,'Carry ou thermal shutdown test.', 90);

      $this->SetFont('Arial','', 8);
      $curr_x = $this->GetX();
      $curr_y = $this->GetY();
      $this->Cell(60, 20, 'Thermal Shut Off Test', 'LTRB', 1, 'C', 1);
      $this->SetX($curr_x);
      $this->Cell(20, 21, 'Temp Before', 'LTRB', 0, 'C', 1);
      $this->Cell(20, 21, 'Reset Temp', 'LTRB', 0, 'C', 1);
      $this->Cell(12, 21, 'Result', 'LTRB', 0, 'C', 1);
      $curr_x = $this->GetX();
      $this->SetXY($curr_x, $curr_y);
      $this->Cell(27, 41, 'Photo', 'LTRB', 0, 'C', 1);

      $this->Ln();
  }

  var $angle=0;
  function Rotate($angle,$x=-1,$y=-1)
  {
    if($x==-1)
      $x=$this->x;
    if($y==-1)
      $y=$this->y;
    if($this->angle!=0)
      $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
      $angle*=M_PI/180;
      $c=cos($angle);
      $s=sin($angle);
      $cx=$x*$this->k;
      $cy=($this->h-$y)*$this->k;
      $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
  }

  function RotatedImage($file,$x,$y,$w,$h,$angle, $type)
  {
      //Image rotated around its upper-left corner
      $this->Rotate($angle,$x,$y);
      $this->Image($file,$x,$y,$w,$h,$type);
      $this->Rotate(0);
  }

  private function front($tmv_log, $ln = 0) {

    $this->SetFont('Arial','', 8);

    $this->Cell(18, $this->rowHeight, Carbon::parse($tmv_log->log_dt)->format('d/m/Y'), 'LTRB', 0, 'C');
    $this->Cell(13, $this->rowHeight, $tmv_log->id, 'LTRB', 0, 'C');
    $curr_x = $this->GetX();
    $curr_y = $this->GetY();

    $this->MultiCell(35, strlen($tmv_log->tmv->location) < 24 ? $this->rowHeight : 7.0  , substr ( $tmv_log->tmv->location, 0, min(strlen($tmv_log->tmv->location), 24*4)), 'RL', 'C');

    $this->Line($curr_x + 0, $curr_y+$this->rowHeight, $curr_x + 35, $curr_y+$this->rowHeight);
    $this->SetXY($curr_x+35, $curr_y);


    $this->Cell(20, $this->rowHeight, $tmv_log->tmv->type_valve, 'LTRB', 0, 'C');
    $this->Cell(15, $this->rowHeight, $tmv_log->tmv->size, 'LTRB', 0, 'C');
    $this->Cell(22, $this->rowHeight, $tmv_log->tmv->serial_number, 'LTRB', 0, 'C');

    $this->Cell(12, $this->rowHeight, '', 'LTRB', 0, 'C');
    if ($tmv_log->task_tk_1) {
      $this->Image('img/tick.png', $this->GetX()-7.5, $this->GetY()+5,5,0,'png');
    }



    $this->Cell(13, $this->rowHeight, '', 'LTRB', 0, 'C');

    if ($tmv_log->task_tk_2) {
      $this->Image('img/tick.png', $this->GetX()-8.5, $this->GetY()+5,5,0,'png');
    }

    $this->Cell(10, $this->rowHeight, '', 'LTRB', 0, 'C');
    if ($tmv_log->task_tk_3) {
      $this->Image('img/tick.png', $this->GetX()-7, $this->GetY()+5,5,0,'png');
    }



    $this->Cell(10, $this->rowHeight, '', 'LTRB', 0, 'C');
    if ($tmv_log->task_tk_4) {
      $this->Image('img/tick.png', $this->GetX()-7, $this->GetY()+5,5,0,'png');
    }

    $this->Cell(10, $this->rowHeight, '', 'LTRB', 0, 'C');
    if ($tmv_log->task_tk_5) {
      $this->Image('img/tick.png', $this->GetX()-7, $this->GetY()+5,5,0,'png');
    }

    $this->Cell(8, $this->rowHeight, '', 'LTRB', 0, 'C');
    if ($tmv_log->task_tk_7) {
      $this->Image('img/tick.png', $this->GetX()-6, $this->GetY()+5,5,0,'png');
    }


    //Thermal Shut Off Test
    $this->Cell(20, $this->rowHeight, $tmv_log->temp_bfr_test, 'LTRB', 0, 'C', 0);
    $this->Cell(20, $this->rowHeight, $tmv_log->temp_reset, 'LTRB', 0, 'C', 0);
    $this->Cell(12, $this->rowHeight, '', 'LTRB', 0, 'C', 0);
    if ($tmv_log->therm_shutoff) {
      $this->Image('img/tick.png', $this->GetX()-8, $this->GetY()+5,5,0,'png');
    } else if (!$tmv_log->therm_shutoff) {
      $this->Image('img/fail.png', $this->GetX()-8, $this->GetY()+5,5,0,'png');
    }

    $this->Cell(27, $this->rowHeight, '', 'LTRB', 0, 'C', 0);

    //Render Photo
		if (!is_null($tmv_log->photo)) {

      list($width, $height, $type, $attr) = getimagesize($tmv_log->photo);
      //dd($this->createImageFromBase64($tmv_log->fire_photo));
      $this->Image($this->createImageFromBase64($tmv_log->photo, $tmv_log->id), $this->GetX()-26, $this->GetY()+3, 25,15, str_replace("image/", "", image_type_to_mime_type($type)));

    }







    $this->Ln();

  }


  public function add($tmv_log)
  {
    //Render Front


    $this->front($tmv_log);

  }

  public function createImageFromBase64($data, $path = ""){
     $file_data = $data;
     $file_name = $path . time().'.png'; //generating unique file name;
     @list($type, $file_data) = explode(';', $file_data);
     @list(, $file_data) = explode(',', $file_data);
     if($file_data!=""){ // storing image in storage/app/public Folder
            \Storage::disk('public')->put($file_name,base64_decode($file_data));
      }
      return \Storage::disk('public')->path($file_name);
      //return 'storage/app/public/'.$file_name;
  }

  function TextWithDirection($x, $y, $txt, $direction='R')
  {
      if ($direction=='R')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='L')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='U')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='D')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      else
          $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      if ($this->ColorFlag)
          $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
  }

  function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
  {
      $font_angle+=90+$txt_angle;
      $txt_angle*=M_PI/180;
      $font_angle*=M_PI/180;

      $txt_dx=cos($txt_angle);
      $txt_dy=sin($txt_angle);
      $font_dx=cos($font_angle);
      $font_dy=sin($font_angle);

      $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      if ($this->ColorFlag)
          $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
  }

}
