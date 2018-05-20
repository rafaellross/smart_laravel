<?php

namespace App;

use setasign\Fpdi\Fpdi;
use Illuminate\Database\Eloquent\Model;

class FormTFNf extends Fpdi
{
    public function add()
    {
		// initiate FPDI
		
		// add a page
		$this->AddPage();
		// set the source file
		$this->setSourceFile('templates/tfn.pdf');
		// import page 1
		$tplIdx = $this->importPage(5);
		// use the imported page and place it at position 10,10 with a width of 100 mm
		$this->useTemplate($tplIdx, 0, 0, 210);

		// now write some text above the imported page
		$this->SetFont('Helvetica', '', 9);
		
		$nameX = 13.2;
		$this->SetXY(8.2, 80);
		$this->Write(0, 'R');
		$this->SetX(13.2);
		$this->Write(0, 'O');
		$this->SetX(13.2+5);
		$this->Write(0, 'S');
		$this->SetX(13.2+5+5);
		$this->Write(0, 'S');

		$this->SetX(13.2+5+5+5);
		$this->Write(0, ' ');

		$this->SetX(13.2+5+5+5+5);
		$this->Write(0, 'D');
		$this->SetX(13.2+5+5+5+5+5);
		$this->Write(0, 'E');
		$this->Output();    	
    }
}
