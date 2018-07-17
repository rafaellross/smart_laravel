<?php

namespace App\Http\Controllers;

use App\EmployeeEntry;
use App\Employee;
use App\Hour;
use App\Day;
use App\TimeSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class EmployeeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $employee_entries = DB::select(
                    DB::raw(
                        "select entry.id,
                                emp.name,
                                entry.in_out,
                                entry.notes,
                                entry.entry_dt,
                                entry.entry_time,
                                entry.created_at,
                                users.username

                          from employee_entries entry
                          inner join employees emp
                            on emp.id = entry.employee_id
                          inner join users
                            on users.id = entry.user_id
                          where YEARWEEK(entry.entry_dt)+1 = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))
                          and ".(Auth::user()->administrator ? '1=1' : 'entry.user_id = ' . Auth::user()->id)."
                          and ".(is_null($id) ? '1=1' : 'entry.employee_id = ' . $id ) .
                          " order by emp.name, entry.entry_dt, entry.entry_time, entry.in_out asc
                         ")
                    );





      return view('employee_entries.index', ['employee_entries' => $employee_entries]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($employee_id = null)
    {

      $last_entry = null;

      //Check if $employee_id is null
      if (is_null($employee_id)) {

        $employees = null;

      } else {

        //Load employee
        $employees = Employee::whereRaw("id in ($employee_id)")->get();

        $last_entry = (EmployeeEntry::where('entry_dt', '=', Carbon::now('Australia/Sydney')->format('Y-m-d'))->where('employee_id', '=', $employee_id)->orderBy('entry_time', 'desc')->first());

      }

        return view('employee_entries.create', ['employees' => $employees, 'now' => Carbon::now('Australia/Sydney')->diffInRealMinutes(Carbon::now('Australia/Sydney')->format('Y-m-d')), 'last_entry' => $last_entry]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {

         $errors = [];

         foreach ($request->get('employees') as $employee) {

           //Check if employee has another same type entry on the same sday

           $emp_entry = EmployeeEntry::where('entry_dt', '=', $request->get('entry_dt'))->where('employee_id', '=', $employee['id'])->whereBetween('entry_time', [$request->get('entry_time')-30, $request->get('entry_time')])->first();
           
           if (!empty($emp_entry)) {

             array_push($errors, 'The employee ' . $emp_entry->employee->name . "  already has entry in the last 30 minutes!");

           } else {

             $entry = new EmployeeEntry();
             $entry->employee_id = $employee['id'];
             $entry->in_out      = $request->get('in_out');
             $entry->notes       = $request->get('notes');
             $entry->entry_dt    = $request->get('entry_dt');
             $entry->entry_time  = $request->get('entry_time');
             $entry->user_id     = Auth::user()->id;

             $entry->save();

           }
         }

         if (count($errors) > 0) {

           return redirect('/employee_entries')->with('error', $errors);

         } else {

           return redirect('/employee_entries')->with('success', 'Employee entry has been added');

         }

     }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeEntry  $employeeEntry
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeEntry $employeeEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeEntry  $employeeEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeEntry $employeeEntry)
    {
        return view('employee_entries.edit', ['employeeEntry' => $employeeEntry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeEntry  $employeeEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $entry              = EmployeeEntry::find($id);
        $entry->employee_id = $request->get('employee_id');
        $entry->in_out      = $request->get('in_out');
        $entry->notes       = $request->get('notes');
        $entry->entry_dt    = $request->get('entry_dt');
        $entry->entry_time  = $request->get('entry_time');
        $entry->user_id     = Auth::user()->id;
        $entry->save();

        return redirect('/employee_entries')->with('success', 'Employee entry has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeEntry  $employeeEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeEntry $employeeEntry)
    {
        //
    }

    public function action($id, $action) {
        
        switch ($action) {
          case 'delete':
            
            DB::table('employee_entries')->whereRaw("id in ($id)")->delete();
            return redirect('/employee_entries')->with('success', 'Employees entries has been deleted');
            break;
          
          default:
            # code...
            break;
        }
    }

    public function generateTimeSheet($id) {
      //Load all entries for parameter week end

      // TODO: fix where to get only entries from the current week
      $employee_entries = EmployeeEntry::where('employee_id', '=', $id)->whereRaw('YEARWEEK(entry_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))')->get();
      
      //check if employee has any entry
      if ($employee_entries->count() <= 0) {

        //if not, close the tab
        return "<script>window.close();</script>";

      }

      $timesheet = new TimeSheet();
      $timesheet->emp_signature   = null;

      $timesheet->employee_id     = $id;
      $timesheet->week_end        = \App\Parameters::all()->first()->week_end_timesheet;
      $timesheet->rdo             = 0;
      $timesheet->pld             = 0;
      $timesheet->anl             = 0;


      $timesheet->total           = "00:00";
      $timesheet->normal          = "00:00";
      $timesheet->total_15        = "00:00";
      $timesheet->total_20        = "00:00";

      $timesheet->user_id         = Auth::id();
      $timesheet->status          = 'P';
      $timesheet->save();


      //Generate skeleton for timesheet
      foreach (\App\WeekDay::orderBy('number', 'desc')->get() as $day) {
        $dayTimeSheet                   = new Day();
        $dayTimeSheet->week_day         = $day->number;

        $dayTimeSheet->day_dt           = Carbon::parse($timesheet->week_end)->subDays($day->days_to_end);


        $dayTimeSheet->total           = "00:00";

        $dayTimeSheet->normal          = "00:00";
        $dayTimeSheet->total_15        = "00:00";
        $dayTimeSheet->total_20        = "00:00";

        $dayTimeSheet->total_night           = "00:00";
        $dayTimeSheet->normal_night          = "00:00";
        $dayTimeSheet->total_15_night        = "00:00";
        $dayTimeSheet->total_20_night        = "00:00";

        $dayTimeSheet->time_sheet_id    = $timesheet->id;
        $dayTimeSheet->save();

        //$total = 0;

        for ($i=1; $i <= 4; $i++) {
          $dayJob               = new \App\DayJob();
          $dayJob->day_id       = $dayTimeSheet->id;
          $dayJob->number       = $i;
          $dayJob->night_work   = 0;


          $dayJob->save();
          //$total += $dayJob->hours();

        }
        //$dayTimeSheet->total           = \App\Hour::convertToHour($total);

      }

      foreach ($employee_entries as $entry) {
        //return $employee_entries;
        $dayTimeSheet         = \App\Day::where('day_dt', Carbon::parse($entry->entry_dt))->where('time_sheet_id', $timesheet->id)->first();


        $dayJob               = \App\DayJob::where('day_id', $dayTimeSheet->id)->where('number', $entry->row())->first();

        $dayJob->job_id       = $entry->user->job_id;


          if ($entry->in_out == 1) {

            $dayJob->start = $entry->entry_time;

          } else {

            $dayJob->end = $entry->entry_time;

          }

          if ($dayJob->hours() > 0) {
            $dayJob->job_id       = Auth::user()->job_id;
          }

          $dayJob->save();




      }

      //return $timesheet->days;
/*
      foreach ($employee_entries as $entry) {
        $dayOfWeek = Carbon::parse($entry->entry_dt)->dayOfWeekIso + 1;

        $weekDay                        = \App\WeekDay::where("number", "=", $dayOfWeek)->first();


        if (count($timesheet->days()->where('day_dt', Carbon::parse($entry->entry_dt))->first()) > 0) {
          $dayTimeSheet = $timesheet->days()->where('day_dt', Carbon::parse($entry->entry_dt))->first();
        } else {
          $dayTimeSheet                   = new Day();
        }



        $dayTimeSheet->week_day         = $weekDay->number;

        $dayTimeSheet->day_dt           = $entry->entry_dt;


        $dayTimeSheet->total           = "00:00";

        $dayTimeSheet->normal          = "00:00";
        $dayTimeSheet->total_15        = "00:00";
        $dayTimeSheet->total_20        = "00:00";

        $dayTimeSheet->total_night           = "00:00";
        $dayTimeSheet->normal_night          = "00:00";
        $dayTimeSheet->total_15_night        = "00:00";
        $dayTimeSheet->total_20_night        = "00:00";

        $dayTimeSheet->time_sheet_id    = $timesheet->id;
        $dayTimeSheet->save();

        $dayJob               = new \App\DayJob();
        $dayJob->job_id       = $entry->job_id;
        $dayJob->day_id       = $dayTimeSheet->id;
        $dayJob->number       = $weekDay->number;
        $dayJob->description  = '';
        $dayJob->start        = 7*60;
        $dayJob->end          = 15*60;
        $dayJob->night_work   = false;

        $dayJob->save();



      }*/
      //$client = new \GuzzleHttp\Client;

      //$res = $client->getAsync("http://127.0.0.1:8000/timesheets/" . $timesheet->id . "/edit?generate=1");

      //echo '<script>window.open("http://localhost/smart_laravel/public/timesheets/'. $timesheet->id . '/edit?generate=1");</script>';
      return redirect('/timesheets/' . $timesheet->id . "/edit?generate=1");
      //return $employee_entries;

    }
}
