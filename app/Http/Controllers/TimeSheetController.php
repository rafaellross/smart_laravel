<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use App\WeekDay;
use App\Day;
use App\DayJob;
use App\Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timesheets = TimeSheet::all();
        return view('timesheet.index', ['timesheets' => $timesheets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days = WeekDay::where('number', '<', 8)->get();        
        $employee = \App\Employee::find(1);
        
        return view('timesheet.create', ['days' => $days, 'employee' => $employee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timeSheet = new TimeSheet();
        $timeSheet->emp_signature   = $request->get('emp_signature');
        $timeSheet->employee_id     = $request->get('employee_id');
        $timeSheet->week_end        = Carbon::parse($request->get('week_end'));
        $timeSheet->rdo             = $request->get('rdo');
        $timeSheet->pld             = $request->get('pld');
        $timeSheet->anl             = $request->get('anl');
        $timeSheet->user_id         = Auth::id();
        $timeSheet->save();        


        foreach ($request->get('days') as $key => $day) {
            $weekDay                        = WeekDay::where("short", "=", $key)->get()->first();
            $dayTimeSheet                   = new Day();
            $dayTimeSheet->week_day         = $weekDay->number;
            $dayTimeSheet->day_dt           = Carbon::instance($timeSheet->week_end)->subDays($weekDay->days_to_end);  
            
            $dayTimeSheet->time_sheet_id    = $timeSheet->id;
            $dayTimeSheet->save();
            
            foreach ($day as $key => $job) {
                if (intval($key)) {
                    $dayJob         = new DayJob();
                    $dayJob->job_id = Job::where("code", $job["job"])->value('id');
                    $dayJob->day_id = $dayTimeSheet->id;
                    $dayJob->start  = $job["start"];
                    $dayJob->end    = $job["end"];
                    $dayJob->save();
                }
            }
        }

        return $request;
        //return view('timesheet.test', ['result' => $request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
