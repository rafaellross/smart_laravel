<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLicense extends Model
{
    public function license(){
        return $this->belongsTo('App\License');
    }

}
