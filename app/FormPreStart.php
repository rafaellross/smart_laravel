<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPreStart extends Model
{
    public function persons(){

        return $this->hasMany('App\FormPreStartSignature', 'prestart_id')->orderBy('number');
    }
    
}
