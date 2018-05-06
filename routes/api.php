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
	return App\Employee::all();   
});

Route::get('employees/{name}', function($name) {			
	return App\Employee::whereRaw("name like '%". $name ."%'")->take(5)->get();   
});
