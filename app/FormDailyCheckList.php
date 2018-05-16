<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormDailyCheckList extends Model
{
    public function items(){

        return $this->hasMany('App\FormDailyCheckListItems', 'checklist')->orderBy('number');
    }

    public function operators(){

        return $this->hasMany('App\FormDailyCheckListLic', 'checklist')->orderBy('number');
    }
    
}
