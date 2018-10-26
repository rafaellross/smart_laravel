<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeSheet;
use App\TimeSheetMyOb;
use App\Employee;
use App\Job;
use App\ExpensesMyob;


class MyObController extends Controller
{
    public function index() {

        $myob_auth = new \App\MYOB\AccountRightV2();

        $companies = $myob_auth->_makeGetRequest();

        return view('myob.index', ['companies' => $companies]);

    }

    public function integrate(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();

      $timesheet = TimeSheet::find($request->get('id'));
      $timesheet_myob = new TimeSheetMyOb($timesheet);

      $req = $myob_auth->_makePutRequest('Payroll/Timesheet/' . $timesheet->employee->myob_id . '?api-version=v2', $timesheet_myob->obj);
      if (isset($req->Errors) && count($req->Errors) > 0) {
        $errors = array();

        foreach ($req->Errors as $error) {
          array_push($errors, $error->Message);
        }

        $timesheet->integration_message = implode("|", $errors);
        $timesheet->integrated = false;
      } else {
        $timesheet->integration_message = null;
        $timesheet->integrated = true;

      }
      $timesheet->save();

      return response()->json(["name" => $timesheet->employee->name, "result" => is_null($timesheet->integration_message) ? 'Ok' : $timesheet->integration_message]);


    }

    public function employees(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();
      $employees = $myob_auth->_makeGetRequest("Contact/EmployeeStandardPay/0005832e-cfce-43f9-bf05-dbf1183d194f");
      //$employees = $myob_auth->_makeGetRequest("Contact/Employee" . '?$orderby=LastName');
      dd($employees);
      foreach ($employees->Items as $employee_myob) {
        if ($employee_myob->Name) {
          // code...
        }
      }
      foreach ($employees->Items as $employee_myob) {

        //return $employee_myob->LastName . ', ' . $employee_myob->FirstName;
        $emp = Employee::where('name', $employee_myob->LastName . ', ' . $employee_myob->FirstName)->get()->first();

        if (count($emp) > 0) {
          $emp->myob_id = $employee_myob->UID;
          $emp->save();
        }

      }

    }

    public function jobs(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();
      $jobs = $myob_auth->_makeGetRequest($request->get('guid') ."/GeneralLedger/Job");
      //dd($jobs);
      foreach ($jobs->Items as $job_myob) {
        //return $employee_myob->LastName . ', ' . $employee_myob->FirstName;
        $job = Job::where('code', $job_myob->Number)->get()->first();

        if (count($job) > 0) {
          $job->myob_id = $job_myob->UID;
          $job->save();
        }

      }

    }

    public function expenses(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();

      $emp = Employee::find(124);
      $job = Job::find
      //dd($emp);
      $empMyob = $myob_auth->_makeGetRequest("Contact/Employee/" . $emp->myob_id);
      //dd($employees->EmployeeStandardPay->UID);
      $empStdPay = $myob_auth->_makeGetRequest("Contact/EmployeeStandardPay/" . $empMyob->EmployeeStandardPay->UID);
      //$employees = $myob_auth->_makeGetRequest("Contact/Employee" . '?$orderby=LastName');

      $exp = new ExpensesMyob($emp, $empMyob->EmployeeStandardPay->UID);

      unset($empStdPay->EmployeePayrollDetails);
      unset($empStdPay->PayFrequency);
      unset($empStdPay->HoursPerPayFrequency);
      unset($empStdPay->Category);
      unset($empStdPay->Memo);
      unset($empStdPay->URI);







      dd([$empStdPay, $exp->obj]);














      foreach ($employees->Items as $employee_myob) {
        if ($employee_myob->Name) {
          // code...
        }
      }
      foreach ($employees->Items as $employee_myob) {

        //return $employee_myob->LastName . ', ' . $employee_myob->FirstName;
        $emp = Employee::where('name', $employee_myob->LastName . ', ' . $employee_myob->FirstName)->get()->first();

        if (count($emp) > 0) {
          $emp->myob_id = $employee_myob->UID;
          $emp->save();
        }

      }

    }


}
