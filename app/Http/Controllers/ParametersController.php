<?php

namespace App\Http\Controllers;

use App\Parameters;
use Illuminate\Http\Request;

class ParametersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parameters.index', ['parameters' => Parameters::all()]);
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
      $parameters->business_name        = $request->get('business_name');
      $parameters->abn                  = $request->get('abn');
      $parameters->business_address     = $request->get('business_address');
      $parameters->business_suburb      = $request->get('business_suburb');
      $parameters->business_state       = $request->get('business_state');
      $parameters->business_post_code   = $request->get('business_post_code');
      $parameters->business_email       = $request->get('business_email');
      $parameters->business_contact     = $request->get('business_contact');
      $parameters->business_phone       = $request->get('business_phone');
      $parameters->business_no_abn      = $request->get('business_no_abn');
      $parameters->business_signature   = $request->get('business_signature_hidden');

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
        $parameters->business_name        = $request->get('business_name');
        $parameters->abn                  = $request->get('abn');
        $parameters->business_address     = $request->get('business_address');
        $parameters->business_suburb      = $request->get('business_suburb');
        $parameters->business_state       = $request->get('business_state');
        $parameters->business_post_code   = $request->get('business_post_code');
        $parameters->business_email       = $request->get('business_email');
        $parameters->business_contact     = $request->get('business_contact');
        $parameters->business_phone       = $request->get('business_phone');
        $parameters->business_no_abn      = $request->get('business_no_abn');
        $parameters->business_signature   = $request->get('business_signature_hidden');

        $parameters->save();

        return redirect('/parameters')->with('success', 'Parameter added with success');

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
