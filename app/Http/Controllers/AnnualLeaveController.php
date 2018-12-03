<?php

namespace App\Http\Controllers;

use App\AnnualLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\TimeSheet;

class AnnualLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if (Auth::user()->administrator) {
        $annual_leaves = AnnualLeave::all();
      } else {
        $annual_leaves = AnnualLeave::where('user_id', Auth::user()->id)->get();
      }

        return view('annual_leave.index', ['annual_leaves' => $annual_leaves]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('annual_leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Load variables
        $employee = \App\Employee::find($request->get('employee_id'));
        $start_dt = Carbon::parse($request->get('start_dt'));
        $return_dt = Carbon::parse($request->get('return_dt'));

        //Count annual leave days
        $days = 0;
        for ($i=$start_dt; $i <= $return_dt; $i = $i->addDay()) {
          if (!$i->isWeekend()) {
            $days++;
          }
        }

        //Check if employee has enough entitlement for Annual Leave
        if ( ($days * 8) > $employee->anl ) {
          //If not return alert to user
          return '<script>alert("' . "Employee: " . $employee->name . " doesn't have enough Annual Leave to request " . round(($days * 8), 2) . " hours! Balance: " . $employee->anl . '"); window.history.back();</script>';

        }

        $annual_leave = new AnnualLeave();
        $annual_leave->employee_id = $request->get('employee_id');
        $annual_leave->request_dt = Carbon::parse($request->get('form_dt'));
        $annual_leave->start_dt = $start_dt;
        $annual_leave->emp_signature = $request->get('emp_signature');
        $annual_leave->return_dt = $return_dt;



        $annual_leave->save();

        return redirect('/annual_leave')->with('success', 'Annual Leave Request has been added');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnnualLeave  $annualLeave
     * @return \Illuminate\Http\Response
     */
    public function show(AnnualLeave $annualLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnnualLeave  $annualLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(AnnualLeave $annualLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnnualLeave  $annualLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnualLeave $annualLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnnualLeave  $annualLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnualLeave $annualLeave)
    {
        //
    }

    public function action($id, $action) {
      $ids = explode(",", $id);

      switch ($action) {
        case 'delete':
          foreach ($ids as $id_anl) {

            AnnualLeave::find($id_anl)->delete();

          }

          return redirect('/annual_leave')->with('success', 'Annual Leave Request has been deleted');
          break;

        case 'generate_timesheets':

          $annual_leave = AnnualLeave::find($id);

          $curr_week_end = Carbon::parse($annual_leave->start_dt)->endOfWeek();

          $timeSheet = new TimeSheet();
          $timeSheet->emp_signature   = null;
          $timeSheet->employee_id     = $annual_leave->employee_id;
          $timeSheet->week_end        = $curr_week_end;
          $timeSheet->rdo             = 0;
          $timeSheet->pld             = 0;
          $timeSheet->anl             = 0;

          $timeSheet->total           = "40:00";
          $timeSheet->normal          = "40:00";
          $timeSheet->total_15        = "00:00";
          $timeSheet->total_20        = "00:00";

          $timeSheet->user_id         = Auth::id();
          $timeSheet->status          = "P";
          $timeSheet->save();

          $dates = array();
/*


          for($date = Carbon::parse($annual_leave->start_dt); $date->lte(Carbon::parse($annual_leave->return_dt)->endOfWeek()); $date->addDay()) {

            array_push($dates, $date->format('Y-m-d'));

          }

          return $dates;*/
          for($date = Carbon::parse($annual_leave->start_dt); $date->lte(Carbon::parse($annual_leave->return_dt)->endOfWeek()); $date->addDay()) {
            //Generate TimeSheet

              array_push($dates, $date->format('Y-m-d'));


              if ($date->weekOfYear != $curr_week_end->weekOfYear) {

                $curr_week_end = $date->endOfWeek();

                $timeSheet = new TimeSheet();
                $timeSheet->emp_signature   = null;
                $timeSheet->employee_id     = $annual_leave->employee_id;
                $timeSheet->week_end        = $curr_week_end;
                $timeSheet->rdo             = 0;
                $timeSheet->pld             = 0;
                $timeSheet->anl             = 0;

                $timeSheet->total           = "40:00";
                $timeSheet->normal          = "40:00";
                $timeSheet->total_15        = "00:00";
                $timeSheet->total_20        = "00:00";

                $timeSheet->user_id         = Auth::id();
                $timeSheet->status          = "P";
                $timeSheet->save();




              } else {


                    $weekDay                        = \App\WeekDay::where("short", "=", strtolower($date->format('D')))->get()->first();

                    $dayTimeSheet                   = new \App\Day();
                    $dayTimeSheet->week_day         = $weekDay->number;
                    $dayTimeSheet->day_dt           = Carbon::instance($timeSheet->week_end)->subDays($weekDay->days_to_end);
                    $dayTimeSheet->total           = $weekDay->number < 7 ? "08:00" : "00:00";
                    $dayTimeSheet->normal          = $weekDay->number < 7 ? "08:00" : "00:00";
                    $dayTimeSheet->total_15        = "00:00";
                    $dayTimeSheet->total_20        = "00:00";

                    $dayTimeSheet->time_sheet_id    = $timeSheet->id;
                    $dayTimeSheet->save();

                    foreach ([1,2,3,4] as $job) {

                            $dayJob               = new \App\DayJob();
                            $dayJob->job_id       = $job == 1 && $weekDay->number < 7  ? \App\Job::where("code", 'anl')->value('id') : null;
                            $dayJob->day_id       = $dayTimeSheet->id;
                            $dayJob->number       = $job;
                            $dayJob->description  = "";
                            $dayJob->start        = $job == 1 && $weekDay->number < 7 ? (7 * 60) : null;
                            $dayJob->end          = $job == 1 && $weekDay->number < 7 ? (15.25 * 60) : null;
                            $dayJob->night_work   = false;
                            $dayJob->save();

                    }
            }
          }
          
          return $dates;
          break;
      }
    }
}
