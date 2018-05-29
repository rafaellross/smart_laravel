<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\Debugbar\Facade as Debugbar;
/**
* This class is used to convert time
*/
class Hour extends Model
{

	public $value;
	public $integer;
	public $decimal;
	public $hour;

	function __construct($value)
	{
		$this->value 	= $value;
		$this->integer 	= Hour::convertToInteger($value);
		$this->decimal 	= Hour::convertToDecimal($value);
		$this->hour 	= Hour::convertToHour($value);
	}

	public static function convertToDecimal($hour){
		if (!strrpos($hour, ":") || is_null($hour)) {
			if (is_numeric($hour) && $hour > 0) {
				return $hour/60;
			} else {
				return null;
			}			
		} else {
		    $piece = explode(":", $hour);
		    if (count($piece) > 1) {
		      return ($piece[0]*60 + +$piece[1])/60.0;
		    } else {
		      return null;
		    }
		}
	}

	public static function convertToInteger($hour){
		if (is_numeric($hour)) {
			return $hour == 0 ? null : $hour;
		} else {
		    $piece = explode(":", $hour);
		    if (count($piece) > 1) {
		      return ($piece[0]*60 + +$piece[1]);
		    } else {
		      return null;
		    }
		}
	}

	public static function convertToHour($minutes){
		if (!is_numeric($minutes)) {
                        return $minutes == 0 ? null : $minutes;
		} else {
		     if ($minutes > 0) {
		       return Hour::D($minutes/60 | 0) . ':' . Hour::D($minutes%60);
		     } else {
		     	return "";
		     }
		}
	}

	public static function D($J){
	    return ($J<10? '0':'') . $J;
	}
}
