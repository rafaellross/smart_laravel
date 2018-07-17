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

  private $width = 150;
  private $height = 53.98;

  private $title = 'SERVICES PENETRATION FIRE SEAL';

  
  protected $y = 0;

  private function front($fire_identification, $ln = 0) {
    
    
    $this->SetFont('Arial','B', $this->font["header"]);  
    $this->Cell($this->width , 10, $this->title, 'LTR', 1, 'C');
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
            \"manufacturer\" :  \"$fire_identification->manufacturer\", 

        }");


    $qr_code->setMargin(0);
    $qr_code->setOutfile('tmp/qr_fire_' . $fire_identification->id .'.png')->png();

    $this->Image('tmp/qr_fire_' . $fire_identification->id .'.png', 119, $this->y-37, 30);
    $this->Text(115, $this->y-3,'Penetration Number: ' . $fire_identification->fire_number);
    
    $this->y = $this->GetY();

  }


  public function add($fire_identification)
  {
    //Render Front

    $this->front($fire_identification);
    

    $this->Ln(5);
  }
}
