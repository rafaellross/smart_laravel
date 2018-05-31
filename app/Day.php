<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function dayJobs(){
        return $this->hasMany('App\DayJob')->orderBy('number');
    }

    public function listHours(){

    	$result = array();

    	foreach ($this->dayJobs() as $job) {
    		$result[$job->job] += $job->hours;
    	}
    	return $result;
    }

    public function work(){
        $work = false;
        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday");

        foreach ($this->dayJobs as $job) {

            if ((isset($job->job->code)) && !in_array($job->job->code, $deductCodes)) {
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

    

    public function workForBonus(){
        $work = false;
        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday", "rdo");

        foreach ($this->dayJobs as $job) {

            if ((isset($job->job->code)) && !in_array($job->job->code, $deductCodes)) {
                $work = true;
            }
        }
        return $work;
    }

}
