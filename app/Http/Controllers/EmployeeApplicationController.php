<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeApplication;
use App\EmployeeLicense;
use App\EmployeeApplicationForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Response;

class EmployeeApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if (Auth::user()->administrator) {
        $employee_applications = EmployeeApplication::all();
      } else {
        $employee_applications = EmployeeApplication::where('user_id', Auth::user()->id)->get();
      }

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
            $employee_application                           = new EmployeeApplication();
            $employee_application->user_id                  = Auth::user()->id;
            $employee_application->first_name               = $request->get('first_name');
            $employee_application->last_name                = $request->get('last_name');
            $employee_application->given_names              = $request->get('given_names');
            $employee_application->dob                      = is_null($request->get('dob')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dob'));
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
            $employee_application->date_commenced           = is_null($request->get('date_commenced')) ? null : $request->get('date_commenced');
            $employee_application->bank_acc_name            = $request->get('bank_acc_name');
            $employee_application->bsb                      = $request->get('bsb');
            $employee_application->account_number           = $request->get('account_number');
            $employee_application->superannuation           = $request->get('superannuation');
            $employee_application->redundancy               = $request->get('redundancy');
            $employee_application->long_service_number      = $request->get('long_service_number');
            $employee_application->apprentice               = $request->get('apprentice');
            $employee_application->apprentice_year          = $request->get('apprentice_year');
            $employee_application->gender                   = $request->get('gender');
            $employee_application->paid_basis               = $request->get('paid_basis');
            $employee_application->form_dt                  = is_null($request->get('form_dt')) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $request->get('form_dt'));

            //Tax
            $employee_application->claim_threshold          = $request->get('claim_threshold');
            $employee_application->educational_loan         = $request->get('educational_loan');
            $employee_application->financial_supplement     = $request->get('financial_supplement');
            $employee_application->tax_status               = $request->get('tax_status');

            $employee_application->employee_signature       = $request->get('signature');




            $employee_application->save();

            foreach ($request->get('license') as $key => $value) {
                $issue_date = $value['issue_date'];

                $application_license = new EmployeeLicense();
                $application_license->application_id = $employee_application->id;
                $application_license->license_id = $key;
                $application_license->issue_date = is_null($issue_date) ? null : Carbon::createFromFormat('d/m/Y', $issue_date);
                $application_license->issuer = $value["issuer"];
                $application_license->number = $value["number"];
                $application_license->image_front = $value["image"]["front"]["img"];
                $application_license->image_back = $value["image"]["back"]["img"];
                $application_license->save();
            }
            return redirect('employee_application/' . $employee_application->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $app = EmployeeApplication::find($id);

      return view('employee_application.agreement', ['id' => $id, 'application' => $app]);

    }

    public function agreement($id){
      $app = EmployeeApplication::find($id);
      $app->agree_term = true;
      $app->save();
      return redirect('employee_application')->with('success','Application has been added!');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_application = EmployeeApplication::find($id);
        return view('employee_application.edit',compact('employee_application','id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $agree = false)
    {


            $employee_application                           = EmployeeApplication::find($id);

            if ($agree) {
              $employee_application->agree_term = true;
              $employee_application->save();
              return redirect('employee_application')->with('success','Application has been submitted!');
            } else {

                          $employee_application->first_name               = $request->get('first_name');
                          $employee_application->given_names              = $request->get('given_names');
                          $employee_application->last_name                = $request->get('last_name');
                          $employee_application->dob                      = is_null($request->get('dob')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dob'));
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
                          $employee_application->gender                   = $request->get('gender');
                          $employee_application->paid_basis               = $request->get('paid_basis');
                          $employee_application->form_dt                  = is_null($request->get('form_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('form_dt'));

                          //Tax
                          $employee_application->claim_threshold          = $request->get('claim_threshold');
                          $employee_application->educational_loan         = $request->get('educational_loan');
                          $employee_application->financial_supplement     = $request->get('financial_supplement');
                          $employee_application->tax_status               = $request->get('tax_status');




                          $employee_application->employee_signature       = $request->get('signature');
                          $employee_application->business                 = $request->get('business');
                          $employee_application->business_dt              = is_null($request->get('business_dt')) ? Carbon::now() : Carbon::createFromFormat('d/m/Y', $request->get('business_dt'));

                          $employee_application->save();

                          foreach ($employee_application->licenses as $license) {
                              $license->delete();
                          }

                          foreach ($request->get('license') as $key => $value) {
                              $issue_date = $value['issue_date'];

                              $application_license = new EmployeeLicense();
                              $application_license->application_id = $employee_application->id;
                              $application_license->license_id = $value["license_id"];
                              $application_license->issue_date = is_null($issue_date) ? null : Carbon::createFromFormat('d/m/Y', $issue_date);
                              $application_license->issuer = $value["issuer"];
                              $application_license->number = $value["number"];
                              $application_license->image_front = $value["image"]["front"]["img"];
                              $application_license->image_back = $value["image"]["back"]["img"];
                              $application_license->save();
                          }
                          //return redirect('employee_application');
                          return redirect('employee_application/' . $employee_application->id);
            }

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
                    EmployeeApplication::find($id)->delete();
                }
                return redirect('employee_application')->with('success','Employees Application(s) has been deleted');
                break;
            case 'print':

                $report = new EmployeeApplicationForm();
                //$report->SetCompression(true);
                foreach ($ids as $id) {
                    $employee_application = EmployeeApplication::find($id);
                    if ($employee_application) {
                        $report->add($employee_application);
                    }
                    $report->add_tfn($employee_application);
                    $report->add_licences($employee_application);
                    $report->add_policy($employee_application);

                    if ($employee_application->apprentice) {
                      $report->apprentice_form($employee_application);
                    }

                }
                return $report->output();
                break;

                case 'test':


                    foreach ($ids as $id) {
                        $employee_application = EmployeeApplication::find($id);
                        $arr = array();

                        foreach ($employee_application->licenses as $license) {

                          if (getimagesizefromstring($license->image_front)) {
                            echo '<img src="data:image/png;base64,' . base64_encode($license->image_front) .'"><br>';
                          } else {

                              $pdf = new \TCPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                              //$pdfdata = file_get_contents($license->image_front); // Simulate only having raw data available.
                              $pagecount = $pdf->setSourceData(str_replace("data:image/png;base64,", "", base64_decode($license->image_front)));
                              for ($i = 1; $i <= $pagecount; $i++) {
                                  $tplidx = $pdf->importPage($i);
                                  $pdf->AddPage();
                                  $pdf->useTemplate($tplidx);
                              }
                              $pdf->output();
                          }


                        }

                    }
                    //return $arr;
                    break;

            case 'update':
                return redirect('employee_application')->with('success','Employees Application(s) has been updated');
                break;
            default:
                return redirect('employee_application')->with('error','There was no action selected');
                break;
        }
    }
}
