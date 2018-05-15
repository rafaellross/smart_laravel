<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QAUser extends Model
{
    public function qa_type(){

        return $this->belongsTo('App\QATypes', 'qa_type');
    }

    public function job(){

        return $this->belongsTo('App\Job', 'project');
    }

    public function user(){

        return $this->belongsTo('App\User', 'user_id');
    }

    public function activities(){

        return $this->hasMany('App\QAUserActivities', 'qa_type')->orderBy('order');
    }

    public function foreman_name(){

        return $this->hasOne('App\Employee', 'foreman');
    }

    public function photos(){

        return $this->hasMany('App\QAUserPhoto', 'qa_user');
    }


    
}
