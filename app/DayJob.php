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

    	if ($this->number == 1 && (!is_null($this->start) && !is_null($this->end))) {
        if ($this->end > $this->start) {

          return ($this->end - $this->start)-15 < 0 ? 0 : ($this->end - $this->start)-15;

        } else {

            return (((24*60)-$this->start) + ((24*60) - (24*60 - $this->end))) - 15 > 0 ? (((24*60)-$this->start) + ((24*60) - (24*60 - $this->end)) - 15) : 0;
        }

    	} else {

        if ($this->end > $this->start) {

            return ($this->end - $this->start) < 0 ? 0 : ($this->end - $this->start)-15;

        } else if (!is_null($this->start) && !is_null($this->end)) {


            return (((24*60)-$this->start) + ((24*60) - (24*60 - $this->end))) > 0 ? (((24*60)-$this->start) + ((24*60) - (24*60 - $this->end))) : 0;

        } else {

          return 0;

        }
    	}
    }
}
