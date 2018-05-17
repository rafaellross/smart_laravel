<?php

namespace App\Http\Controllers;

use App\FormServiceSheet;
use Illuminate\Http\Request;

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
        //
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
}
