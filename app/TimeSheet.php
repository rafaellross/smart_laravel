<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    public function days(){
        return $this->hasMany('App\Day');
    }
    
    public function user(){
        return $this->hasOne('App\User');
    }

    public function employee(){
        return $this->hasOne('App\Employee');
    }
    
}
