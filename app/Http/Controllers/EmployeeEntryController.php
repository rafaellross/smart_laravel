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
                                entry.entry_number,
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
                          " order by emp.name, entry.entry_dt, entry.entry_number, entry.entry_time asc
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
        //return $request;
         $errors = [];
    

         foreach ($request->get('employee_id') as $key => $employee) {

           //Check if employee has another same type entry on the same sday

           $emp_entry = EmployeeEntry::where('entry_dt', '=', $request->get('entry_dt'))->where('employee_id', '=', $employee)->whereBetween('entry_time', [$request->get('entry_time')-30, $request->get('entry_time')])->first();

           if (!empty($emp_entry)) {

             array_push($errors, 'The employee ' . $emp_entry->employee->name . "  already has entry in the last 30 minutes!");

           } else {

             $entry = new EmployeeEntry();
             $entry->employee_id = $employee;
             $entry->in_out      = 1;
             $entry->notes       = $request->get('notes');
             $entry->entry_dt    = $request->get('entry_dt');
             $entry->entry_time  = $request->get('entry_time');
             $entry->entry_number = DB::select(DB::raw('select if(max(entry_number) is null, 0, max(entry_number))  as entry_number from employee_entries where employee_id = ' . $employee ." and entry_dt = '" . $request->get('entry_dt') . "';"))[0]->entry_number+1;
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
      $employee_entries = EmployeeEntry::where('employee_id', '=', $id)->whereRaw('YEARWEEK(entry_dt)+1 = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))')->get();
      $employee_ts = TimeSheet::where('employee_id', '=', $id)->whereRaw('YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))')->get();
      //check if employee has any entry
      if ($employee_entries->count() <= 0 || $employee_ts->count() > 0) {        
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

          if($i == 1) {

            $start = 1;
            $end = 2;

          }

          if($i == 2) {

            $start = 3;
            $end = 4;

          }

          if($i == 3) {

            $start = 5;
            $end = 6;

          }

          if($i == 4) {

            $start = 7;
            $end = 8;

          }

          $dayJob               = new \App\DayJob();
          $dayJob->day_id       = $dayTimeSheet->id;
          $dayJob->number       = $i;
          $dayJob->night_work   = 0;
                      
          $start_obj  = EmployeeEntry::where('entry_dt', $dayTimeSheet->day_dt->format('Y-m-d'))->where('entry_number', $start)->where('employee_id', $id)->select('entry_time')->first(); 
          
          $end_obj    = EmployeeEntry::where('entry_dt', $dayTimeSheet->day_dt->format('Y-m-d'))->where('entry_number', $end)->where('employee_id', $id)->select('entry_time')->first(); 
          
          $dayJob->start        = empty($start_obj->entry_time) ? null : (0.25 * ceil( ($start_obj->entry_time/60) / 0.25)) * 60;

          $dayJob->end          = empty($end_obj->entry_time) ? null : (0.25 * ceil( ($end_obj->entry_time/60) / 0.25)) * 60;
          
          if(
              (!is_null($dayJob->start) && is_null($dayJob->end)) ||
              (is_null($dayJob->start) && !is_null($dayJob->end))          
            )
          {
            $timesheet->delete();
            return "<script>window.close();</script>";

          }
          if(!is_null($dayJob->start) && !is_null($dayJob->end)) {
            $dayJob->job_id = 7;
          }
          
          $dayJob->save();
                   
        }
        
      }
      
      $timesheet->updateHours();        

      //Get start and end time 

      return redirect('/timesheets/action/' . $timesheet->id . "/print");
      

    }
}
