<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function dayJobs(){
        return $this->hasMany('App\DayJob');
    }
    
}
