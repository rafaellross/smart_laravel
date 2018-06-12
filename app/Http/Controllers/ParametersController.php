<?php

namespace App\Http\Controllers;

use App\Parameters;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParametersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parameters.index', ['parameter' => Parameters::all()->first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parameters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $parameters = new Parameters();
      $parameters->week_end_timesheet        = Carbon::createFromFormat('d/m/Y', $request->get('week_end_timesheet'));

      $parameters->save();

      return redirect('/parameters')->with('success', 'Parameter added with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parameters  $parameters
     * @return \Illuminate\Http\Response
     */
    public function show(Parameters $parameters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parameters  $parameters
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('parameters.edit', ['parameter' => Parameters::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parameters  $parameters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $parameters = Parameters::find($id);
        $parameters->week_end_timesheet        = Carbon::createFromFormat('d/m/Y', $request->get('week_end_timesheet'));
        $parameters->save();

        return redirect('/parameters')->with('success', 'Parameter updated with success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parameters  $parameters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameters $parameters)
    {
        //
    }
}
