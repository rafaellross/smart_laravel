<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayJob extends Model
{
    public function job(){
        return $this->belongsTo('App\Job');
    }

    public function day(){
        return $this->belongsTo('App\Day');
    }

    public function hours(){
    	if ($this->number == 1 && $this->day->week_day !== 7) {
    		return ($this->end - $this->start)-15 < 0 ? 0 : ($this->end - $this->start)-15;
    	} else {
    		return $this->end - $this->start < 0 ? 0 :$this->end - $this->start;
    	}    	
    }        
}
