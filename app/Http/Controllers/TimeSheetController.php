<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use App\WeekDay;
use App\Employee;
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
        $employee = Employee::find(1);
        
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
            
            $dayTimeSheet->time_sheet_id    = $timeSheet->id;
            $dayTimeSheet->save();
            
            foreach ($day as $key => $job) {
                
                if (intval($key)) {
                    $dayJob         = new DayJob();
                    $dayJob->job_id = !isset($job["job"]) ? null : Job::where("code", $job["job"])->value('id');
                    $dayJob->day_id = $dayTimeSheet->id;
                    $dayJob->number = $key;
                    $dayJob->start  = !isset($job["start"]) ? null : $job["start"];
                    $dayJob->end    = !isset($job["end"]) ? null : $job["end"];
                    $dayJob->save();
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
        
        
        $pdf = TimeSheet::pdf($timesheet);
        $pdf->output();
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
        $timeSheet = TimeSheet::find($id);        
        
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
            
            $dayTimeSheet->time_sheet_id    = $timeSheet->id;
            $dayTimeSheet->save();
            
            foreach ($day as $key => $job) {
                
                if (intval($key)) {
                    //return $job;
                    $dayJob         = new DayJob();
                    $dayJob->job_id = !isset($job["job"]) ? null : Job::where("code", $job["job"])->value('id');
                    $dayJob->day_id = $dayTimeSheet->id;
                    $dayJob->number = $key;
                    $dayJob->start  = $job["start"];
                    $dayJob->end    = $job["end"];
                    $dayJob->save();
                }
            }
        }

        //return $request;
        return redirect('/timesheets')->with('success', 'Time Sheet has been added');
        
        
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
        if ($action == "delete") {
            
        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    TimeSheet::find($id)->delete();
                }                
                return redirect('timesheets')->with('success','Time Sheet(s) has been deleted');        
                break;
            case 'update':
                foreach ($ids as $id) {
                    $timesheet = TimeSheet::find($id);
                    $timesheet->status = $status;
                    $timesheet->save();
                }                            
                return redirect('timesheets')->with('success','Time Sheet(s) has been updated');                        
                break;
            case 'print':
                return "print" . implode(",", $ids);
                break;
            
            default:
                return redirect('timesheets')->with('error','There was no action selected');        
                break;
        }

        
    }

}
