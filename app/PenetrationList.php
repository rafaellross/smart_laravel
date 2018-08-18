<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;


class PenetrationList extends Fpdf
{
    //
private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

  private $width = 150;
  private $height = 53.98;

  private $title = 'SERVICES PENETRATION FIRE SEAL';

  public $job;
  public $address;

  protected $y = 0;
  protected $rowHeight = 15;



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
      $this->Cell(265, 10,'PENETRATION INSPECTION',1,1,'C', true);
      $this->SetFont('Arial','B',12);
      $this->Cell(50, 5,'Project Name:',1,0,'C');
      $this->Cell($widthField, 5, $this->job,1,0,'L');

      $this->Cell($widthImage, 5, '','R',1,'L');

      $this->Cell(50, 5,'Contact:',1,0,'C');
      $this->Cell($widthField, 5, '',1,0,'L');
      $this->Cell($widthImage, 5, '','R',1,'L');


      $this->Cell(50, 5,'Phone:',1,0,'C');
      $this->Cell($widthField, 5, '',1,0,'L');
      $this->Cell($widthImage, 5, '','R',1,'L');

      $this->Cell(50, 5,'Address:',1,0,'C');
      $this->Cell($widthField, 5, $this->address,1,0,'L');
      $this->Cell($widthImage, 5, '','R',1,'L');

      $this->Cell(50, 5,'Class:',1,0,'C');
      $this->Cell($widthField, 5, '',1,0,'L');
      $this->Cell($widthImage, 5, '','R',1,'L');

      $this->Cell(50, 5,'Notes:',1,0,'C');
      $this->Cell($widthField, 5, '',1,0,'L');
      $this->Cell($widthImage, 5, '','R',1,'L');

      $this->Cell(50, 5,'Date:',1,0,'C');
      $this->Cell($widthField, 5, Carbon::now()->format('d/m/Y'),1,0,'L');
      $this->Cell($widthImage, 5, '','BR',1,'L');

      $this->Image('img/logo.jpg', 223, 23, 40);

      //$this->SetXY(60, 10);




      // Line break
      $this->Ln(7);



      $this->Cell(29 , 10, 'Reference', 'LTRB', 0, 'C', 1);
      $this->Cell(43 , 10, 'Drawing', 'LTRB', 0, 'C', 1);
      $this->Cell(40 , 10, 'Photo', 'LTRB', 0, 'C', 1);
      $this->Cell(35 , 10, 'FRL', 'LTRB', 0, 'C', 1);
      $this->Cell(42 , 10, 'Installed By', 'LTRB', 0, 'C', 1);
      $this->Cell(35 , 10, 'Installation Date', 'LTRB', 0, 'C', 1);
      $this->Cell(41 , 10, 'Manufacturer', 'LTRB', 0, 'C', 1);
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

  private function front($fire_identification, $ln = 0) {

    $this->SetFont('Arial','', 10);

    $this->Cell(29 , $this->rowHeight, $fire_identification->fire_seal_ref, 'LTRB', 0, 'C');
    $this->Cell(43, $this->rowHeight, $fire_identification->drawing, 'LTRB', 0, 'C');

    //Render Photo
		if (!is_null($fire_identification->fire_photo)) {

      list($width, $height, $type, $attr) = getimagesize($fire_identification->fire_photo);

      $this->Image($fire_identification->fire_photo, $this->GetX(), $this->GetY(), 40,15, str_replace("image/", "", image_type_to_mime_type($type)));




}

    $this->Cell(40, $this->rowHeight, '', 'LTRB', 0, 'C');




    $this->Cell(35 , $this->rowHeight, $fire_identification->fire_resist_level, 'LTRB', 0, 'C');
    $this->Cell(42 , $this->rowHeight, substr($fire_identification->install_by, 0, 24), 'LTRB', 0, 'C');
    $this->Cell(35 , $this->rowHeight, is_null($fire_identification->install_dt) ? '' : Carbon::parse($fire_identification->install_dt)->format('d/m/Y'), 'LTRB', 0, 'C');
    $this->Cell(41 , $this->rowHeight, substr($fire_identification->manufacturer, 0, 24), 'LTRB', 0, 'C');

    $this->Ln();

  }


  public function add($fire_identification)
  {
    //Render Front

    $this->front($fire_identification);



  }
}
