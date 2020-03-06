<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeApplication;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use App\TimeSheet;
use Carbon\Carbon;
use LaravelQRCode\Facades\QRCode;
use QR_Code\Types\QR_Text;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = filter_input(INPUT_GET, 'company', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
        $job = filter_input(INPUT_GET, 'job', FILTER_SANITIZE_SPECIAL_CHARS);


        $employees = DB::select(
                    DB::raw(
                        "select emp.id,
                                emp.name,
                                emp.phone,
                                emp.dob,
                                jobs.code as job_id,
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
                                CAST(emp.sick_bal AS DECIMAL(12,2)) as sick_bal,
                                if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                from employees emp
                                left join jobs
                                on emp.job_id = jobs.id
                                where
                                ".($company == 'all' || is_null($company) ? 'emp.company is not null' : "emp.company = '$company'" )."
                                and
                                ".(is_null($job) ? '1=1' : "jobs.id = '$job'" )."
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
        $employee->car_allowance = $request->get('car_allowance');
        $employee->pld = $request->get('pld');
        $employee->rdo_bal = $request->get('rdo_bal');
        $employee->anl = $request->get('anl');
        $employee->dob = is_null($request->get('dob')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dob'));
        $employee->anniversary_dt = is_null($request->get('anniversary_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('anniversary_dt'));
        $employee->company = $request->get('company');
        $employee->bonus_type = $request->get('bonus_type');
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
        $timesheets = TimeSheet::where('employee_id', $id)->get();

        return view('employee.edit', ['employee' =>$employee, 'timesheets' => $timesheets]);
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
        $employee->car_allowance = $request->get('car_allowance');
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
        $employee->entitled_anl = false;
        $employee->entitled_pld = false;
        $employee->bonus_type = $request->get('bonus_type');

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


        //Getting Sick Leave
        $isSick = false;
        foreach ($contents as $key => $line) {

            if (strtolower(substr($line, 0, 4)) == 'sick') {
                $isSick = true;
            }

            if ($isSick && (substr($line, 0, 1) != '"' && strtolower(substr($line, 0, 4)) != 'sick')) {
                $isSick = false;
            }

            if ($isSick && substr($line, 0, 1) == '"') {
                $line = str_replace('"', '', str_replace('",', ';', $line));
                $entitlement = explode(";", $line);
                $value = rtrim(ltrim($entitlement[1]));
                $name = explode(",", $entitlement[0]);
                $lastName = rtrim(ltrim(strtolower($name[0])));
                $firstName = isset($name[1]) ? rtrim(ltrim(strtolower($name[1]))) : '';

                if (isset($entitlements['sick_bal'])) {
                    array_push($entitlements['sick_bal'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
                } else {
                    $entitlements['sick_bal'] = [];
                    array_push($entitlements['sick_bal'], array("firstName" => $firstName, "lastName" => $lastName, "value" => $value));
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
            case 'qr_code':
                  $employee = Employee::find($id);

                  $url = new QR_Text("{\"id\": $employee->id, \"name\": \"$employee->name\" }");

                  $file_path = 'tmp/qr_code_' . $employee->id . '_'. str_replace(' ', '', strtolower($employee->name)).'.png';

                  $url->setOutfile($file_path)->png();

                  return response()->download($file_path)->deleteFileAfterSend(true);

            case 'update_job':
                return $this->updateJob();
                break;

            case 'generate_employee':

                    $app = EmployeeApplication::find($id);
                    $exists = Employee::where('name', strtoupper($app->last_name . ", " . $app->first_name))->get()->first();
                    if (count($exists) == 0) {

                      $employee = new Employee();
                      $employee->name = strtoupper($app->last_name . ", " . $app->first_name);
                      $employee->phone = $app->mobile;
                      $employee->bonus = 0;
                      $employee->pld = 0;

                      $employee->rdo_bal = 0;
                      $employee->anl = 0;
                      $employee->dob = $app->dob;

                      $employee->anniversary_dt = null;

                      $employee->apprentice_year =  $app->apprentice_year == "0" ? "" : $app->apprentice_year;


                      $employee->inactive = false;
                      $employee->company = 'C';
                      $employee->location = $app->role;
                      $employee->rdo = $app->paid_basis == "F" ? true : false;
                      $employee->travel = $app->paid_basis == "F" ? true : false;
                      $employee->site_allow = $app->paid_basis == "F" ? true : false;
                      $employee->save();


                    echo "<script>alert('Employee ".strtoupper($app->last_name . ", " . $app->first_name)." Included!');</script>";

                  } else {
                    echo "<script>alert('Employee ".strtoupper($app->last_name . ", " . $app->first_name)." already exists!');</script>";
                  }
                  return "<script>window.close();</script>";
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
                                  jobs.code as job_id,
                                  emp.anniversary_dt,
                                  emp.apprentice_year,
                                  emp.company,
                                  CAST(emp.rdo_bal AS DECIMAL(12,2)) as rdo_bal,
                                  CAST(emp.pld AS DECIMAL(12,2)) as pld,
                                  CAST(emp.anl AS DECIMAL(12,2)) as anl,
                                  if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                                  (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                  from employees emp
                                  left join jobs
                                  on emp.job_id = jobs.id

                                  where
                                  emp.id in ($id)
                                  order by emp.name asc
                           ")
            );
          $report->add($employees);
        } elseif ($action == 'awareness') {
          foreach ($ids as $id) {
              $employee = Employee::find($id);
              if ($employee) {

                  $report->add($employee);
              }
          }
        }
        else {
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

    public function updateJob()
    {

      $timesheets = DB::select(
                  DB::raw(
                      "
                      select * from (
                          select ts.id,
                            users.username,
                                ts.created_at,
                                ts.employee_id,
                                emp.name,
                                ts.total,
                                ts.total_15,
                                ts.total_20,
                                ts.week_end,
                                ts.status,
                                ts.integrated,
                                ts.integration_message,
                                (
                                select code from (
                                  select
                                  jobs.code,
                                  sum(job.end - job.start) as total,
                                  time_sheets.id as ts_id
                                  from time_sheets
                                  join days
                                  on time_sheets.id = days.time_sheet_id
                                  join day_jobs job
                                  on job.day_id = days.id
                                  join jobs
                                  on jobs.id = job.job_id
                                  group by jobs.code, time_sheets.id
                                ) as job where ts_id = ts.id order by total desc limit 1 ) as job

                        from time_sheets ts
                        inner join users
                        on ts.user_id = users.id
                        inner join employees emp
                        on emp.id = ts.employee_id
                        where " .

                        ("ts.week_end = '" .  Carbon::parse(\App\Parameters::all()->first()->week_end_timesheet)->format('Y-m-d') . "'")
                          . ") timesheets " .

                        "where " . ("1=1") .

                        " order by name asc"
                  )
                );

      foreach ($timesheets as $timesheet) {

        $emp = Employee::find($timesheet->employee_id);

        if (count($emp) > 0) {

          $emp->job_id = Job::where("code", $timesheet->job)->value('id');

          $emp->save();

        }
      }

    return redirect('/employees?params=true')->with('success', 'Employee Job has been updated. Total (' . count($timesheets) .')' );
  }

}
