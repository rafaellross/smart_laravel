<?php

namespace App\Http\Controllers;

use App\FormServiceSheet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormServiceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form.service_sheet.index', ['form_service_sheets' => FormServiceSheet::orderBy('dt_form', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.service_sheet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $service_sheet = new FormServiceSheet();

      $service_sheet->job_no              = $request->get('job_no');
      $service_sheet->dt_form             = is_null($request->get('dt_form')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));
      $service_sheet->customer_name       = $request->get('customer_name');
      $service_sheet->customer_address    = $request->get('customer_address');
      $service_sheet->requested_by        = $request->get('requested_by');
      $service_sheet->contact_no          = $request->get('contact_no');
          //Job
      $service_sheet->job_description     = $request->get('job_description');
      $service_sheet->job_address         = $request->get('job_address');
      $service_sheet->site_contact        = $request->get('site_contact');
      $service_sheet->site_contact_no     = $request->get('site_contact_no');

      //Authority
      $service_sheet->read_understood     = $request->get('read_understood');
      $service_sheet->authority_name      = $request->get('authority_name');
      $service_sheet->authority_dt        = is_null($request->get('authority_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('authority_dt'));

      $service_sheet->description         = $request->get('description');

      //Materials
      $service_sheet->purchase_no_1       = $request->get('purchase_no_1');
      $service_sheet->purchase_no_2       = $request->get('purchase_no_2');
      $service_sheet->purchase_no_3       = $request->get('purchase_no_3');

      $service_sheet->material_no_1       = $request->get('material_no_1');
      $service_sheet->material_no_2       = $request->get('material_no_2');
      $service_sheet->material_no_3       = $request->get('material_no_3');

      //Time Sheet
       $service_sheet->time_sheet_dt_1    = is_null($request->get('time_sheet_dt_1')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('time_sheet_dt_1'));
       $service_sheet->time_sheet_dt_2    = is_null($request->get('time_sheet_dt_2')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('time_sheet_dt_2'));
       $service_sheet->time_sheet_dt_3    = is_null($request->get('time_sheet_dt_3')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('time_sheet_dt_3'));
       $service_sheet->time_sheet_dt_4    = is_null($request->get('time_sheet_dt_4')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('time_sheet_dt_4'));
       $service_sheet->time_sheet_dt_5    = is_null($request->get('time_sheet_dt_5')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('time_sheet_dt_5'));

      $service_sheet->time_sheet_start_1  = $request->get('time_sheet_start_1');
      $service_sheet->time_sheet_start_2  = $request->get('time_sheet_start_2');
      $service_sheet->time_sheet_start_3  = $request->get('time_sheet_start_3');
      $service_sheet->time_sheet_start_4  = $request->get('time_sheet_start_4');
      $service_sheet->time_sheet_start_5  = $request->get('time_sheet_start_5');

      $service_sheet->time_sheet_end_1    = $request->get('time_sheet_end_1');
      $service_sheet->time_sheet_end_2    = $request->get('time_sheet_end_2');
      $service_sheet->time_sheet_end_3    = $request->get('time_sheet_end_3');
      $service_sheet->time_sheet_end_4    = $request->get('time_sheet_end_4');
      $service_sheet->time_sheet_end_5    = $request->get('time_sheet_end_5');

      $service_sheet->time_sheet_total_1  = $request->get('time_sheet_total_1');
      $service_sheet->time_sheet_total_2  = $request->get('time_sheet_total_2');
      $service_sheet->time_sheet_total_3  = $request->get('time_sheet_total_3');
      $service_sheet->time_sheet_total_4  = $request->get('time_sheet_total_4');
      $service_sheet->time_sheet_total_5  = $request->get('time_sheet_total_5');

      $service_sheet->time_sheet_initial_1 = $request->get('time_sheet_initial_1');
      $service_sheet->time_sheet_initial_2 = $request->get('time_sheet_initial_2');
      $service_sheet->time_sheet_initial_3 = $request->get('time_sheet_initial_3');
      $service_sheet->time_sheet_initial_4 = $request->get('time_sheet_initial_4');
      $service_sheet->time_sheet_initial_5 = $request->get('time_sheet_initial_5');

      //Costings
      $service_sheet->service_call = $request->get('service_call');
      $service_sheet->labour = $request->get('labour');
      $service_sheet->materials = $request->get('materials');
      $service_sheet->equipments = $request->get('equipments');
      $service_sheet->as_per_quote = $request->get('as_per_quote');

       $service_sheet->service_call_value = $request->get('service_call_value');
       $service_sheet->labour_value = $request->get('labour_value');
       $service_sheet->materials_value = $request->get('materials_value');
       $service_sheet->equipments_value = $request->get('equipments_value');
       $service_sheet->as_per_quote_value = $request->get('as_per_quote_value');
       $service_sheet->gst = $request->get('gst');
       $service_sheet->total = $request->get('total');

      //Payment
      $service_sheet->pay_type            = $request->get('pay_type');
      $service_sheet->card_cheque_no      = $request->get('card_cheque_no');
      $service_sheet->card_expiry_dt      = is_null($request->get('card_expiry_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('card_expiry_dt'));
      $service_sheet->card_name           = $request->get('card_name');
      $service_sheet->card_id             = $request->get('card_id');
      $service_sheet->save();

      return redirect('/form_service_sheet')->with('success', 'Service Sheet added with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormServiceSheet  $formServiceSheet
     * @return \Illuminate\Http\Response
     */
    public function show(FormServiceSheet $formServiceSheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormServiceSheet  $formServiceSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(FormServiceSheet $formServiceSheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormServiceSheet  $formServiceSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormServiceSheet $formServiceSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormServiceSheet  $formServiceSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormServiceSheet $formServiceSheet)
    {
        //
    }

    public function action($id, $action, $status = null)
    {

        $ids = explode(",", $id);

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    $timesheet = FormServiceSheet::find($id);
                    $timesheet->delete();

                }
                return redirect('timesheets')->with('success','Time Sheet(s) has been deleted');
                break;
            case 'print':

                $report = new FormServiceSheetReport();
                $report->SetCompression(true);
                foreach ($ids as $id) {
                    $timesheet = FormServiceSheet::find($id);
                    if ($timesheet) {
                        $report->add($timesheet);
                    }
                }
                return $report->output();
                break;

            default:
                return redirect('timesheets')->with('error','There was no action selected');
                break;
        }
    }
}
