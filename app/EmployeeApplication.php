<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeApplication extends Model
{
    public function licenses(){
        return $this->hasMany('App\EmployeeLicense', 'application_id');
    }

}
