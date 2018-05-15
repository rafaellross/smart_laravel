<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Config::set('debugbar.enabled', true);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


//Middleware used for testing
Route::group(['middleware' => ['auth']], function () {
	Route::get('/qa_types/action/{id}/{action}', 'QATypesController@action');
	Route::get('/qa_users/action/{id}/{action}', 'QAUserController@action');

	Route::get('/qa_users/create/{type_id}', 'QAUserController@create');

	Route::resource('qa_types', 'QATypesController');
	Route::resource('qa_users', 'QAUserController');

	//Employee application
	Route::get('/employee_application', 'EmployeeApplicatonController@index');
	Route::get('/employee_application/create', 'EmployeeApplicatonController@create');
	Route::get('/employee_application/action/{id}/{action}', 'EmployeeApplicatonController@action');
	Route::get('/employee_application/{id}/edit', 'EmployeeApplicatonController@edit');	

});


Route::group(['middleware' => ['administrator']], function () {
	
	
	//Employees 
	Route::get('/employees/action/{id}/{action}/{status?}', 'EmployeeController@action');
	Route::resource('employees', 'EmployeeController');
	Route::get('/jobs/action/{id}/{action}/{status?}', 'JobController@action');	
	Route::resource('jobs', 'JobController');
	
	//Users
	Route::get('/users/action/{id}/{action}/{status?}', 'UserController@action');
	Route::resource('users', 'UserController', ['except' => ['edit','update']]);
});	

Route::group(['middleware' => ['auth']], function () {
	Route::get('/timesheets/select', 'TimeSheetController@select');
	Route::get('/timesheets/create/{id}', 'TimeSheetController@create');
	Route::get('/timesheets/action/{id}/{action}/{status?}', 'TimeSheetController@action');
	Route::get('/timesheets', 'TimeSheetController@index');
	Route::get('/timesheets/{status?}', 'TimeSheetController@index');
	
	
	Route::patch('/users/{users}', 'UserController@update');
	Route::resource('timesheets', 'TimeSheetController', ['except' => ['index']]);
	Route::resource('employee_application', 'EmployeeApplicatonController');

});

	
	Route::get('/users/{id}/edit', function ($id) {
		if (!Auth::user()->administrator && Auth::user()->id != $id) {
			return redirect('/home');
		} else {
	        $user = App\User::find($id);
	        return view('user.edit',compact('user','id'));
		}
	    
	});	
