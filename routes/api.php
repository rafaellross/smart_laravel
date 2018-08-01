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

Route::get('penetration/{id}', function($id) {
    return \App\FireIdentification::find($id);

});

Route::get('myob/', function() {

    $client = new GuzzleHttp\Client();
    $response = $client->request('GET', 'http://localhost:8080/AccountRight/efaea9a2-7946-4284-8db2-ffa28465df30/Contact/EmployeePayrollDetails?$filter=Employee/UID eq ' . "guid'fd4d9cb3-2290-4351-89a7-2e984ce0590b'", [
        'headers' => [
        'Accept' => 'application/json',
        'Content-type' => 'application/json',
        'Authorization' => ['Basic QWRtaW5pc3RyYXRvcjoxMjM0NTY='],
        'UID' => 'efaea9a2-7946-4284-8db2-ffa28465df30',
        'x-myobapi-version' => 'v2'
        ]
    ]);

    $employees = json_decode((string) $response->getBody(), true)['Items'];
    $rdo = 0;

    $pld = 0;

    $anl = 0;

    $arr = array();
    foreach ($employees[0]['Entitlements'] as $entitlement) {

      return $employees[0]['Entitlements'];

      if ($entitlement['EntitlementCategory']['UID'] == 'aff9ffdd-73ca-40fb-9c7c-47e9522fcd4c') {
        $rdo =  $entitlement["Total"];
      }

      if ($entitlement['EntitlementCategory']['UID'] == 'cde563b9-3919-46d4-9fa0-303f20304e57') {
        $pld =  $entitlement["Total"];
      }

      if ($entitlement['EntitlementCategory']['UID'] == 'fb1ad0b1-e2b4-4254-843a-c68bc2529681') {
        $anl =  $entitlement["Total"];
      }

    }
    return $arr;

});
