<?php

namespace App\Http\Controllers;

use App\FormDailyCheckList;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return $request;
        $form_checklist = new FormDailyCheckList();
        $form_checklist->dt_form            = Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));
        $form_checklist->working_for        = $request->get('working_for');
        $form_checklist->plant_description  = $request->get('plant_description');
        $form_checklist->make_model         = $request->get('make_model');
        $form_checklist->job_site           = $request->get('job_site');
        $form_checklist->reg_permit         = $request->get('reg_permit');
        $form_checklist->dt_form            = is_null($request->get('expire_dt')) ? null : Carbon::createFromFormat('d/m/Y', $request->get('expire_dt'));
        $form_checklist->km_reading         = $request->get('km_reading');

        foreach ($request->get('items') as $item) {
                    # code...
                }        
        
        
        
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
    public function edit(FormDailyCheckList $formDailyCheckList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormDailyCheckList  $formDailyCheckList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormDailyCheckList $formDailyCheckList)
    {
        //
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
}
