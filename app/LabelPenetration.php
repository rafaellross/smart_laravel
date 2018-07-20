<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Text;

class LabelPenetration extends Fpdf
{
    //
private $font = ["header" => 15, "label" => 10, "field" => 9, "values" => 7];

  private $width = 139;
  private $height = 103.1;

  private $title = 'SERVICES PENETRATION FIRE SEAL';

  
  protected $y = 0;
  
  
  protected $currentX = 4;
  protected $currentY = 0;

  public $labelNumber = 1;



  private function front($fire_identification, $ln = 0) {

    if($this->labelNumber == 0){

      $this->AddPage('L');
      
    }

    $rowBreak = 9;  
    
    
    $this->SetFont('Arial','B', $this->font["header"]);  
    
    $this->Text($this->currentX + 20, $this->currentY + 17, $this->title);
    $this->Text($this->currentX + 48, $this->currentY + 27, 'DO NOT DISTURB');

    $this->SetFont('Arial','B', $this->font["label"]);  
    $this->Text($this->currentX + 14, $this->currentY  + $rowBreak + 27, 'This fire seal is compliant with the requirements of: AS4072.1, AS1530.4');

    $this->SetFont('Arial','', $this->font["label"]);  
    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 37, 'Fire Seal Reference: ' . $fire_identification->fire_seal_ref);

    $this->Line($this->currentX + 6, $this->currentY+50, $this->currentX + $this->width, $this->currentY + 50);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 47, 'Fire Resistance Level (FRL): ' . $fire_identification->fire_resist_level);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 57, 'Installed By: ' . $fire_identification->install_by);

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 67, 'Installation Date: ' . Carbon::parse($fire_identification->install_dt)->format('d/m/Y'));

    $this->Text($this->currentX + 6, $this->currentY  + $rowBreak + 77, 'Manufacturer of Fire Stopping System: ' . $fire_identification->manufacturer);

    $this->SetFont('Arial','B', $this->font["values"]); 
    $this->Text($this->currentX + 14, $this->currentY + $rowBreak + 87, 'CONTACT THE INSTALLER IN THE EVENT OF DAMAGE OR IF REINSTATEMENT IS REQUIRED');

    $qr_code = new QR_Text(
      "{
          \"id\": $fire_identification->id, 
          \"project\": \"$fire_identification->description\", 
          \"fire_number\": \"$fire_identification->fire_number\", 
          \"fire_seal_ref\" :  \"$fire_identification->fire_seal_ref\", 
          \"fire_resist_level\" :  \"$fire_identification->fire_resist_level\", 
          \"manufacturer\" :  \"$fire_identification->manufacturer\"

      }");


  $qr_code->setMargin(0);
  $qr_code->setOutfile('tmp/qr_fire_' . $fire_identification->id .'.png')->png();

  $this->Image('tmp/qr_fire_' . $fire_identification->id .'.png', $this->currentX + 103, $this->currentY + 53, 30);
  $this->Text($this->currentX + 105, $this->currentY + 86,'Penetration Number: ' . $fire_identification->fire_number);
  

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
        $this->labelNumber = 0;
        
        break;

    }


    /*
    //Check if horizontal position is 2
    if($this->currentX == $this->width) {
      $this->currentY = $this->height;      
    }

    //
    if($this->currentX == 0) {
      $this->currentX = $this->width;
      
    }*/


    //$this->Cell($this->width , 10, 'Fire Seal Reference:' . $fire_identification->fire_seal_ref, 'BLR', 1, 'L');

    /*
    $this->Cell($this->width , 10, $this->title, 'LTR', 1, 'C');    
    $this->Text($this->startX, $this->startY, $this->title);

    $this->Cell($this->width , 10, 'DO NOT DISTURB', 'LR', 1, 'C');
    $this->SetFont('Arial','B', $this->font["label"]);  
    $this->Cell($this->width , 10, 'This fire seal is compliant with the requirements of: AS4072.1, AS1530.4', 'LR', 1, 'C');
    
    $this->SetFont('Arial','B', $this->font["label"]);  
    $this->Cell($this->width , 10, 'Fire Seal Reference:' . $fire_identification->fire_seal_ref, 'BLR', 1, 'L');
    $this->Cell($this->width , 10, 'Fire Resistance Level (FRL):' . $fire_identification->fire_resist_level, 'LR', 1, 'L');
    $this->Cell($this->width , 10, 'Installed By:' . $fire_identification->install_by, 'LR', 1, 'L');
    $this->Cell($this->width , 10, 'Installation Date:' . Carbon::parse($fire_identification->install_dt)->format('d/m/Y'), 'LR', 1, 'L');
    $this->Cell($this->width , 10, 'Manufacturer of Fire Stopping System:' . $fire_identification->manufacturer, 'LRB', 1, 'L');

    $qr_code = new QR_Text(
        "{
            \"id\": $fire_identification->id, 
            \"project\": \"$fire_identification->description\", 
            \"fire_number\": \"$fire_identification->fire_number\", 
            \"fire_seal_ref\" :  \"$fire_identification->fire_seal_ref\", 
            \"fire_resist_level\" :  \"$fire_identification->fire_resist_level\", 
            \"manufacturer\" :  \"$fire_identification->manufacturer\"

        }");


    $qr_code->setMargin(0);
    $qr_code->setOutfile('tmp/qr_fire_' . $fire_identification->id .'.png')->png();

    $this->Image('tmp/qr_fire_' . $fire_identification->id .'.png', 113, $this->y-37, 30);
    $this->Text(109, $this->y-3,'Penetration Number: ' . $fire_identification->fire_number);

    */

    

  }


  public function add($fire_identification)
  {
    //Render Front

    $this->front($fire_identification);
    

    $this->Ln(5);
  }
}
