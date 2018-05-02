<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLicense extends Model
{
	public function employee(){
		return $this->belongsTo('App\Post');	
	}    
}
