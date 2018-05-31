<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class TimeSheet extends Model
{

    public function days(){

        return $this->hasMany('App\Day')->orderBy('week_day');
    }

    public function certificates(){

        return $this->hasMany('App\TimeSheetCertificate');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function employee(){

        return $this->belongsTo('App\Employee');
    }

	public function listHours(){

        $result = array();
        foreach ($this->days as $day) {
            foreach ($day->dayJobs as $job) {
                if (isset($job->job->code)) {
                    if (isset($result[$job->job->code])) {
                        $result[$job->job->code] += $job->hours();
                    } else {
                        $result[$job->job->code] = $job->hours();
                    }
                }
            }
        }
        return $result;
	}

	public static function D($J){
	    return ($J<10? '0':'') . $J;
	}

	public function rdoTaken(){
		$rdo = Hour::convertToInteger($this->rdo);
		if (isset($this->listHours()["rdo"])) {
			$rdo += $this->listHours()["rdo"];
		}
		return new Hour($rdo);
	}

	public function pldTaken(){
		$pld = Hour::convertToInteger($this->pld);
		if (isset($this->listHours()["pld"])) {
			$pld += $this->listHours()["pld"];
		}
		return new Hour($pld);
	}

	public function sickTaken(){
		if (isset($this->listHours()["sick"])) {
			return $this->listHours()["sick"] > 0 ? $this->listHours()["sick"]/60 : null;
		} else {
			return "";
		}
	}

	public function normalLessRdo(){
		if ($this->employee->rdo) {
			$deduction = 0;
			$deductCodes = array("sick", "rdo", "anl", "pld");
			foreach ($this->listHours() as $job => $time) {
				if (in_array($job, $deductCodes)) {
					$deduction += $time;
				}
			}
			$result = (Hour::convertToInteger($this->normal) - (4 * 60) - $deduction)/60.0;
			return $result < 0 ? "" : $result;
		} else {
			return Hour::convertToInteger($this->normal) == 0 ? null : Hour::convertToInteger($this->normal)/60;
		}
	}

	public function anlTaken(){
		$anl = Hour::convertToInteger($this->anl);
		if (isset($this->listHours()["anl"])) {
			$anl += $this->listHours()["anl"];
		}
		return new Hour($anl);
	}

	public function travelDays(){
		if ($this->employee->travel) {
            $travelDays = 0;
            foreach ($this->days as $day) {


                if ($day->work()) {
                    $travelDays++;
                    //Pay one more travel if employee had worked at night
                }


                $jobs = 0;


                foreach ($day->dayJobs as $job) {
                  if (!is_null($job->start)) {
                      $jobs++;
                  }
                }


                if ($day->hasNight() && $jobs > 1) {
                  $travelDays++;
                }

            }
            //Check if will travel day for special request RDO
            if ($this->rdo > 0) {
            	if ($this->rdo > (4*60) && $this->rdo <= (8*60) ) {
            		$travelDays++;
            	} else {
            		$int = floor(($this->rdo/60)/8);
            		$travelDays += $int;

            		$rest = ($this->rdo/60)/8 - floor(($this->rdo/60)/8);
            		if ($rest > 0.5) {
            			$travelDays++;
            		}
            	}
            }
            return $travelDays;
        } else {
        	return null;
        }
	}

	public function siteAllow(){
		if ($this->employee->site_allow) {
	        $siteAllow = 0;
	        $deductCodes = array("sick", "anl", "pld", "tafe", "holiday", "rdo");
	        foreach ($this->listHours() as $job => $hours){
	            if (!in_array($job, $deductCodes)) {
	                $siteAllow += $hours;
	            }
	        }
	        return $siteAllow;
		} else {
			return 0;
		}

	}

	public function workDays(){
	    $workDays = 0;
	    foreach ($this->days as $day) {
	        if ($day->workForBonus()) {
	                $workDays++;
	        }
	    }
	    return $workDays;
	}


	public function bonus(){
		if ($this->workDays() >= 5 || $this->employee->bonus == 0) {
			return $this->employee->bonus;
		} else if($this->workDays() == 0) {
			return 0;
		} else {
			$deductBonusDay = $this->employee->bonus/6;
			$bonus = $this->employee->bonus - ((5-$this->workDays()) * $deductBonusDay);
			return $bonus;
		}
	}


}
