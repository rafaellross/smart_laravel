<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::select( 
                    DB::raw(
                        "select emp.id, 
                                emp.name, 
                                emp.phone,
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK(now()) order by id desc limit 1) as last_timesheet
                                from employees emp                          
                                order by emp.name asc
                         ") 
                    );
        
        return view('employee.index', ['employees' => $employees]);
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
            'name' => 'required|string|max:255'
            
        ]);

        $employee = new Employee();
        $employee->name = $request->get('name');
        $employee->phone = $request->get('phone');
        $employee->bonus = $request->get('bonus');
        
        if ($request->get('entitlements') !== null) {
            foreach ($request->get('entitlements') as $entitlement) {
                $employee->{$entitlement} = true;
            }
        }
        

        $employee->save();
        //Employee::create($employee);
        return redirect('/employees')->with('success', 'Employee has been added');
        
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
            'phone' => 'required|string|max:20',            
        ]);

        $employee = Employee::find($id);
        $employee->name = $request->get('name');
        $employee->phone = $request->get('phone');
        $employee->bonus = $request->get('bonus');
        
        $employee->rdo = false;
        $employee->travel = false;
        $employee->site_allow = false;
        

        if ($request->get('entitlements') !== null) {
            foreach ($request->get('entitlements') as $entitlement) {
                $employee->{$entitlement} = true;
            }
        }
        
        $employee->save();
        return redirect('/employees')->with('success', 'Employee has been updated');
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
        return redirect('employees')->with('success','Employee has been  deleted');        
    }    

    public function action($id, $action, $status = null)
    {        

        $ids = explode(",", $id);
        if ($action == "delete") {
            
        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    Employee::find($id)->delete();
                }                
                return redirect('employees')->with('success','Job(s) has been deleted');        
                break;
            default:
                return redirect('employees')->with('error','There was no action selected');        
                break;
        }        
    }

}
