<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayJob extends Model
{
    public function job(){
        return $this->belongsTo('App\Job');
    }

}
