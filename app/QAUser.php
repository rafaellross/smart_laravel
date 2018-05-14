<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QAUser extends Model
{
    public function qa_type(){

        return $this->belongsTo('App\QATypes', 'qa_type')->orderBy('order');
    }
    
}
