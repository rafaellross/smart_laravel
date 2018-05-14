<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QATypes extends Model
{
    public function activities(){

        return $this->hasMany('App\QAActivities', 'qa_type')->orderBy('order');
    }
    
}
