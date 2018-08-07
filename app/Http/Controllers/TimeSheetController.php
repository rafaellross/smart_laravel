<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use App\WeekDay;
use App\Employee;
use App\Day;
use App\DayJob;
use App\Hour;
use App\Job;
use App\TimeSheetReport;
use App\TimeSheetCertificate;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
class TimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

        if (is_null($status)) {
          $status = 'P';
        }

        //Filters

        $filter = array();

        $filter["status"] = [
              ["code" => "all", "description" => "All"],
              ["code" => "A", "description" => "Approved"],
              ["code" => "F", "description" => "Finalised"],
              ["code" => "P", "description" => "Pending"],
              ["code" => "C", "description" => "Cancelled"],
              ["code" => "T", "description" => "Mais Um"]
        ];


        $timesheets = DB::select(
                    DB::raw(
                        "select ts.id,
                      		users.username,
                              ts.created_at,
                              emp.name,
                              ts.total,
                              ts.total_15,
                              ts.total_20,
                              ts.week_end,
                              ts.status

                      from time_sheets ts
                      inner join users
                      on ts.user_id = users.id
                      inner join employees emp
                      on emp.id = ts.employee_id
                      where " .
                      (Auth::user()->administrator ? "1=1" : 'ts.user_id = ' . Auth::user()->id) . " and " .
                      ($status == 'all' ? "1=1" : "ts.status = '" . $status . "'") . " " .
                      " order by emp.name asc"
                    )
                  );

        return view('timesheet.index', ['timesheets' => $timesheets, 'filter' => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($employee)
    {
        $days = WeekDay::all();

        $employees = Employee::whereRaw("id in ($employee)")->get();
        return view('timesheet.create', ['days' => $days, 'employees' => $employees]);
    }

    public function select(){
        return view('timesheet.select');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $this->validate(request(), [
            'week_end' => 'required|date_format:d/m/Y'
        ]);

        //Validate rdo, pld and annual leave
        $errors = [];
        foreach ($request->get('employees') as $employee_id => $value) {
            $employee = Employee::find($employee_id);

            //Validate rdo
            $rdo = 0;
            $pld = 0;
            $anl = 0;
            $sick = 0;

            $rdo += $request->get('rdo') > 0 ? $request->get('rdo')/60 : 0;
            $pld += $request->get('pld') > 0 ? $request->get('pld')/60 : 0;
            $anl += $request->get('anl') > 0 ? $request->get('anl')/60 : 0;
            $sick += $request->get('anl') > 0 ? $request->get('anl')/60 : 0;
            foreach ($request->get('days') as $key => $day) {
                foreach ($day as $key => $job) {
                    if (isset($job["job"])) {
                        if ($job["job"] == "rdo") {
                            $rdo += $job["hours"] > 0 ? Hour::convertToDecimal($job["hours"]) : 0;
                        }
                        if ($job["job"] == "pld") {
                            $pld += $job["hours"] > 0 ? Hour::convertToDecimal($job["hours"]) : 0;
                        }

                        if ($job["job"] == "anl") {
                            $anl += $job["hours"] > 0 ? Hour::convertToDecimal($job["hours"]) : 0;
                        }
                        if ($job["job"] == "sick") {
                            $sick += $job["hours"] > 0 ? Hour::convertToDecimal($job["hours"]) : 0;
                        }

                    }
                }
            }
            if ($rdo > 0 && ($rdo) > $employee->rdo_bal) {
                array_push($errors, "Employee: " . $employee->name . " doesn't have enough RDO to request " . round($rdo, 2) . " hours! Balance: " . $employee->rdo_bal);
            }

            if ($pld > 0 && ($pld) > $employee->pld) {
                array_push($errors, "Employee: " . $employee->name . " doesn't have enough PLD to request " . round($pld, 2) . " hours! Balance: " . $employee->pld);
            }

            if ($anl > 0 && ($anl) > $employee->anl) {
                array_push($errors, "Employee: " . $employee->name . " doesn't have enough Annual Leave to request " . round($anl, 2) . " hours! Balance: " . $employee->anl);
            }

            if ($sick > 0 && ($sick) > $employee->sick_bal) {
                array_push($errors, "Employee: " . $employee->name . " doesn't have enough Sick Leave to request " . round($sick, 2) . " hours! Balance: " . $employee->sick_bal);
            }


        }
        if (count($errors) > 0) {
            array_push($errors, "");
            array_push($errors, "");
            array_push($errors, "Fix it and try again! ");
            return redirect('/timesheets')->withInput()->with('error', $errors);
        }


        foreach ($request->get('employees') as $employee_id => $value) {


            $timeSheet = new TimeSheet();
            $timeSheet->emp_signature   = $request->get('emp_signature');
            $timeSheet->employee_id     = $employee_id;
            $timeSheet->week_end        = Carbon::createFromFormat('d/m/Y', $request->get('week_end'));
            $timeSheet->rdo             = $request->get('rdo');
            $timeSheet->pld             = $request->get('pld');
            $timeSheet->anl             = $request->get('anl');

            $totals = $request->get('totals');
            $timeSheet->total           = $totals['total'];
            $timeSheet->normal          = $totals['normal'];
            $timeSheet->total_15        = $totals['1.5'];
            $timeSheet->total_20        = $totals['2.0'];

            $timeSheet->user_id         = Auth::id();
            $timeSheet->status          = $request->get('status');
            $timeSheet->save();


            foreach ($request->get('days') as $key => $day) {
                $weekDay                        = WeekDay::where("short", "=", $key)->get()->first();
                $dayTimeSheet                   = new Day();
                $dayTimeSheet->week_day         = $weekDay->number;
                $dayTimeSheet->day_dt           = Carbon::instance($timeSheet->week_end)->subDays($weekDay->days_to_end);

                $dayTimeSheet->total           = $day['total']['total'];
                $dayTimeSheet->normal          = $day['total']['normal'];
                $dayTimeSheet->total_15        = $day['total']['1.5'];
                $dayTimeSheet->total_20        = $day['total']['2.0'];

                $dayTimeSheet->total_night           = $day['total']['total_night'];
                $dayTimeSheet->normal_night          = $day['total']['normal_night'];
                $dayTimeSheet->total_15_night        = $day['total']['total_15_night'];
                $dayTimeSheet->total_20_night        = $day['total']['total_20_night'];

                $dayTimeSheet->time_sheet_id    = $timeSheet->id;
                $dayTimeSheet->save();

                foreach ($day as $key => $job) {

                    if (intval($key)) {
                        $dayJob               = new DayJob();
                        $dayJob->job_id       = !isset($job["job"]) ? null : Job::where("code", $job["job"])->value('id');
                        $dayJob->day_id       = $dayTimeSheet->id;
                        $dayJob->number       = $key;
                        $dayJob->description  = $job["description"];
                        $dayJob->start        = !isset($job["start"]) ? null : $job["start"];
                        $dayJob->end          = !isset($job["end"]) ? null : $job["end"];
                        $dayJob->night_work   = !isset($job["night_work"]) ? false : $job["night_work"];
                        $dayJob->save();
                    }
                }
            }

            if (!empty($request->get('medical_certificates')) > 0) {
                $certificate_number = 1;
                foreach ($request->get('medical_certificates') as $value) {
                    if (!is_null($value)) {
                        $certificate = new TimeSheetCertificate();
                        $certificate->time_sheet_id = $timeSheet->id;
                        $certificate->certificate_img = $value;
                        $certificate->certificate_number = $certificate_number;
                        $certificate->save();
                        $certificate_number++;
                    }
                }
            }

        }

        return redirect('/timesheets')->with('success', 'Time Sheet has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $timesheet = TimeSheet::find($id);


        $pdf = TimeSheetReport::add($timesheet);
        $pdf->Open('doc.pdf');
        $pdf->output('F', 'TimeSheets.pdf');
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generate = filter_input(INPUT_GET, 'generate', FILTER_SANITIZE_SPECIAL_CHARS);
        //return $generate;
        $timesheet = TimeSheet::find($id);

        return view('timesheet.edit', ['timesheet' => $timesheet]);
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
        $this->validate(request(), [
            'week_end' => 'required|date_format:d/m/Y'
        ]);

        $timeSheet = TimeSheet::find($id);

        $timeSheet->week_end        = Carbon::createFromFormat('d/m/Y', $request->get('week_end'));
        $timeSheet->emp_signature   = $request->get('emp_signature');
        $timeSheet->rdo             = $request->get('rdo');
        $timeSheet->pld             = $request->get('pld');
        $timeSheet->anl             = $request->get('anl');

        $totals = $request->get('totals');
        $timeSheet->total           = $totals['total'];
        $timeSheet->normal          = $totals['normal'];
        $timeSheet->total_15        = $totals['1.5'];
        $timeSheet->total_20        = $totals['2.0'];

        $timeSheet->user_id         = Auth::id();
        $timeSheet->status          = $request->get('status');
        $timeSheet->save();

        foreach ($timeSheet->days as $day) {
                foreach ($day->dayJobs as $job) {
                    $job->delete();
                }
                $day->delete();
        }

        foreach ($request->get('days') as $key => $day) {

            $weekDay                        = WeekDay::where("short", "=", $key)->get()->first();
            $dayTimeSheet                   = new Day();
            $dayTimeSheet->week_day         = $weekDay->number;
            $dayTimeSheet->day_dt           = Carbon::instance($timeSheet->week_end)->subDays($weekDay->days_to_end);
            $dayTimeSheet->total           = $day['total']['total'];
            $dayTimeSheet->normal          = $day['total']['normal'];
            $dayTimeSheet->total_15        = $day['total']['1.5'];
            $dayTimeSheet->total_20        = $day['total']['2.0'];

            $dayTimeSheet->total_night           = $day['total']['total_night'];
            $dayTimeSheet->normal_night          = $day['total']['normal_night'];
            $dayTimeSheet->total_15_night        = $day['total']['total_15_night'];
            $dayTimeSheet->total_20_night        = $day['total']['total_20_night'];

            $dayTimeSheet->time_sheet_id    = $timeSheet->id;
            $dayTimeSheet->save();

            foreach ($day as $key => $job) {

                if (intval($key)) {
                    //return $job;
                    $dayJob               = new DayJob();
                    $dayJob->job_id       = !isset($job["job"]) ? null : Job::where("code", $job["job"])->value('id');
                    $dayJob->day_id       = $dayTimeSheet->id;
                    $dayJob->number       = $key;
                    $dayJob->description  = $job["description"];
                    $dayJob->start        = $job["start"];
                    $dayJob->end          = $job["end"];
                    $dayJob->night_work   = !isset($job["night_work"]) ? false : $job["night_work"];
                    $dayJob->save();
                }
            }
        }
        $certificates = TimeSheetCertificate::where('time_sheet_id', $timeSheet->id)->get();

        foreach ($timeSheet->certificates as $certificate) {
            $certificate->delete();
        }

        if (!empty($request->get('medical_certificates')) > 0) {
            $certificate_number = 1;
            foreach ($request->get('medical_certificates') as $value) {
                if (!is_null($value)) {
                    $certificate = new TimeSheetCertificate();
                    $certificate->time_sheet_id = $timeSheet->id;
                    $certificate->certificate_img = $value;
                    $certificate->certificate_number = $certificate_number;
                    $certificate->save();
                    $certificate_number++;
                }
            }
        }

        $generated = filter_input(INPUT_GET, 'generated', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($generated == 1) {

          return "<script>window.close();</script>";
        } else {
            return redirect('/timesheets')->with('success', 'Time Sheet has been updated');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timesheet = TimeSheet::find($id);
        $timesheet->delete();
        return redirect('timesheets')->with('success','Time Sheet has been  deleted');
    }

    public function action($id, $action, $status = null)
    {

        $ids = explode(",", $id);

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    $timesheet = TimeSheet::find($id);
                    foreach ($timesheet->days as $day) {
                      foreach ($day as $job) {
                        if (isset($job->id)) {
                          $job->delete();
                        }

                      }
                      $day->delete();
                    }
                    $timesheet->delete();

                }
                return redirect('timesheets')->with('success','Time Sheet(s) has been deleted');
                break;
            case 'update':
                foreach ($ids as $id) {
                    $timesheet = TimeSheet::find($id);
                    $timesheet->status = $status;
                    $timesheet->save();
                }
                return redirect('timesheets?filter=1')->with('success','Time Sheet(s) has been updated');
                break;
            case 'print':

                $report = new TimeSheetReport();
                $report->SetCompression(true);
                foreach ($ids as $id) {
                    $timesheet = TimeSheet::find($id);
                    if ($timesheet) {
                        $report->add($timesheet);
                    }
                }
                return $report->output();
                break;

            default:
                return redirect('timesheets')->with('error','There was no action selected');
                break;
        }
    }
}
