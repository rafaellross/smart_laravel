<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('employees/', function() {			

    $employees = DB::select( 
                DB::raw(
                    "select emp.id, 
                            emp.name, 
                            emp.phone,
                            (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK(now()) and time_sheets.status not in ('F', 'C') order by id desc limit 1) as last_timesheet
                            from employees emp                          
                            order by emp.name asc
                     ") 
                );
    return $employees;

});

Route::get('employees/{name}', function($name) {			
        $employees = DB::select( 
                    DB::raw(
                        "select emp.id, 
                                emp.name, 
                                emp.phone,
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK(now()) and time_sheets.status not in ('F', 'C') order by id desc limit 1) as last_timesheet
                                from employees emp                          
                                where name like '%" . $name . "%'
                                order by emp.name asc
                         ") 
                    );
    return $employees;

});
