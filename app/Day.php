<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hour;

class Day extends Model
{

    public function timeSheet(){
        return $this->belongsTo('App\TimeSheet');
    }


    public function dayJobs(){
        return $this->hasMany('App\DayJob')->orderBy('number');
    }

    public function listHours(){
      $this->loadMissing('dayJobs');
    	$result = array();

    	foreach ($this->dayJobs as $job) {
        //dd($job->job);
        if (isset($job->job->code) && isset($result[$job->job->code])) {
          $result[$job->job->code] += $job->hours();
        } else if (isset($job->job->code)){
          $result[$job->job->code] = $job->hours();
        }

    	}
    	return $result;
    }

    public function work(){
        $work = false;
        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday", "rdo");

        foreach ($this->dayJobs as $job) {

            if (
            		isset($job->job->code) &&
    				(
		            	(

			        		!in_array($job->job->code, $deductCodes)
		        		)
		        		||
		        		(
		        			$job->job->code == "rdo" &&	($job->hours() >= (6*60))
		        		)

                    )
                    &&
                    !$job->tafe
                    &&
                    !$job->sick
                    &&
                    !$job->public_holiday

	        	)
            {
                $work = true;
            }
        }
        return $work;
    }

    public function hasNight(){

        $nightWork = false;

        foreach ($this->dayJobs as $job) {

            if ($job->night_work) {

                $nightWork = true;

            }

        }

        return $nightWork;
    }

    public function sick() {
      $this->loadMissing('dayJobs');
      $sick_hours = 0;
      foreach ($this->dayJobs as $job) {
          if (isset($job->job->code)) {
              if ($job->sick) {
                $sick_hours += $job->hours();
              }
          }
      }
      return $sick_hours;
    }

    public function workForBonus(){
        $work = false;
        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday", "rdo");

        foreach ($this->dayJobs as $job) {

            if ((isset($job->job->code)) && !in_array($job->job->code, $deductCodes) && !$job->tafe && !$job->sick && !$job->public_holiday) {
                $work = true;
            }
        }
        return $work;
    }

    public function updateHours() {

        $normal     = 0;
        $extra_15   = 0;
        $extra_20   = 0;

        foreach ($this->dayJobs as $job) {

            $hours = $job->end > $job->start ? ($job->end - $job->start) : 0;

            if($normal < (8*60) && $this->week_day < 7){

                $normal += $hours;

            } elseif ($extra_15 < (2*60) && $this->week_day < 7) {

                $extra_15 += $hours;

            } else {

                $extra_20 += $hours;

            }
        }

        if ($this->week_day < 7 && $normal > 0) {
            $normal -= 15;
        }

        $this->total = Hour::convertToHour($normal + $extra_15 + $extra_20);
        $this->normal = Hour::convertToHour($normal);
        $this->total_15 = Hour::convertToHour($extra_15);
        $this->total_20 = Hour::convertToHour($extra_20);

        $this->save();
        return ["normal" => $normal, "total_15" => $extra_15, "total_20" => $extra_20];
    }

    public function hours() {
        $total = 0;

        foreach ($this->dayJobs as $job) {
            if ($job->work()) {
                $total += $job->hours();
            }
        }

        return $total;
    }

    public function percentageOfWeek() {
        
        $total = 0;
        $percentage = 0;
        foreach ($this->timeSheet->days as $day) {

            if ($day->work()) {
                $total += $day->hours();
            }
        }

        if ($this->work()) {
            $percentage = $this->hours() / $total;
        }

        return $percentage;
    }

    

}
