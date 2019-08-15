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

Route::get('integratetest/{id}', function ($id) {

});

Route::get('/integrate/test/{id}', 'MyObController@integrateTest');

Route::get('test/{id}', function ($id) {

	$report = new App\TimeSheetReport();
	$report->SetCompression(true);

		$timesheet = App\TimeSheet::find($id);
	/*
	if ($timesheet) {
		$report->add($timesheet);
	}

	return $report->output();
	*/
	$arr = array();
	foreach ($timesheet->days as $day) {

		foreach ($day->dayJobs as $job) {
			if ($job->travel() > 0) {
				array_push(
					$arr,
					[
						"day" => $day->day_dt,
						"percentage" => $job->percentageOfDay(),
						"Job Number" => $job->number,
						"Job Code" => $job->job->code,
						"Work?" => $job->work(),
						"Travel" => $job->travel()

					]);
			}
		}
	}

	dd($arr);

});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('mail/send', 'MailController@send');

//Middleware used for testing
Route::group(['middleware' => ['test']], function () {

	Route::get('/myob', 'MyObController@index');
	Route::get('/myob/employees', 'MyObController@employees');
	Route::post('/myob/integrate', 'MyObController@integrate');
	Route::get('/myob/jobs', 'MyObController@jobs');
	Route::get('/myob/expenses', 'MyObController@expenses');
	Route::get('/myob/categories', 'MyObController@categories');
	Route::get('/myob/payroll', 'MyObController@payroll');
	Route::get('/myob/entitlements', 'MyObController@entitlements');
	Route::get('/myob/stdpays', 'MyObController@stdPays');


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


	//TMV
	Route::get('/tmv/{job}', 'TmvController@index');
	Route::get('/tmv/{job}/create', 'TmvController@create');
	Route::get('/tmv/{job}/edit', 'TmvController@edit');
	Route::post('/tmv/{job}', 'TmvController@store');
	Route::patch('/tmv/{id}', 'TmvController@update');
	Route::get('/tmv/{job}/action/{ids}/{action}', 'TmvController@action');
	Route::get('/tmv/change_job/{ids}/{new_job}', 'TmvController@changeJob');
	Route::get('/tmv/{job}/print/{ids}/{date?}', 'TmvController@print');

	//TMV Service Log
	Route::get('/tmv_log/{tmv}', 'TmvLogController@index');
	Route::get('/tmv_log/{job}/create', 'TmvLogController@create');
	Route::get('/tmv_log/{job}/edit', 'TmvLogController@edit');
	Route::post('/tmv_log/{id}', 'TmvLogController@store');
	Route::patch('/tmv_log/{tmv}', 'TmvLogController@update');
	Route::get('/tmv_log/action/{ids}/{action}', 'TmvLogController@action');

	Route::resource('annual_leave', 'AnnualLeaveController');
	Route::get('/annual_leave/action/{id?}/{action?}', 'AnnualLeaveController@action');

	//Fire Matrix
	Route::resource('/fire_matrix', 'FireMatrixController');
	Route::get('/fire_matrix/action/{id}/{action}', 'FireMatrixController@action');


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
	Route::get('/employee_entries/scan', function () {
		return view('employee_entries.scan');
	});

	Route::get('/employee_entries/{id?}', 'EmployeeEntryController@index');
	Route::get('/employee_entries', 'EmployeeEntryController@index');
	Route::get('/employee_entries/create', 'EmployeeEntryController@create');
	Route::get('/employee_entries/generate/{id}', 'EmployeeEntryController@generateTimeSheet');

	Route::get('/employee_entries/action/{id?}/{action?}', 'EmployeeEntryController@action');

	Route::resource('employee_entries', 'EmployeeEntryController');


	//Fire Identification
	Route::get('/fire_identification/scan', function () {
		return view('job.fire_identification.scan');
	});

	Route::get('/fire_identification/{job}', 'FireIdentificationController@index');
	Route::get('/fire_identification/{job}/action/{id}/{action}/{drawing?}/{null?}/{startEnd?}', 'FireIdentificationController@action');
	Route::get('/fire_identification/create/{job}', 'FireIdentificationController@create');
	Route::get('/fire_identification/edit/{id}', 'FireIdentificationController@edit');
	Route::post('/fire_identification/{job}', 'FireIdentificationController@store');
	Route::post('/fire_identification/{job}', 'FireIdentificationController@multiple');
	Route::patch('/fire_identification/{fire_seal}', 'FireIdentificationController@update');


	//Employee application
	Route::get('/employee_application', 'EmployeeApplicationController@index');
	Route::get('/employee_application/create', 'EmployeeApplicationController@create');

	Route::get('/employee_application/tfn', 'EmployeeApplicationController@tfn');

	Route::get('/employee_application/action/{id}/{action}', 'EmployeeApplicationController@action');
	Route::get('/employee_application/{id}/edit', 'EmployeeApplicationController@edit');


	Route::get('/employee_application/{id}/agreement', 'EmployeeApplicationController@agreement');

	//Route::resource('fire_identification', 'FireIdentificationController');






});





	Route::get('/users/{id}/edit', function ($id) {
		if (!Auth::user()->administrator && Auth::user()->id != $id) {
			return redirect('/home');
		} else {
	        $user = App\User::find($id);
	        return view('user.edit',compact('user','id'));
		}

	});
