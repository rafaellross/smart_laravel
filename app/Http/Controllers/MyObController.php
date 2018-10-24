<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeSheet;
use App\TimeSheetMyOb;
use App\Employee;

class MyObController extends Controller
{
    public function index() {

        $myob_auth = new \App\MYOB\AccountRightV2();

        $companies = $myob_auth->_makeGetRequest();

        return view('myob.index', ['companies' => $companies]);

    }

    public function integrate(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();
      //$employees = $myob_auth->_makeGetRequest($request->get('guid') ."/Contact/Employee" . '?$orderby=LastName&&$filter=startswith(LastName,' .  "'WOO')");
      //$employees = $myob_auth->_makeGetRequest($request->get('guid') .'/Contact/Employee?$select=LastName');
      //$categories = $myob_auth->_makeGetRequest($request->get('guid') .'/Payroll/PayrollCategory');
      //dd($categories);
      //$url = $request->get('guid') ."/Contact/Employee" . '?$orderby=LastName&&$filter=not endswith(LastName' . ",'zz')";

      $timesheet = TimeSheet::find(2407);
      $timesheet_myob = new TimeSheetMyOb($timesheet);
      $result = array();

      //array_push($result, $timesheet_myob->Lines());

      //dd($timesheet_myob->Lines());
      dd($myob_auth->_makePutRequest($request->get('guid').'/Payroll/Timesheet/' . $timesheet->employee->myob_id . '?api-version=v2', $timesheet_myob->obj));

      //dd($myob_auth);

      //return view('myob.employees', ['employees' => $employees->Items]);

    }

    public function employees(Request $request) {
      $myob_auth = new \App\MYOB\AccountRightV2();
      $employees = $myob_auth->_makeGetRequest($request->get('guid') ."/Contact/Employee" . '?$orderby=LastName');

      foreach ($employees->Items as $employee_myob) {
        //return $employee_myob->LastName . ', ' . $employee_myob->FirstName;
        $emp = Employee::where('name', $employee_myob->LastName . ', ' . $employee_myob->FirstName)->get()->first();

        if (count($emp) > 0) {
          $emp->myob_id = $employee_myob->UID;
          $emp->save();
        }
        //return $emp;
      }
      //$employees = $myob_auth->_makeGetRequest($request->get('guid') .'/Contact/Employee?$select=LastName');
      //$categories = $myob_auth->_makeGetRequest($request->get('guid') .'/Payroll/PayrollCategory');
      dd($employees);
      //$url = $request->get('guid') ."/Contact/Employee" . '?$orderby=LastName&&$filter=not endswith(LastName' . ",'zz')";

      $timesheet = TimeSheet::find(2406);
      $timesheet_myob = new TimeSheetMyOb($timesheet);
      $result = array();

      //array_push($result, $timesheet_myob->Lines());

      //dd($timesheet_myob->Lines());
      dd($myob_auth->_makePutRequest($request->get('guid').'/Payroll/Timesheet/' . $timesheet->employee->myob_id . '?api-version=v2', $timesheet_myob->obj));

      //dd($myob_auth);

      //return view('myob.employees', ['employees' => $employees->Items]);


    }

}
