<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\TimeSheet;
use Carbon\Carbon;
use App\Hour;
use Config;
/**
* This class is used to convert time
*/
class TimeSheetMyOb
{

	public $obj;


	function __construct(TimeSheet $timesheet)
	{
		$this->timesheet = $timesheet;
		$this->obj = array();
		$this->obj['Employee'] 		= array('UID' => $this->timesheet->employee->myob_id);
		$this->obj['StartDate']		= Carbon::parse($this->timesheet->week_end)->subDays(6)->toDateTimeString();
		$this->obj['EndDate']			= Carbon::parse($this->timesheet->week_end)->toDateTimeString();
		$this->obj['Lines'] 			= array();
		$this->config = Config::get('myob.payroll');
		$this->Lines();

	}

	public function Lines()
	{

		$arr_lines = array();

		////Generate lines for every job using function listHoursNormal()
		foreach ($this->timesheet->listHoursNormal() as $job) {
			$line = new \stdClass();
			$line->PayrollCategory = (object)array('UID' => $this->config['base_hourly']);

			if (is_null($job['myob_id'])) {
				$line->Job = (object)array('UID' => $this->config['default_job']);
			} else {
				$line->Job = (object)array('UID' => $job['myob_id']);
			}


			$line->Entries =
				array(array(
						'UID' => '00000000-0000-0000-0000-000000000000',
						'Date' => Carbon::parse($this->timesheet->week_end)->toDateTimeString(),
						'Hours' => $job['normal'],

						'Processed' => false
					));

			$line->Entries = $line->Entries;

			array_push($arr_lines, $line);
		}

		//Travel day
		if ($this->timesheet->employee->travel) {

			foreach ($this->timesheet->days as $day) {

				foreach ($day->dayJobs as $job) {
					if ($job->travel() > 0 && !$job->public_holiday) {
						$line = new \stdClass();

						if ($this->timesheet->employee->location == 'A' && (in_array($this->timesheet->employee->apprentice_year, ['1', '2', '3', '4']))) {

							$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['apprentice'][$this->timesheet->employee->apprentice_year]);

						} else {

							$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['tradesman']);

						}

						if (!isset($job->job->myob_id)) {

			        $line->Job = (object)array('UID' => $this->config['default_job']);

			      } else {

			        $line->Job = (object)array('UID' => $job->job->myob_id);

			      }


						$line->Entries = array();
			      $line->Entries =
			        array(array(
			            'UID' => '00000000-0000-0000-0000-000000000000',
			            'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
			            'Hours' => $job->travel(),
			            'Processed' => false
			          ))
			        ;

		        $line->Entries = $line->Entries;

						array_push($arr_lines, $line);

					}


				}
			}

		}


		foreach ($this->timesheet->days as $day) {
			$total_15 = 0;
			$total_20 = 0;

			$jobs_day = array();
			$day->loadMissing('dayJobs');
			foreach ($day->dayJobs as $job) {

				if (isset($job->job->code)) {

					array_push($jobs_day, $job->job->code);

				}
			}

			if (Hour::convertToDecimal($day->total_15) > 0) {

					$total_15 = Hour::convertToDecimal($day->total_15);


					//Generate lines for every job over time 1.5
					foreach ($day->dayJobs as $job) {
						$line = new \stdClass();
						if (isset($job->job->code)) {
							$line->PayrollCategory = (object)array('UID' => $this->config['overtime']['15']);

							if (is_null($job->job->myob_id)) {

								$line->Job = (object)array('UID' => $this->config['default_job']);

							} else {

								$line->Job = (object)array('UID' => $job->job->myob_id);

							}

							$line->Entries = array();
							$line->Entries =
								array(array(
										'UID' => '00000000-0000-0000-0000-000000000000',
										'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
										'Hours' => $total_15 / count($jobs_day),
										'Processed' => false
									));

								$line->Entries = $line->Entries;

							array_push($arr_lines, $line);

						}
					}

			} //End 1.5

			if (Hour::convertToDecimal($day->total_15_night) > 0) {

					$total_15 = Hour::convertToDecimal($day->total_15_night);


					//Generate lines for every job over time 1.5 night
					foreach ($day->dayJobs as $job) {
						$line = new \stdClass();
						if (isset($job->job->code)) {
							$line->PayrollCategory = (object)array('UID' => $this->config['overtime']['15']);

							if (is_null($job->job->myob_id)) {

								$line->Job = (object)array('UID' => $this->config['default_job']);

							} else {

								$line->Job = (object)array('UID' => $job->job->myob_id);

							}

							$line->Entries = array();
							$line->Entries =
								array(array(
										'UID' => '00000000-0000-0000-0000-000000000000',
										'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
										'Hours' => $total_15 / count($jobs_day),
										'Processed' => false
									));

								$line->Entries = $line->Entries;

							array_push($arr_lines, $line);

						}
					}

			} //End 1.5

			if (Hour::convertToDecimal($day->total_20) > 0) {

					$total_20 = Hour::convertToDecimal($day->total_20);

					//Generate lines for every job over time 2.0
					foreach ($day->dayJobs as $job) {
						$line = new \stdClass();
						if (isset($job->job->code)) {
							$line->PayrollCategory = (object)array('UID' => $this->config['overtime']['20']);

							if (is_null($job->job->myob_id)) {

								$line->Job = (object)array('UID' => $this->config['default_job']);

							} else {

								$line->Job = (object)array('UID' => $job->job->myob_id);

							}

							$line->Entries = array();
							$line->Entries =
								array(array(
										'UID' => '00000000-0000-0000-0000-000000000000',
										'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
										'Hours' => $total_20 / count($jobs_day),
										'Processed' => false
									))
								;

								$line->Entries = $line->Entries;

							array_push($arr_lines, $line);

						}
					}

			} //End 1.5

			if (Hour::convertToDecimal($day->total_20_night) > 0) {

					$total_20 = Hour::convertToDecimal($day->total_20_night);

					//Generate lines for every job over time 2.0
					foreach ($day->dayJobs as $job) {
						$line = new \stdClass();
						if (isset($job->job->code)) {
							$line->PayrollCategory = (object)array('UID' => $this->config['overtime']['20']);

							if (is_null($job->job->myob_id)) {

								$line->Job = (object)array('UID' => $this->config['default_job']);

							} else {

								$line->Job = (object)array('UID' => $job->job->myob_id);

							}

							$line->Entries = array();
							$line->Entries =
								array(array(
										'UID' => '00000000-0000-0000-0000-000000000000',
										'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
										'Hours' => $total_20 / count($jobs_day),
										'Processed' => false
									))
								;

								$line->Entries = $line->Entries;

							array_push($arr_lines, $line);

						}
					}

			} //End 2.0 night



			//Generate lines for every job
			foreach ($day->dayJobs as $job) {
				$line = new \stdClass();
				$deductions = 0;
				$pct_of_total = 0;
				if (isset($job->job->code) && $day->week_day < 7 && in_array($job->job->code, ['anl', 'rdo', 'pld'])) {
					/*
					if (isset($day->listHours()['rdo'])) {
						Log::debug($day->listHours());
					}
					*/
					if (isset($day->listHours()['rdo']) || isset($day->listHours()['anl']) || isset($day->listHours()['pld']) ) {

						$dedu_rdo = isset($day->listHours()['rdo']) ? $day->listHours()['rdo'] : 0;
						$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
						$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;


						/*$dedu_holiday = isset($day->listHours()['holiday']) ? $day->listHours()['holiday'] : 0;*/
						$deductions = $dedu_rdo + $dedu_pld + $dedu_anl /*+ $dedu_holiday*/;
						$pct_of_total = (Hour::convertToInteger($day->total) - ($deductions)) > 0 ? ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions)) : 0;
						Log::debug(str_repeat("#",30));
						Log::debug("Rdo:" . $dedu_rdo);
						Log::debug("Total Day:" . Hour::convertToInteger($day->total));
						Log::debug("Deductions:" . $deductions);
						Log::debug("Job Hours:" . $job->hours());
						Log::debug("Job:" . $job->job->code);
						Log::debug("Pct of Total:" . $pct_of_total);





					} else {
						if (Hour::convertToInteger($day->total) > 0) {
							$pct_of_total = ($job->hours()) / Hour::convertToInteger($day->total);
						}

						Log::debug(str_repeat("#",30));

						Log::debug("Total Day:" . Hour::convertToInteger($day->total));

						Log::debug("Job Hours:" . $job->hours());
						Log::debug("Job:" . $job->job->code);
						Log::debug("Pct of Total:" . $pct_of_total);


					}

					if ($this->timesheet->employee->rdo) {

						$pct_deduct_entitlement = 0.90;

					} else {

						$pct_deduct_entitlement = 1;

					}

					if (in_array($job->job->code, ['anl', 'rdo', 'pld'])) {
						switch ($job->job->code) {
							case 'anl':
								$line->PayrollCategory = (object)array('UID' => $this->config['anl']);
								break;
							case 'rdo':
								$line->PayrollCategory = (object)array('UID' => $this->config['rdo']);
								break;
							case 'pld':
								$line->PayrollCategory = (object)array('UID' => $this->config['pld']);
								break;

						}
					} else {
								$line->PayrollCategory = (object)array('UID' => $this->config['base_hourly']);
					}

					if (is_null($job->job->myob_id)) {
						$line->Job = (object)array('UID' => $this->config['default_job']);
					} else {
						$line->Job = (object)array('UID' => $job->job->myob_id);
					}


					$line->Entries = array();

					$dedu_hour = 4 ;
					//Log::debug("Hrs Temp:" . $hrs_temp);
					//$hrs_temp = in_array($job->job->code, ['anl', 'rdo', 'pld', 'sick'/*, 'holiday'*/]) ? $job->hours()/60 : ((((Hour::convertToInteger($day->normal) - $deductions) * $pct_of_total)/60.0) - (0));
					//Log::debug("Hrs Temp:" . $hrs_temp);
					//$pct_of_total = $this->totalNormal() > 0 ?  $hrs_temp / $this->totalNormal() : 0;


					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
								'Hours' =>
									in_array($job->job->code, ['anl', 'rdo', 'pld', 'sick'/*, 'holiday'*/]) ? $job->hours()/60 : ($job->hours()/60) - (($job->hours()/60) * $dedu_hour),

								'Processed' => false
							));

					$line->Entries = $line->Entries;

					array_push($arr_lines, $line);

				}
			}

			//Annual Leave Loading
			foreach ($day->dayJobs as $job) {
				$line = new \stdClass();
				$deductions = 0;
				$pct_of_total = 0;
				if (isset($job->job->code) && $job->job->code == 'anl') {

					$line->PayrollCategory = (object)array('UID' => $this->config['anl_load']);
					$line->Job = (object)array('UID' => $this->config['default_job']);

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
								'Hours' => $job->hours()/60,
								'Processed' => false
							))
						;

						$line->Entries = $line->Entries;

					array_push($arr_lines, $line);
				}
			}


			//Sick Leave
			foreach ($day->dayJobs as $job) {
				$line = new \stdClass();
				$deductions = 0;
				$pct_of_total = 0;
				if (isset($job->job->code) && $job->sick) {

					$line->PayrollCategory = (object)array('UID' => $this->config['sick']);
					//$line->Job = (object)array('UID' => $this->config['default_job']);
					$line->Job = (object)array('UID' => $job->job->myob_id);

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
								'Hours' => $job->hours()/60,
								'Processed' => false
							))
						;

						$line->Entries = $line->Entries;

					array_push($arr_lines, $line);
				}
			}







			//Site Allowance
			if ($this->timesheet->employee->site_allow) {
				foreach ($day->dayJobs as $job) {
					$line = new \stdClass();
					$deductions = 0;
					if (isset($job->job->code) && $day->week_day < 9 && !$job->tafe && !$job->sick && !$job->public_holiday) {
						if (isset($day->listHours()['rdo']) || isset($day->listHours()['anl']) || isset($day->listHours()['pld'])) {
							$dedu_rdo = isset($day->listHours()['rdo']) ? $day->listHours()['rdo'] : 0;
							$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
							$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
							$dedu_sick = isset($day->listHours()['sick']) ? $day->listHours()['sick'] : 0;
							$dedu_holiday = isset($day->listHours()['holiday']) ? $day->listHours()['holiday'] : 0;
							$dedu_tafe = isset($day->listHours()['tafe']) ? $day->listHours()['tafe'] : 0;
							$deductions = $dedu_rdo + $dedu_pld + $dedu_anl + $dedu_sick + $dedu_holiday + $dedu_tafe;
							$pct_of_total = (Hour::convertToInteger($day->total) - ($deductions)) > 0 ? ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions)) : 0;


						} else {
							if (Hour::convertToInteger($day->total) > 0) {
								$pct_of_total = ($job->hours()) / Hour::convertToInteger($day->total);
							}
						}


						$pct_deduct_entitlement = 0.90;


						if ($this->timesheet->employee->location == 'A' && (in_array($this->timesheet->employee->apprentice_year, ['1', '2', '3', '4']))) {

							$line->PayrollCategory = (object)array('UID' => $this->config['site_allow']['apprentice'][$this->timesheet->employee->apprentice_year]);

						} else {

							$line->PayrollCategory = (object)array('UID' => $this->config['site_allow']['tradesman']);

						}





						if (is_null($job->job->myob_id)) {
							$line->Job = (object)array('UID' => $this->config['default_job']);
						} else {
							$line->Job = (object)array('UID' => $job->job->myob_id);
						}


						$line->Entries = array();
						$line->Entries =
							array(array(
									'UID' => '00000000-0000-0000-0000-000000000000',
									'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
									'Hours' => in_array($job->job->code, ['anl', 'rdo', 'pld', 'sick', 'holiday', 'tafe']) ? 0 : $job->hours()/60,
									'Processed' => false
								))
							;

							$line->Entries = $line->Entries;
						if ( (in_array($job->job->code, ['anl', 'rdo', 'pld', 'sick', 'holiday', 'tafe']) ? 0 : $job->hours()/60) > 0 ) {
							array_push($arr_lines, $line);
						}


					}
				}

			}

			//Travel Days
				/*
				if ($this->timesheet->employee->travel) {

					$jobs = 0;
					foreach ($day->dayJobs as $job) {
						if (!is_null($job->start) && !$job->tafe && !$job->sick && !$job->public_holiday) {
								$jobs++;
						}
					}

					foreach ($day->dayJobs as $job) {

						$line = new \stdClass();
						$deductions = 0;
						if ((isset($job->job->code) && $day->week_day < 9) && (!$job->tafe && !$job->sick && !$job->public_holiday)) {
							if ((isset($day->listHours()['anl']) || isset($day->listHours()['pld'])) && !$day->work()) {

								$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
								$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
								$deductions = $dedu_pld + $dedu_anl;
								if ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)) > 0) {
									$pct_of_total = ($job->hours()) / ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)) - $day->sick());
								}

							} else {
								if ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)) > 0) {

									$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
									$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;


									$pct_of_total = ($job->hours()) / (Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night) - ($dedu_pld + $dedu_anl + $day->sick()));
								}
							}

							if ($this->timesheet->employee->location == 'A' && (in_array($this->timesheet->employee->apprentice_year, ['1', '2', '3', '4']))) {

								$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['apprentice'][$this->timesheet->employee->apprentice_year]);

							} else {

								$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['tradesman']);

							}

							$total_travel = ($day->hasNight() && !in_array($job->job->code, ['anl', 'tafe', 'pld', 'holiday']) && ($jobs > 1) ? 2 : 1 );

							if (is_null($job->job->myob_id)) {
								$line->Job = (object)array('UID' => $this->config['default_job']);
							} else {
								$line->Job = (object)array('UID' => $job->job->myob_id);
							}

							$line->Entries = array();
							$line->Entries =
								array(array(
										'UID' => '00000000-0000-0000-0000-000000000000',
										'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
										'Hours' => (in_array($job->job->code, ['sick', 'anl', 'tafe', 'pld', 'holiday']) ? 0 : $total_travel * $pct_of_total),
										'Processed' => false
									))
								;

								$line->Entries = $line->Entries;

							if ((in_array($job->job->code, ['sick', 'anl', 'tafe', 'pld', 'holiday']) ? 0 : $total_travel * $pct_of_total)) {
								array_push($arr_lines, $line);
							}


						}
					}
				}
				*/
			}

		//Travel day extra (RDO)
		if ($this->timesheet->rdo > 0) {

				$line = new \stdClass();

				if ($this->timesheet->employee->location == 'A' && (in_array($this->timesheet->employee->apprentice_year, ['1', '2', '3', '4']))) {

					$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['apprentice'][$this->timesheet->employee->apprentice_year]);

				} else {

					$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']['tradesman']);

				}

					$line->Job = (object)array('UID' => $this->config['default_job']);

					$travelDays = 0;

						if ($this->timesheet->rdo > (4*60) && $this->timesheet->rdo <= (8*60) ) {
							$travelDays = 1;
						} else {
							$int = floor(($this->timesheet->rdo/60)/8);
							$travelDays = $int;

							$rest = ($this->timesheet->rdo/60)/8 - floor(($this->timesheet->rdo/60)/8);
							if ($rest > 0.5) {
								$travelDays++;
							}
						}

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($this->obj['EndDate'])->toDateTimeString(),
								'Hours' => $travelDays,
								'Processed' => false
							));

						$line->Entries = $line->Entries;
						array_push($arr_lines, $line);
		}


		//RDO
		if ($this->timesheet->rdo > 0 && $this->timesheet->employee->rdo) {

				$line = new \stdClass();

					$line->PayrollCategory = (object)array('UID' => $this->config['rdo']);
					$line->Job = (object)array('UID' => $this->config['default_job']);

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($this->obj['EndDate'])->toDateTimeString(),
								'Hours' => $this->timesheet->rdo/60,
								'Processed' => false
							));

						$line->Entries = $line->Entries;
						array_push($arr_lines, $line);
		}

		if ($this->timesheet->pld > 0) {

				$line = new \stdClass();

					$line->PayrollCategory = (object)array('UID' => $this->config['pld']);
					$line->Job = (object)array('UID' => $this->config['default_job']);

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($this->obj['EndDate'])->toDateTimeString(),
								'Hours' => $this->timesheet->pld/60,
								'Processed' => false
							));

						$line->Entries = $line->Entries;
						array_push($arr_lines, $line);
		}

		if ($this->timesheet->anl > 0) {

					$line = new \stdClass();
					$line->PayrollCategory = (object)array('UID' => $this->config['anl']);
					$line->Job = (object)array('UID' => $this->config['default_job']);

					$line->Entries = array();
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($this->obj['EndDate'])->toDateTimeString(),
								'Hours' => $this->timesheet->anl/60,
								'Processed' => false
							));

						$line->Entries = $line->Entries;
						array_push($arr_lines, $line);

						//Annual Leave load

						$line = new \stdClass();
						$line->PayrollCategory = (object)array('UID' => $this->config['anl_load']);
						$line->Job = (object)array('UID' => $this->config['default_job']);

						$line->Entries = array();
						$line->Entries =
							array(array(
									'UID' => '00000000-0000-0000-0000-000000000000',
									'Date' => Carbon::parse($this->obj['EndDate'])->toDateTimeString(),
									'Hours' => $this->timesheet->anl/60,
									'Processed' => false
								));

							$line->Entries = $line->Entries;
							array_push($arr_lines, $line);


		}



		$this->obj{'Lines'} = $arr_lines;

		return $this->obj;
	}

	public function totalNormal()
	{
		$arr_lines = array();
		$total = 0;


		foreach ($this->timesheet->days as $day) {
			foreach ($day->dayJobs as $job) {

				$deductions = 0;
				$pct_of_total = 0;
				if (isset($job->job->code) && $day->week_day < 7 && !in_array($job->job->code, ['anl', 'rdo', 'pld', 'sick'/*, 'holiday'*/]) && !$job->sick) {
					if (isset($day->listHours()['rdo']) || isset($day->listHours()['anl']) || isset($day->listHours()['pld']) /*|| isset($day->listHours()['holiday'])*/) {
						$dedu_rdo = isset($day->listHours()['rdo']) ? $day->listHours()['rdo'] : 0;
						$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
						$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
						$dedu_sick = isset($day->listHours()['sick']) ? $day->listHours()['sick'] : 0;
						/*$dedu_holiday = isset($day->listHours()['holiday']) ? $day->listHours()['holiday'] : 0;*/
						$deductions = $dedu_rdo + $dedu_pld + $dedu_anl + $dedu_sick /*+ $dedu_holiday*/;
						$pct_of_total = (Hour::convertToInteger($day->total) - ($deductions)) > 0 ? ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions)) : 0;

					} else {
						if (Hour::convertToInteger($day->total) > 0) {
							$pct_of_total = ($job->hours()) / Hour::convertToInteger($day->total);
						}

					}

					if ($this->timesheet->employee->rdo) {
						$pct_deduct_entitlement = 1;
					} else {
						$pct_deduct_entitlement = 1;
					}

					$total += in_array($job->job->code, ['anl', 'rdo', 'pld', /*'holiday', */'sick']) ? $job->hours()/60 : (((Hour::convertToInteger($day->normal) * $pct_of_total) * $pct_deduct_entitlement)/60.0) - ($deductions/60);

				}
			}
		}


		return $total;
	}

}
