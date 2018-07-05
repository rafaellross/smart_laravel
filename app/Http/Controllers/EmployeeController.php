<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = filter_input(INPUT_GET, 'company', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);


        $employees = DB::select(
                    DB::raw(
                        "select emp.id,
                                emp.name,
                                emp.phone,
                                emp.dob,
                                case
                                when emp.location = 'P' then 'Plumber'
                                when emp.location = 'O' then 'Office'
                                when emp.location = 'A' then 'Apprentice'
                                when emp.location = 'L' then 'Labourer'
                                end location,
                                emp.anniversary_dt,
                                emp.apprentice_year,
                                CAST(emp.rdo_bal AS DECIMAL(12,2)) as rdo_bal,
                                CAST(emp.pld AS DECIMAL(12,2)) as pld,
                                CAST(emp.anl AS DECIMAL(12,2)) as anl,
                                if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                from employees emp
                                where
                                ".($company == 'all' || is_null($company) ? 'emp.company is not null' : "emp.company = '$company'" )."
                                and
                                " . ($company == 'all' ? 'emp.inactive is not null' :  'emp.inactive = 0'). "
                                and " . ($type == 'all' || $type == 'missing'  || is_null($type) ? '1=1' : " emp.location = '$type'")
                                . " and "
                                . ($type == 'missing' ? '(select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) is null' : " 1=1")
                                . " order by emp.name asc"));

        return view('employee.index', ['employees' => $employees, 'params' => $_GET]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $employee = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'bonus' => 'required|numeric|min:0',
            'pld' => 'required|numeric|min:0',
            'rdo_bal' => 'required|numeric|min:0',
            'anl' => 'required|numeric|min:0',
            'dob' => 'date_format:d/m/Y'
        ]);

        $employee = new Employee();
        $employee->name = $request->get('name');
        $employee->phone = $request->get('phone');
        $employee->bonus = $request->get('bonus');
        $employee->pld = $request->get('pld');
        $employee->rdo_bal = $request->get('rdo_bal');
        $employee->anl = $request->get('anl');
        $employee->dob = is_null($request->get('dob')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dob'));
        $employee->anniversary_dt = is_null($request->get('anniversary_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('anniversary_dt'));
        $employee->company = $request->get('company');
        $employee->apprentice_year = $request->get('apprentice_year');

        $employee->location = $request->get('location');

        $employee->inactive = $request->get('inactive');

        if ($request->get('entitlements') !== null) {
            foreach ($request->get('entitlements') as $entitlement) {
                $employee->{$entitlement} = true;
            }
        }


        $employee->save();
        return redirect('/employees?params=true')->with('success', 'Employee has been added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit',compact('employee','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'bonus' => 'required|numeric|min:0',
            'pld' => 'required|numeric|min:0',
            'rdo_bal' => 'required|numeric|min:0',
            'anl' => 'required|numeric|min:0',
            'dob' => 'date_format:d/m/Y'
        ]);

        $employee = Employee::find($id);
        $employee->name = $request->get('name');
        $employee->phone = $request->get('phone');
        $employee->bonus = $request->get('bonus');
        $employee->pld = $request->get('pld');
        $employee->rdo_bal = $request->get('rdo_bal');
        $employee->anl = $request->get('anl');
        $employee->dob = is_null($request->get('dob')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dob'));

        $employee->anniversary_dt = is_null($request->get('anniversary_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('anniversary_dt'));

        $employee->apprentice_year = $request->get('apprentice_year');

        $employee->location = $request->get('location');

        $employee->inactive = $request->get('inactive');
        $employee->company = $request->get('company');
        $employee->rdo = false;
        $employee->travel = false;
        $employee->site_allow = false;


        if ($request->get('entitlements') !== null) {
            foreach ($request->get('entitlements') as $entitlement) {
                $employee->{$entitlement} = true;
            }
        }

        $employee->save();
        return redirect('/employees?params=true')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id){
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('employees?params=true')->with('success','Employee has been  deleted');
    }

    public function updateEntitlements(Request $request)
    {
        $contents = [];

        if ($request->hasFile('entitlements_balance')) {
             $contents = file($request->file('entitlements_balance'));
        } else {
            return redirect('/employees?params=true')->with('error','The uploaded file is not valid!');
        }

        $entitlements = array();

        //Getting PLD
        $isPLD = false;
        foreach ($contents as $key => $line) {

            if (strtolower(substr($line, 0, 3)) == 'pld') {
                $isPLD = true;
            }

            if ($isPLD && (substr($line, 0, 1) != '"' && strtolower(substr($line, 0, 3)) != 'pld')) {
                $isPLD = false;
            }

            if ($isPLD && substr($line, 0, 1) == '"') {

                $line = str_replace('"', '', str_replace('",', ';', $line));
                $entitlement = explode(";", $line);
                $value = rtrim(ltrim($entitlement[1]));
                $name = explode(",", $entitlement[0]);
                $lastName = rtrim(ltrim(strtolower($name[0])));
                $firstName = isset($name[1]) ? rtrim(ltrim(strtolower($name[1]))) : '';

                if (isset($entitlements['pld'])) {
                    array_push($entitlements['pld'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                 } else {
                    $entitlements['pld'] = [];
                    array_push($entitlements['pld'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                 }
            }
        }

        //Getting RDO
        $isRDO = false;
        foreach ($contents as $key => $line) {

            if (strtolower(substr($line, 0, 3)) == 'rdo') {
                $isRDO = true;
            }

            if ($isRDO && (substr($line, 0, 1) != '"' && strtolower(substr($line, 0, 3)) != 'rdo')) {
                $isRDO = false;
            }

            if ($isRDO && substr($line, 0, 1) == '"') {
                $line = str_replace('"', '', str_replace('",', ';', $line));
                $entitlement = explode(";", $line);
                $value = rtrim(ltrim($entitlement[1]));
                $name = explode(",", $entitlement[0]);
                $lastName = rtrim(ltrim(strtolower($name[0])));
                $firstName = isset($name[1]) ? rtrim(ltrim(strtolower($name[1]))) : '';

                if (isset($entitlements['rdo_bal'])) {
                    array_push($entitlements['rdo_bal'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                 } else {
                    $entitlements['rdo_bal'] = [];
                    array_push($entitlements['rdo_bal'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                 }
            }
        }

        //Getting ANL
        $isAnl = false;
        foreach ($contents as $key => $line) {

            if (strtolower(substr($line, 0, 7)) == 'holiday') {
                $isAnl = true;
            }

            if ($isAnl && (substr($line, 0, 1) != '"' && strtolower(substr($line, 0, 7)) != 'holiday')) {
                $isAnl = false;
            }

            if ($isAnl && substr($line, 0, 1) == '"') {
                $line = str_replace('"', '', str_replace('",', ';', $line));
                $entitlement = explode(";", $line);
                $value = rtrim(ltrim($entitlement[1]));
                $name = explode(",", $entitlement[0]);
                $lastName = rtrim(ltrim(strtolower($name[0])));
                $firstName = isset($name[1]) ? rtrim(ltrim(strtolower($name[1]))) : '';

                if (isset($entitlements['anl'])) {
                    array_push($entitlements['anl'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                } else {
                    $entitlements['anl'] = [];
                    array_push($entitlements['anl'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                }
            }
        }
        $result = [];

        foreach ($entitlements as $entitlement => $employees) {
            foreach ($employees as $employee) {
              try {
                    $emp = Employee::where("name", 'LIKE', '%' . $employee['firstName'] . '%')
                    ->where("name", 'LIKE', '%' . $employee['lastName'] . '%')->first();
                    if ($emp) {
                        $emp->{$entitlement} = isset($employee['value']) ? $employee['value'] : 0;
                        $emp->save();
                        array_push($result, $emp);
                    }

                } catch (Exception $e) {
                    return $e;
                }
            }

        }
        return redirect('employees')->with('success','Entitlements were updated!');
    }
    //This action prints all employee's reports
    public function action($id, $action, $param = null)
    {

        $ids = explode(",", $id);
        $report = null;

        switch ($action) {
            //Print certificate of awareness
            case 'awareness':

                  $report = new \App\Reports\Employees\CertificateAwareness();

                  break;

            case 'id':

                  $report = new \App\Reports\Employees\Card();

                  break;

            case 'list':

                  $report = new \App\Reports\Employees\EmployeesList();

                  break;


            default:
                return redirect('employees')->with('error','There was no action selected');
                break;
        }

        $report->AddPage();

        $report->AliasNbPages();
        if ($action == 'list') {
          $employees = DB::select(
                      DB::raw(
                          "select emp.id,
                                  emp.name,
                                  emp.phone,
                                  emp.dob,
                                  case
                                  when emp.location = 'P' then 'Plumber'
                                  when emp.location = 'O' then 'Office'
                                  when emp.location = 'A' then 'Apprentice'
                                  when emp.location = 'L' then 'Labourer'
                                  end location,
                                  emp.anniversary_dt,
                                  emp.apprentice_year,
                                  emp.company,
                                  CAST(emp.rdo_bal AS DECIMAL(12,2)) as rdo_bal,
                                  CAST(emp.pld AS DECIMAL(12,2)) as pld,
                                  CAST(emp.anl AS DECIMAL(12,2)) as anl,
                                  if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                                  (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                  from employees emp
                                  where
                                  emp.id in ($id)
                                  order by emp.name asc
                           ")
            );
          $report->add($employees);
        } else {
            foreach ($ids as $id) {
                $employee = Employee::find($id);
                if ($employee) {
                  if ($report->GetY() > 200 && $action != 'list') {
                    $report->AddPage();
                  }
                    $report->add($employee);
                }
            }
        }

        return $report->output();



    }
}
