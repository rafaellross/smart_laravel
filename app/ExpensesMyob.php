<?php

namespace App;

 use Illuminate\Database\Eloquent\Model;
 use App\TimeSheet;
 use Carbon\Carbon;
 use App\Hour;


 class ExpensesMyob
 {
   public $obj;

   function __construct(Employee $employee, $UID, $job_myob)
 	{
 		$this->employee = $employee;
 		$this->obj = array();
    $this->obj['UID'] 		= $UID;
 		$this->obj['Employee'] 		= array('UID' => $this->employee->myob_id);
    $this->obj['PayrollCategories'] 		= array('PayrollCategory' => ['UID' => '10c1d9f9-1cdd-4495-9dfd-8f573ce0c8c7']);
    $this->obj['Job'] 		              = array('UID' => $job_myob);
 		//$this->obj['StartDate']		= Carbon::parse($this->timesheet->week_end)->subDays(6)->toDateTimeString();
 		//$this->obj['EndDate']			= Carbon::parse($this->timesheet->week_end)->toDateTimeString();
 		//$this->obj['Lines'] 			= array();
 		//$this->config = Config::get('myob.payroll');
 		//$this->Lines();


 	}
 }
