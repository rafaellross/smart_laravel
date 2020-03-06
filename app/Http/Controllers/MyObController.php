<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeSheet;
use App\TimeSheetMyOb;
use App\Employee;
use App\Job;
use App\ExpensesMyob;
use Carbon\Carbon;

class MyObController extends Controller
{
    public function index() {

        $myob_auth = new \App\MYOB\AccountRightV2();

        $companies = $myob_auth->_makeGetRequest();

        return redirect('myob/jobs');

    }

    public function integrate(Request $request) {

      $timesheet = TimeSheet::find($request->get('id'));

      //Check if system has no employee Id from MYOB
      if (is_null($timesheet->employee->myob_id)) {

        $timesheet->integration_message = "Employee doesn't exist on MYOB or name is different";
        $timesheet->save();
        return response()->json(["name" => $timesheet->employee->name, "result" => $timesheet->integration_message]);

      } else {

        $myob_auth = new \App\MYOB\AccountRightV2();



        $timesheet_myob = new TimeSheetMyOb($timesheet);


        //Determine employee job


        $this->stdPay($timesheet->employee_id, $timesheet->topJob()->id, $myob_auth, $timesheet->bonus());


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


    }

    /**
     * Update all employees with MYOB Id.
     *
     * @return void
     */


    public function employees(Request $request) {

      $myob_auth = new \App\MYOB\AccountRightV2();

      $employees = $myob_auth->_makeGetRequest("Contact/Employee" . '?$orderby=LastName');

      //Update ID from MYOB on system
      foreach ($employees->Items as $employee_myob) {

        $emp = Employee::where('name', $employee_myob->LastName . ', ' . $employee_myob->FirstName)->get()->first();


        if (count($emp) > 0) {
          $emp->myob_id = $employee_myob->UID;
          $emp->save();
        }
      }

      //Update employee details

      $employeesDetails = $myob_auth->_makeGetRequest("Contact/EmployeePayrollDetails");

      foreach ($employeesDetails->Items as $employeeDetails) {

        $emp = Employee::where('myob_id', $employeeDetails->Employee->UID)->get()->first();

        if (count($emp) > 0) {

          $emp->dob = Carbon::parse($employeeDetails->DateOfBirth);


          $arr_apprentices = ["1st Year Apprentice", "2nd Year Apprentice", "3rd Year Apprentice", "4th Year Apprentice"];

          //Check apprentice year

          if (isset($employeeDetails->EmploymentClassification->Name) && in_array($employeeDetails->EmploymentClassification->Name, $arr_apprentices)) {

            $year = $employeeDetails->EmploymentClassification->Name[0];
            $emp->location = 'A';
            $emp->apprentice_year = $year;


          }

          $emp->save();

        }

      }

      $companies = $myob_auth->_makeGetRequest();

      return view('myob.index', ['companies' => $companies])->with('success','Jobs has been updated');

    }

    /**
     * Update all jobs with MYOB Id.
     *
     * @return void
     */
    public function jobs(Request $request) {

      $myob_auth = new \App\MYOB\AccountRightV2();

      $jobs = $myob_auth->_makeGetRequest('GeneralLedger/Job');

      foreach ($jobs->Items as $job_myob) {

        $job = Job::where('code', $job_myob->Number)->get()->first();

        if (count($job) > 0) {

          $job->myob_id = $job_myob->UID;

          $job->save();

        }

      }

      return redirect('myob/entitlements');

    }

    public function stdPay($employee_id, $job_id, $myob_auth, $bonus = null) {

      $emp = Employee::find($employee_id);

      $job = Job::find($job_id);

      $empMyob = $myob_auth->_makeGetRequest("Contact/Employee/" . $emp->myob_id);

      $empStdPay = $myob_auth->_makeGetRequest("Contact/EmployeeStandardPay/" . $empMyob->EmployeeStandardPay->UID);

      foreach ($empStdPay->PayrollCategories as $category) {

        if (
            $category->PayrollCategory->Type == "Expense" ||
            $category->PayrollCategory->Type == "Superannuation" ||
            strtolower($category->PayrollCategory->Name) == "bonus foremen" ||
            strtolower($category->PayrollCategory->Name) == "bonus leading hand" ||
            strtolower($category->PayrollCategory->Name) == "foreman" ||
            strtolower($category->PayrollCategory->Name) == "bonus leading hand" ||
            substr(strtolower($category->PayrollCategory->Name), 0, 13) == "car allowance"


            ) {


          if (strtolower($category->PayrollCategory->Name) == "bonus foremen" || strtolower($category->PayrollCategory->Name) == "bonus leading hand" || strtolower($category->PayrollCategory->Name) == "foreman") {
            $category->Amount = $bonus;
          }

          if (substr(strtolower($category->PayrollCategory->Name), 0, 13) == "car allowance") {
            if ($emp->car_allowance > 0) {
              $category->Amount = $emp->car_allowance;
            }

          }

          $category->Job = (object)array('UID' => $job->myob_id);

        }

      }

      $req = $myob_auth->_makePutRequest("Contact/EmployeeStandardPay/" . $empMyob->EmployeeStandardPay->UID, $empStdPay);

    }

    public function categories() {
      $myob_auth = new \App\MYOB\AccountRightV2();
      $categories = $myob_auth->_makeGetRequest("Payroll/PayrollCategory");
      return json_encode($categories);
    }

    public function payroll() {
      $myob_auth = new \App\MYOB\AccountRightV2();
      $payroll = $myob_auth->_makeGetRequest("Report/Payroll/EmployeePayrollAdvice");
      return json_encode($payroll);

    }

    public function entitlements() {

      $myob_auth = new \App\MYOB\AccountRightV2();
      $entitlements = $myob_auth->_makeGetRequest("Contact/EmployeePayrollDetails");

      $result = array();

      foreach ($entitlements->Items as $entitlement) {
        $emp_entitlements = array();
        foreach ($entitlement->Entitlements as $emp_entitlement) {
          array_push($emp_entitlements, ["UID" => $emp_entitlement->EntitlementCategory->UID, 'Name' => $emp_entitlement->EntitlementCategory->Name,'Total' => $emp_entitlement->Total]);
        }
        array_push($result, ['employee' => $entitlement->Employee->UID, 'employee_name' => $entitlement->Employee->Name, 'entitlements' => $emp_entitlements]);

      }

      foreach ($result as $employee) {
        $emp = Employee::where('myob_id', $employee['employee'])->get()->first();
        if (isset($emp) ) {
          foreach ($employee['entitlements'] as $entitlement) {
              if ($entitlement['Name'] == "Sick Leave Accrual") {
                $emp->sick_bal = $entitlement['Total'];
              }

              if ($entitlement['Name'] == "Holiday Leave Accrual") {
                $emp->anl = $entitlement['Total'];
              }

              if ($entitlement['Name'] == "RDO-Tradesman Accrual") {
                $emp->rdo_bal = $entitlement['Total'];
              }

              if ($entitlement['Name'] == "PLD - Tradesmen Accrual") {
                $emp->pld = $entitlement['Total'];
              }

              if ($entitlement['Name'] == "PLD - OFFICE" && !$emp->site_allow) {
                $emp->pld = $entitlement['Total'];
              }

              $emp->save();

          }
        }
      }

      return redirect('myob/employees');

    }

    public function stdPays() {
      $emps = Employee::all();
      $myob_auth = new \App\MYOB\AccountRightV2();
      foreach ($emps as $emp) {
        $empMyob = $myob_auth->_makeGetRequest("Contact/Employee/" . $emp->myob_id);
        if (isset($empMyob->EmployeeStandardPay)) {


          $empStdPay = $myob_auth->_makeGetRequest("Contact/EmployeeStandardPay/" . $empMyob->EmployeeStandardPay->UID);

          foreach ($empStdPay->PayrollCategories as $category) {

            if ($category->PayrollCategory->UID == "944fef3e-8ecd-46a8-88f3-c45062ad5a35") {

                $category->Hours = 0;
                $category->Amount = 0;

            }

          }
          $req = $myob_auth->_makePutRequest("Contact/EmployeeStandardPay/" . $empMyob->EmployeeStandardPay->UID, $empStdPay);
          echo $emp->name;
        }


      }
    }

    public function updateAllData(Request $request) {

      // Entitlements
      $this->entitlements();
      // Employee Details
      $this->employees($request);
      // Jobs
      $this->jobs($request);

    }


    public function integrateTest($id) {

      $timesheet = TimeSheet::find($id);





      $timesheet_myob = new TimeSheetMyOb($timesheet);


      //Determine employee job




      return response()->json($timesheet_myob);



    }
}
