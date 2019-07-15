<?php

namespace App\Http\Controllers;

use App\FireMatrix;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use DB;


class FireMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fire_matrix.index', ['matrices' => FireMatrix::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fire_matrix.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $fire = new FireMatrix();
        $fire->reference                = $request->get('reference');
        $fire->service_type             = $request->get('service_type');
        $fire->wall_type                = $request->get('wall_type');
        $fire->wall_type_ref            = $request->get('wall_type_ref');        
        $fire->fire_stop_sys            = $request->get('fire_stop_sys');                
        $fire->test_report_ref          = $request->get('test_report_ref');                        
        $fire->test_specimen            = $request->get('test_specimen');                                
        $fire->frl_achieved             = $request->get('frl_achieved');                                        
        $fire->test_dt                  = Carbon::createFromFormat('Y-m-d', $request->get('test_dt'));
        $fire->comments                 = $request->get('comments');                                                        
        $fire->approval_status          = $request->get('approval_status');                                                        
        $fire->picture                  = $request->get('photo_hidden');
        
        $fire->save();
        
        return redirect('/fire_matrix')->with('success', 'Fire Matrix has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FireMatrix  $fireMatrix
     * @return \Illuminate\Http\Response
     */
    public function show(FireMatrix $fireMatrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FireMatrix  $fireMatrix
     * @return \Illuminate\Http\Response
     */
    public function edit(FireMatrix $fireMatrix)
    {        

        return view('fire_matrix.edit', ['fire_matrix' => $fireMatrix]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FireMatrix  $fireMatrix
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FireMatrix $fireMatrix)
    {
        
        $fire                           = $fireMatrix;
        $fire->reference                = $request->get('reference');
        $fire->service_type             = $request->get('service_type');
        $fire->wall_type                = $request->get('wall_type');
        $fire->wall_type_ref            = $request->get('wall_type_ref');        
        $fire->fire_stop_sys            = $request->get('fire_stop_sys');                
        $fire->test_report_ref          = $request->get('test_report_ref');                        
        $fire->test_specimen            = $request->get('test_specimen');                                
        $fire->frl_achieved             = $request->get('frl_achieved');                                        
        $fire->test_dt                  = is_null($request->get('test_dt')) ? null : Carbon::createFromFormat('Y-m-d', $request->get('test_dt')); 
        $fire->comments                 = $request->get('comments');                                                        
        $fire->approval_status          = $request->get('approval_status');                                                        
        $fire->picture                  = $request->get('photo_hidden');
        
        $fire->save();
        
        return redirect('/fire_matrix')->with('success', 'Fire Matrix has been added');
        
    }


    public function action($id, $action) {
        
        switch ($action) {
            case 'print':
                $matrix = FireMatrix::find($id);
                $report = new \App\FireMatrixReport();                                
                $report->AddPage('L', 'A3');

                $fire_identifications = DB::select(
                    DB::raw(
                        "select *
                        from fire_matrices                        
                        where
                         fire_matrices.id in ($id)"
                    ));
                foreach ($fire_identifications as $fire_identification) {
                    $report->add($fire_identification);
                }                

                return $report->Output();                                
                break;
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FireMatrix  $fireMatrix
     * @return \Illuminate\Http\Response
     */
    public function destroy(FireMatrix $fireMatrix)
    {
        //
    }
}
