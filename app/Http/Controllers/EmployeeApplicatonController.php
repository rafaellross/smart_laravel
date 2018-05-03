<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeApplicaton;
use App\EmployeeLicense;
use Carbon\Carbon;

class EmployeeApplicatonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_applications = EmployeeApplicaton::all(); 
        return view('employee_application.index', ['employee_applications' => $employee_applications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee_application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
            $employee_application                           = new EmployeeApplicaton();
            $employee_application->first_name               = $request->get('first_name');
            $employee_application->last_name                = $request->get('last_name');
            $employee_application->dob                      = Carbon::createFromFormat('d/m/Y', $request->get('dob'));
            $employee_application->street_address           = $request->get('street_address');
            $employee_application->suburb                   = $request->get('suburb');
            $employee_application->post_code                = $request->get('post_code');
            $employee_application->state                    = $request->get('state');
            $employee_application->mobile                   = $request->get('mobile');
            $employee_application->phone                    = $request->get('phone');
            $employee_application->email                    = $request->get('email');
            $employee_application->emergency_name           = $request->get('emergency_name');
            $employee_application->emergency_phone          = $request->get('emergency_phone');
            $employee_application->emergency_relationship   = $request->get('emergency_relationship');
            $employee_application->tax_file_number          = $request->get('tax_file_number');
            $employee_application->date_commenced           = $request->get('date_commenced');
            $employee_application->bank_acc_name            = $request->get('bank_acc_name');
            $employee_application->bsb                      = $request->get('bsb');
            $employee_application->account_number           = $request->get('account_number');
            $employee_application->superannuation           = $request->get('superannuation');
            $employee_application->redundancy               = $request->get('redundancy');
            $employee_application->long_service_number      = $request->get('long_service_number');
            $employee_application->apprentice               = $request->get('apprentice');
            $employee_application->apprentice_year          = $request->get('apprentice_year');
            $employee_application->save();
            
            foreach ($request->get('license') as $key => $value) {
                $issue_date = $value['issue_date'];

                $application_license = new EmployeeLicense();
                $application_license->application_id = $employee_application->id;
                $application_license->license_id = $key;
                $application_license->issue_date = Carbon::createFromFormat('d/m/Y', $issue_date);
                $application_license->issuer = $value["issuer"];
                $application_license->number = $value["number"];
                $application_license->image_front = $value["image"]["front"]["img"];
                $application_license->image_back = $value["image"]["back"]["img"];
                $application_license->save();
            }
            return redirect('employee_application');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_application = EmployeeApplicaton::find($id);
        return view('employee_application.edit',compact('employee_application','id'));
        
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
            $employee_application                           = EmployeeApplicaton::find($id);
            $employee_application->first_name               = $request->get('first_name');
            $employee_application->last_name                = $request->get('last_name');
            $employee_application->dob                      = Carbon::createFromFormat('d/m/Y', $request->get('dob'));
            $employee_application->street_address           = $request->get('street_address');
            $employee_application->suburb                   = $request->get('suburb');
            $employee_application->post_code                = $request->get('post_code');
            $employee_application->state                    = $request->get('state');
            $employee_application->mobile                   = $request->get('mobile');
            $employee_application->phone                    = $request->get('phone');
            $employee_application->email                    = $request->get('email');
            $employee_application->emergency_name           = $request->get('emergency_name');
            $employee_application->emergency_phone          = $request->get('emergency_phone');
            $employee_application->emergency_relationship   = $request->get('emergency_relationship');
            $employee_application->tax_file_number          = $request->get('tax_file_number');
            $employee_application->date_commenced           = $request->get('date_commenced');
            $employee_application->bank_acc_name            = $request->get('bank_acc_name');
            $employee_application->bsb                      = $request->get('bsb');
            $employee_application->account_number           = $request->get('account_number');
            $employee_application->superannuation           = $request->get('superannuation');
            $employee_application->redundancy               = $request->get('redundancy');
            $employee_application->long_service_number      = $request->get('long_service_number');
            $employee_application->apprentice               = $request->get('apprentice');
            $employee_application->apprentice_year          = $request->get('apprentice_year');
            $employee_application->save();
            
            foreach ($employee_application->licenses as $license) {
                $license->delete();
            }            

            foreach ($request->get('license') as $key => $value) {
                $issue_date = $value['issue_date'];

                $application_license = new EmployeeLicense();
                $application_license->application_id = $employee_application->id;
                $application_license->license_id = $key;
                $application_license->issue_date = Carbon::createFromFormat('d/m/Y', $issue_date);
                $application_license->issuer = $value["issuer"];
                $application_license->number = $value["number"];
                $application_license->image_front = $value["image"]["front"]["img"];
                $application_license->image_back = $value["image"]["back"]["img"];
                $application_license->save();
            }
            return redirect('employee_application');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

public function action($id, $action, $status = null)
    {        

        $ids = explode(",", $id);
        if ($action == "delete") {
            
        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    EmployeeApplicaton::find($id)->delete();
                }                
                return redirect('employee_application')->with('success','Time Sheet(s) has been deleted');        
                break;
            case 'update':
                return redirect('employee_application')->with('success','Time Sheet(s) has been updated');                        
                break;            
            default:
                return redirect('employee_application')->with('error','There was no action selected');        
                break;
        }        
    }    
}
