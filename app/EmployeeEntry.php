<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEntry extends Model
{
  public function employee(){

      return $this->belongsTo('App\Employee');
  }

  public function user(){

      return $this->belongsTo('App\User');
  }

  public function row() {

      $entries_before = EmployeeEntry::where('entry_dt', '=', $this->entry_dt)
                        ->where('entry_time', '<', $this->entry_time)
                        ->where('in_out', $this->in_out);

      if ($entries_before->count() == 0) {
        return 1;
      } else {
        return $entries_before->count() + 1;
      }


  }


}
