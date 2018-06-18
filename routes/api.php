<?php

use Illuminate\Http\Request;



use Illuminate\Http\Resources\Json\Resource;
use GuzzleHttp\Client;

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
                            (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
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
                                (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                                from employees emp
                                where name like '%" . addslashes($name) . "%'
                                order by emp.name asc
                         ")
                    );
    return $employees;

});

Route::get('myob/', function() {
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://192.168.1.119:8080/AccountRight/efaea9a2-7946-4284-8db2-ffa28465df30/Contact/EmployeePayrollDetails?api-version=v2', [
        'Authorization' => 'Basic QWRtaW5pc3RyYXRvcjoxMjM0NTY=',
        'UID' => "efaea9a2-7946-4284-8db2-ffa28465df30"
    ]);
    echo $res->getStatusCode();
    // "200"
    echo $res->getHeader('content-type');
    // 'application/json; charset=utf8'
    echo $res->getBody();
    // {"type":"User"...'

});
