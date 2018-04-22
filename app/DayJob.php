<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayJob extends Model
{
    public function job(){
        return $this->belongsTo('App\Job');
    }

    public function hours(){

    	return $this->end - $this->start < 0 ? 0 :$this->end - $this->start;
    }        
}
