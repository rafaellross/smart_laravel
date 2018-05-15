<?php

namespace App\Http\Controllers;

use App\FormPreStart;
USE App\FormPreStartSignature;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\FormPreStartReport;
class FormPreStartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form.prestart.index', ['form_prestarts' => FormPreStart::orderBy('dt_form', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.prestart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $prestart = new FormPreStart();
        $prestart->user_id = Auth::user()->id;
        $prestart->dt_form = Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));
        $prestart->time = $request->get('time');
        $prestart->project = $request->get('project');
        $prestart->foreman = $request->get('foreman');
        $prestart->details = $request->get('details');
        $prestart->save();
        
        foreach ($request->get('persons') as $key => $person) {
            $person_sig = new FormPreStartSignature();
            $person_sig->prestart_id    = $prestart->id;
            $person_sig->number         = $key;
            $person_sig->name           = $person['name'];
            $person_sig->signature      = $person['signature'];
            $person_sig->save();            
        }
        return redirect('/form_prestart')->with('success', 'Prestart has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormPreStart  $formPreStart
     * @return \Illuminate\Http\Response
     */
    public function show(FormPreStart $formPreStart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormPreStart  $formPreStart
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('form.prestart.edit', ['form_prestart' => FormPreStart::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormPreStart  $formPreStart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prestart = FormPreStart::find($id);
        $prestart->user_id = Auth::user()->id;
        $prestart->dt_form = Carbon::createFromFormat('d/m/Y', $request->get('dt_form'));
        $prestart->time = $request->get('time');
        $prestart->project = $request->get('project');
        $prestart->foreman = $request->get('foreman');
        $prestart->details = $request->get('details');
        $prestart->save();
        
        foreach ($prestart->persons as $person) {
                    $person->delete();
        }        

        foreach ($request->get('persons') as $key => $person) {
            $person_sig = new FormPreStartSignature();
            $person_sig->prestart_id    = $prestart->id;
            $person_sig->number         = $key;
            $person_sig->name           = $person['name'];
            $person_sig->signature      = $person['signature'];
            $person_sig->save();            
        }
        return redirect('/form_prestart')->with('success', 'Prestart has been updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormPreStart  $formPreStart
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormPreStart $formPreStart)
    {
        //
    }

    public function action($id, $action)
    {        

        $ids = explode(",", $id);

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    FormPreStart::find($id)->delete();
                }                
                return redirect('form_prestart')->with('success','Prestart(s) has been deleted');        
                break;
            case 'print':
                
                $report = new FormPreStartReport();
                
                foreach ($ids as $id) {
                    $form_prestart = FormPreStart::find($id);
                    if ($form_prestart) {
                        $report->add($form_prestart);
                    }
                }
                return $report->output();
                break;

            default:
                return redirect('form_prestart')->with('error','There was no action selected');        
                break;
        }        
    }    

}
