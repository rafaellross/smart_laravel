<?php

namespace App\Http\Controllers;

use App\FormDailyCheckList;
use App\FormDailyCheckListReport;
use App\FormDailyCheckListItems;
use App\FormDailyCheckListLic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
class FormDailyCheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form.daily_checklist.index', ['form_daily_checklists' => FormDailyCheckList::orderBy('dt_form', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.daily_checklist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $form_checklist = new FormDailyCheckList();
        $form_checklist->dt_form            = Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));        
        $form_checklist->user               = Auth::user()->id;
        $form_checklist->working_for        = $request->get('working_for');
        $form_checklist->plant_description  = $request->get('plant_description');
        $form_checklist->make_model         = $request->get('make_model');
        $form_checklist->job_site           = $request->get('job_site');
        $form_checklist->reg_permit         = $request->get('reg_permit');
        $form_checklist->expire_dt          = is_null($request->get('expire_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('expire_dt'));
        $form_checklist->km_reading         = $request->get('km_reading');
        $form_checklist->save();        

        foreach ($request->get('items') as $key => $item) {
            $check_list                     = new FormDailyCheckListItems();
            $check_list->checklist          = $form_checklist->id;
            $check_list->number             = $key;
            $check_list->description        = $item["description"];
            $check_list->monday             = $item["monday"];
            $check_list->tuesday            = $item["tuesday"];
            $check_list->wednesday          = $item["wednesday"];
            $check_list->thursday           = $item["thursday"];
            $check_list->friday             = $item["friday"];
            $check_list->saturday           = $item["saturday"];
            $check_list->sunday             = $item["sunday"];
            $check_list->save();
        }   

        foreach ($request->get('operators') as $key => $operator) {
            $lic_operator                       = new FormDailyCheckListLic();
            $lic_operator->checklist            = $form_checklist->id;
            $lic_operator->number               = $key;
            $lic_operator->op_name              = $operator["op_name"];
            $lic_operator->op_initials          = $operator["op_initials"];
            $lic_operator->op_driver_lic        = $operator["op_driver_lic"];
            $lic_operator->op_ticket            = $operator["op_ticket"];
            $lic_operator->op_induction_car     = $operator["op_induction_car"];
            $lic_operator->op_track_safety      = $operator["op_track_safety"];
            $lic_operator->signature            = $operator["signature"];
            $lic_operator->save();
        }
               
         return redirect('/form_checklist')->with('success', 'Checklist has been added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormDailyCheckList  $formDailyCheckList
     * @return \Illuminate\Http\Response
     */
    public function show(FormDailyCheckList $formDailyCheckList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormDailyCheckList  $formDailyCheckList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('form.daily_checklist.edit', ['form_daily_checklist' => FormDailyCheckList::find($id)]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDailyCheckList  $formDailyCheckList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_checklist                     = FormDailyCheckList::find($id);
        $form_checklist->dt_form            = Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));        
        $form_checklist->user               = Auth::user()->id;
        $form_checklist->working_for        = $request->get('working_for');
        $form_checklist->plant_description  = $request->get('plant_description');
        $form_checklist->make_model         = $request->get('make_model');
        $form_checklist->job_site           = $request->get('job_site');
        $form_checklist->reg_permit         = $request->get('reg_permit');
        $form_checklist->expire_dt          = is_null($request->get('expire_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('expire_dt'));
        $form_checklist->km_reading         = $request->get('km_reading');
        $form_checklist->save();        

        foreach ($form_checklist->items as $item) {
            $item->delete();
        }

        foreach ($request->get('items') as $key => $item) {
            $check_list                     = new FormDailyCheckListItems();
            $check_list->checklist          = $form_checklist->id;
            $check_list->number             = $key;
            $check_list->description        = $item["description"];
            $check_list->monday             = $item["monday"];
            $check_list->tuesday            = $item["tuesday"];
            $check_list->wednesday          = $item["wednesday"];
            $check_list->thursday           = $item["thursday"];
            $check_list->friday             = $item["friday"];
            $check_list->saturday           = $item["saturday"];
            $check_list->sunday             = $item["sunday"];
            $check_list->save();
        }   

        foreach ($form_checklist->operators as $operator) {
            $operator->delete();
        }

        foreach ($request->get('operators') as $key => $operator) {
            $lic_operator                       = new FormDailyCheckListLic();
            $lic_operator->checklist            = $form_checklist->id;
            $lic_operator->number               = $key;
            $lic_operator->op_name              = $operator["op_name"];
            $lic_operator->op_initials          = $operator["op_initials"];
            $lic_operator->op_driver_lic        = $operator["op_driver_lic"];
            $lic_operator->op_ticket            = $operator["op_ticket"];
            $lic_operator->op_induction_car     = $operator["op_induction_car"];
            $lic_operator->op_track_safety      = $operator["op_track_safety"];
            $lic_operator->signature            = $operator["signature"];
            $lic_operator->save();
        }
               
         return redirect('/form_checklist')->with('success', 'Checklist has been updated');
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormDailyCheckList  $formDailyCheckList
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormDailyCheckList $formDailyCheckList)
    {
        //
    }

    public function action($id, $action)
    {        

        $ids = explode(",", $id);

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    FormDailyCheckList::find($id)->delete();
                }                
                return redirect('form_checklist')->with('success','Checklist(s) has been deleted');        
                break;
            case 'print':
                
                $report = new FormDailyCheckListReport();
                
                foreach ($ids as $id) {
                    $form = FormDailyCheckList::find($id);
                    if ($form) {
                        $report->add($form);
                    }
                }
                return $report->output();
                break;

            default:
                return redirect('form_checklist')->with('error','There was no action selected');        
                break;
        }        
    }    

}
