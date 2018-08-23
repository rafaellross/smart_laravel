<?php

namespace App\Http\Controllers;

use App\FireIdentification;
use Illuminate\Http\Request;
use App\Job;
use App\FireIdentificationPhotos;
use Carbon\Carbon;
use DB;

class FireIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($job)
    {
      $drawing_filter = filter_input(INPUT_GET, 'drawing', FILTER_SANITIZE_SPECIAL_CHARS);
      $drawings = DB::select(DB::raw("select DISTINCT drawing from fire_identifications where job_id = $job order by drawing"));
      if (is_null($drawing_filter) || $drawing_filter == "all") {
        return view('job.fire_identification.index', ['job' => $job, 'fire_seals' => FireIdentification::where('job_id', $job)->orderBy('fire_seal_ref')->get(['id', 'drawing', 'fire_seal_ref', 'fire_resist_level', 'install_by', 'install_dt']), 'max_id' => DB::select(DB::raw('select if(max(fire_number) is null, 0, max(fire_number))  as fire_number from fire_identifications where job_id = ' . $job .';'))[0]->fire_number+1, 'drawings' => $drawings]);
      } else {
        return view('job.fire_identification.index', ['job' => $job, 'fire_seals' => FireIdentification::where('job_id', $job)->where('drawing', $drawing_filter)->orderBy('fire_seal_ref')->get(['id', 'drawing', 'fire_seal_ref', 'fire_resist_level', 'install_by', 'install_dt']), 'max_id' => DB::select(DB::raw('select if(max(fire_number) is null, 0, max(fire_number))  as fire_number from fire_identifications where job_id = ' . $job .';'))[0]->fire_number+1, 'drawings' => $drawings]);
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($job)
    {
        return view('job.fire_identification.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($job, Request $request)
    {

        $fire = new FireIdentification();
        $fire->job_id = $job;
        $fire->fire_seal_ref            = DB::select(DB::raw('select if(max(fire_number) is null, 0, max(fire_number))  as fire_number from fire_identifications where job_id = ' . $job .';'))[0]->fire_number+1;
        $fire->drawing                  = $request->get('drawing');
        $fire->fire_number              =  DB::select(DB::raw('select if(max(fire_number) is null, 0, max(fire_number))  as fire_number from fire_identifications where job_id = ' . $job .';'))[0]->fire_number+1;
        $fire->fire_resist_level        = $request->get('fire_resist_level');
        $fire->install_dt               = Carbon::createFromFormat('d/m/Y', $request->get('install_dt'));

        $fire->install_by               = $request->get('install_by');
        $fire->manufacturer             = $request->get('manufacturer');
        $fire->fire_photo         = $request->get('photo_hidden');

        $fire->save();

        return redirect('/fire_identification/' . $job)->with('success', 'Fire Seal has been added');;
    }

    public function multiple($job, Request $request){
      //return $request;
        for ($i= intval($request->get('start_number')); $i <= intval($request->get('end_number')); $i++) {
            $fire = new FireIdentification();
            $fire->job_id = $job;
            $fire->fire_number              = $i;
            $fire->drawing                  = $request->get('drawing');
            $fire->fire_seal_ref            = $i;
            $fire->fire_resist_level        = $request->get('fire_resist_level');
            $fire->install_dt               = Carbon::createFromFormat('d/m/Y', $request->get('install_dt'));

            $fire->install_by               = $request->get('install_by');
            $fire->manufacturer             = $request->get('manufacturer');
            $fire->fire_photo               = $request->get('photo_hidden');

            $fire->save();

        }

        return redirect('/fire_identification/' . $job)->with('success', 'Fire Seal has been added');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function show(FireIdentification $fireIdentification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fire_seal = FireIdentification::find($id);

        return view('job.fire_identification.edit', ['fire_seal' => $fire_seal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fire = FireIdentification::find($id);
        $fire->fire_seal_ref            = $request->get('fire_seal_ref');
        $fire->fire_resist_level        = $request->get('fire_resist_level');
        $fire->install_dt               = Carbon::createFromFormat('d/m/Y', $request->get('install_dt'));
        $fire->drawing                  = $request->get('drawing');
        $fire->install_by               = $request->get('install_by');
        $fire->manufacturer             = $request->get('manufacturer');
        $fire->fire_photo               = $request->get('photo_hidden');

        $fire->save();
        return redirect('/fire_identification/' . $fire->job_id)->with('success', 'Fire Seal has been updated');;

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FireIdentification  $fireIdentification
     * @return \Illuminate\Http\Response
     */
    public function destroy(FireIdentification $fireIdentification)
    {
        //
    }

    public function action($job, $id, $action, $drawing = null, $null = 0) {
        switch ($action) {
            case 'delete':
                    DB::table('fire_identifications')->whereRaw("id in ($id)")->delete();
                    return redirect('/fire_identification/' . $job)->with('success', 'Fire Seal has been deleted');;
            case 'label':
                $label = new \App\LabelPenetration ();
                $label->AddPage('L');

                $fire_identifications = DB::select(
                    DB::raw(
                        "select jobs.description, fire_identifications.*
                        from fire_identifications
                        inner join jobs
                        on jobs.id = fire_identifications.job_id
                        where fire_identifications.id in ($id)
                        order by fire_number
                         "));
                foreach ($fire_identifications as $fire_identification) {

                    $label->add($fire_identification);
                    if ($label->labelNumber == 4) {
                        //$label->AddPage('L');
                    }

                }
                return $label->output();

                break;
            case 'report':
                $report = new \App\PenetrationList ();
                $job_obj = Job::find($job);
                $report->job = $job_obj->description;
                $report->address = $job_obj->address;
                $report->AddPage('L');

                $fire_identifications = DB::select(
                    DB::raw(
                        "select jobs.description, fire_identifications.*
                        from fire_identifications
                        inner join jobs
                        on jobs.id = fire_identifications.job_id
                        where
                         fire_identifications.drawing = '" . $drawing . "'

                         and fire_identifications.fire_photo is ".($null == 0 ? 'not' : '')." null
                        order by fire_seal_ref
                         "));
                foreach ($fire_identifications as $fire_identification) {
                    $report->add($fire_identification);
                }
                return $report->output();

                break;

        }
    }
}
