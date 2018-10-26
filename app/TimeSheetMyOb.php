<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
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
		//dd($this);
		$arr_lines = array();
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
				if (isset($job->job->code) && $day->week_day < 7) {
					if (isset($day->listHours()['rdo']) || isset($day->listHours()['anl']) || isset($day->listHours()['pld'])) {
						$dedu_rdo = isset($day->listHours()['rdo']) ? $day->listHours()['rdo'] : 0;
						$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
						$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
						$deductions = $dedu_rdo + $dedu_pld + $dedu_anl;
						$pct_of_total = (Hour::convertToInteger($day->total) - ($deductions)) > 0 ? ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions)) : 0;


					} else {
						if (Hour::convertToInteger($day->total) > 0) {
							$pct_of_total = ($job->hours()) / Hour::convertToInteger($day->total);
						}

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
					$line->Entries =
						array(array(
								'UID' => '00000000-0000-0000-0000-000000000000',
								'Date' => Carbon::parse($day->day_dt)->toDateTimeString(),
								'Hours' =>
									in_array($job->job->code, ['anl', 'rdo', 'pld']) ?
									$job->hours()/60 : (((Hour::convertToInteger($day->normal) * $pct_of_total) * $pct_deduct_entitlement)/60.0) - ($deductions/60),
								'Processed' => false
							))
						;

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

			//Site Allowance
			if ($this->timesheet->employee->site_allow) {
				foreach ($day->dayJobs as $job) {
					$line = new \stdClass();
					$deductions = 0;
					if (isset($job->job->code) && $day->week_day < 7) {
						if (isset($day->listHours()['rdo']) || isset($day->listHours()['anl']) || isset($day->listHours()['pld'])) {
							$dedu_rdo = isset($day->listHours()['rdo']) ? $day->listHours()['rdo'] : 0;
							$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
							$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
							$deductions = $dedu_rdo + $dedu_pld + $dedu_anl;
							//$pct_of_total = ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions));
							$pct_of_total = (Hour::convertToInteger($day->total) - ($deductions)) > 0 ? ($job->hours()) / (Hour::convertToInteger($day->total) - ($deductions)) : 0;


						} else {
							if (Hour::convertToInteger($day->total) > 0) {
								$pct_of_total = ($job->hours()) / Hour::convertToInteger($day->total);
							}
						}


						$pct_deduct_entitlement = 0.90;

						$line->PayrollCategory = (object)array('UID' => $this->config['site_allow']);


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
									'Hours' => in_array($job->job->code, ['anl', 'rdo', 'pld']) ? 0 : $job->hours()/60,
									'Processed' => false
								))
							;

							$line->Entries = $line->Entries;

						array_push($arr_lines, $line);

					}
				}

			}

			//Travel Days
			if ($this->timesheet->employee->travel) {
				foreach ($day->dayJobs as $job) {
					$line = new \stdClass();
					$deductions = 0;
					if (isset($job->job->code) && $day->week_day < 9) {
						if (isset($day->listHours()['anl']) || isset($day->listHours()['pld'])) {

							$dedu_pld = isset($day->listHours()['pld']) ? $day->listHours()['pld'] : 0;
							$dedu_anl = isset($day->listHours()['anl']) ? $day->listHours()['anl'] : 0;
							$deductions = $dedu_pld + $dedu_anl;
							if ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)) > 0) {
							$pct_of_total = ($job->hours()) / ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)));
						}


						} else {
							if ((Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night)) > 0) {
								$pct_of_total = ($job->hours()) / (Hour::convertToInteger($day->total) + Hour::convertToInteger($day->total_night));
							}


						}

						if ($day->hasNight()) {
							dd($pct_of_total);
						}


						$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']);
						$total_travel = ($day->hasNight() && !in_array($job->job->code, ['anl', 'tafe', 'pld', 'holiday']) ? 2 : 1 );

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
									'Hours' => in_array($job->job->code, ['anl', 'tafe', 'pld', 'holiday']) ? 0 : $total_travel * $pct_of_total,
									'Processed' => false
								))
							;

							$line->Entries = $line->Entries;

						array_push($arr_lines, $line);

					}
				}
			}

			}

		//Travel day extra (RDO)
		if ($this->timesheet->rdo > 0) {

				$line = new \stdClass();

					$line->PayrollCategory = (object)array('UID' => $this->config['travel_days']);
					$line->Job = (object)array('UID' => $this->config['default_job']);

					$travelDays = 0;

						if ($this->timesheet->rdo > (4*60) && $this->timesheet->rdo <= (8*60) ) {
							$travelDays = 1;
						} else {
							$int = floor(($this->rdo/60)/8);
							$travelDays = $int;

							$rest = ($this->rdo/60)/8 - floor(($this->rdo/60)/8);
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
		}



		$this->obj{'Lines'} = $arr_lines;
		//$this->obj = (object)$this->obj;
		//dd($this);
		return $this->obj;
	}


}
