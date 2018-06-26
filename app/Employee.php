<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Employee extends Model
{
    use Notifiable;
    public $last_time_sheet;
    protected $appends = ['last_timesheet'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone',
    ];


    public function timesheets(){

        return $this->hasMany('App\TimeSheet');
    }

    public function getLastTimesheetAttribute(){
        if (Carbon::parse($this->last_time_sheet_dt)->addDay()->weekOfYear == Carbon::now('Australia/Sydney')->weekOfYear) {
            return $this->last_time_sheet_id;
        } else {
            return null;
        }

    }
}
