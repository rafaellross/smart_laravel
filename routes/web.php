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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('mail/send', 'MailController@send');

//Middleware used for testing
Route::group(['middleware' => ['test']], function () {
	//QA
	Route::get('/qa_types/action/{id}/{action}', 'QATypesController@action');
	Route::get('/qa_users/action/{id}/{action}', 'QAUserController@action');
	Route::get('/qa_users/create/{type_id}', 'QAUserController@create');
	Route::resource('qa_types', 'QATypesController');
	Route::resource('qa_users', 'QAUserController');

	//Forms

	//Prestart
	Route::resource('form_prestart', 'FormPreStartController');
	Route::get('/form_prestart/action/{id}/{action}', 'FormPreStartController@action');

	//Checklist
	Route::resource('form_checklist', 'FormDailyCheckListController');
	Route::get('/form_checklist/action/{id}/{action}', 'FormDailyCheckListController@action');

	//Service Sheet
	Route::resource('form_service_sheet', 'FormServiceSheetController');
	Route::get('/form_service_sheet/action/{id}/{action}', 'FormServiceSheetController@action');

	//Employee application
	Route::get('/employee_application', 'EmployeeApplicationController@index');
	Route::get('/employee_application/create', 'EmployeeApplicationController@create');

	Route::get('/employee_application/tfn', 'EmployeeApplicationController@tfn');

	Route::get('/employee_application/action/{id}/{action}', 'EmployeeApplicationController@action');
	Route::get('/employee_application/{id}/edit', 'EmployeeApplicationController@edit');

});


Route::group(['middleware' => ['administrator']], function () {
	//Parameters
	Route::resource('parameters', 'ParametersController');

	//employees entries

	//Employees
	Route::get('/employees/{id}/edit', 'EmployeeController@edit');
	Route::get('/employees/create/', 'EmployeeController@create');

	Route::get('/employees', 'EmployeeController@index');

	Route::get('/employees/action/{id}/{action}/{param?}', 'EmployeeController@action');
	Route::patch('/employees/entitlemens', 'EmployeeController@updateEntitlements');

	Route::resource('employees', 'EmployeeController');

	//Jobs
	Route::get('/jobs/action/{id}/{action}/{status?}', 'JobController@action');
	Route::resource('jobs', 'JobController');

	//Users
	Route::get('/users/action/{id}/{action}/{status?}', 'UserController@action');
	Route::resource('users', 'UserController', ['except' => ['edit','update']]);
	//Employee entries
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/timesheets/select', 'TimeSheetController@select');
	Route::get('/timesheets/create/{id}', 'TimeSheetController@create');
	Route::get('/timesheets/action/{id}/{action}/{status?}', 'TimeSheetController@action')->name('action_timesheet');
	Route::get('/timesheets', 'TimeSheetController@index');
	Route::get('/timesheets/approve/{id}', 'TimeSheetController@approve');
	Route::get('/timesheets/{status?}', 'TimeSheetController@index');


	Route::patch('/users/{users}', 'UserController@update');
	Route::resource('timesheets', 'TimeSheetController', ['except' => ['index']]);
	Route::resource('employee_application', 'EmployeeApplicationController');

	Route::get('/employee_entries/create/{id?}', 'EmployeeEntryController@create');
	Route::get('/employee_entries/{id?}', 'EmployeeEntryController@index');
	Route::get('/employee_entries', 'EmployeeEntryController@index');
	Route::get('/employee_entries/create', 'EmployeeEntryController@create');
	Route::get('/employee_entries/generate/{id}', 'EmployeeEntryController@generateTimeSheet');
	Route::resource('employee_entries', 'EmployeeEntryController');






});

Route::get('/entries/scan', function () {
	return view('employee_entries.scan');
});

	Route::get('/users/{id}/edit', function ($id) {
		if (!Auth::user()->administrator && Auth::user()->id != $id) {
			return redirect('/home');
		} else {
	        $user = App\User::find($id);
	        return view('user.edit',compact('user','id'));
		}

	});
