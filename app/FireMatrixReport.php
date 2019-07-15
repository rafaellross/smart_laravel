<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class FireMatrixReport extends Fpdf
{
    //
private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

  private $width = 150;
  private $height = 53.98;

  private $title = 'FIRE MATRIX';

  public $job;
  public $address;

  protected $y = 0;
  protected $rowHeight = 15;



  function Header()
  {
      ini_set("memory_limit","-1");
      // Select Arial bold 15
      $this->SetFont('Arial','B', 8);
      
      $this->Image('img/logo.jpg', 385, 6, 25);

      $this->Ln(20);

      $col_width = [
          16, 
          27, 
          20, 
          25, 
          40, 
          30,
          37,
          36,
          27,
          50,
          50,
          40
        ];

      $this->SetWidths($col_width);
      $aligns = [
          'C',
          'C',
          'C',
          'C',
          'C',                                    
          'C',                                              
          'C',
          'C',
          'C',
          'C',                                    
          'C',                                              
          'C',                                              
          'C',                                                                  
      ];
      $this->SetAligns($aligns);
      $columns = [
        'Reference', 
        'Service Type', 
        'Wall or Slab Type', 
        'Wall or Slab Type Reference', 
        'Fire Stopping System', 
        'Test Report Reference',
        'Test Specimen',
        'FRL Achieved',
        'Date of Test Report',
        'Comments',
        'Picture',
        'Approval Status'
      ];

      $this->Row($columns);           
      
  }

  public function add($rows)
  {
    //Render Front

    $this->front($fire_identification);

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
  }


  function SetWidths($w)
  {
      //Set the array of column widths
      $this->widths=$w;
  }
  
  function SetAligns($a)
  {
      //Set the array of column alignments
      $this->aligns=$a;
  }
  
  function Row($data)
  {
      //Calculate the height of the row
      $nb=0;
      for($i=0;$i<count($data);$i++)
          $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
      $h=5*$nb;
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for($i=0;$i<count($data);$i++)
      {
          $w=$this->widths[$i];
          $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
          //Save the current position
          $x=$this->GetX();
          $y=$this->GetY();
          //Draw the border
          $this->Rect($x,$y,$w,$h);
          //Print the text
          $this->MultiCell($w,5,$data[$i],0,$a);
          //Put the position to the right of the cell
          $this->SetXY($x+$w,$y);
      }
      //Go to the next line
      $this->Ln($h);
  }
  
  function CheckPageBreak($h)
  {
      //If the height h would cause an overflow, add a new page immediately
      if($this->GetY()+$h>$this->PageBreakTrigger)
          $this->AddPage($this->CurOrientation);
  }
  
  function NbLines($w,$txt)
  {
      //Computes the number of lines a MultiCell of width w will take
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
          $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
          $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
          $c=$s[$i];
          if($c=="\n")
          {
              $i++;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
              continue;
          }
          if($c==' ')
              $sep=$i;
          $l+=$cw[$c];
          if($l>$wmax)
          {
              if($sep==-1)
              {
                  if($i==$j)
                      $i++;
              }
              else
                  $i=$sep+1;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
          }
          else
              $i++;
      }
      return $nl;
  }
  


}
