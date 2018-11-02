<?php

namespace App\Http\Controllers;

use App\Tmv;
use App\TmvLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TmvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($job)
    {
        return view('job.tmv.index', ['tmvs' => Tmv::where('job_id', $job)->paginate(20), 'job' => $job]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($job)
     {
         return view('job.tmv.create', ['job' => $job]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($job, Request $request)
    {

              $tmv = new Tmv();
              $tmv->job_id = $job;


              $tmv->name_establishment  = $request->get('name_establishment');
              $tmv->address             = $request->get('address');
              $tmv->phone             = $request->get('phone');
              $tmv->room_number = $request->get('room_number');
              $tmv->location_number = $request->get('location_number');
              $tmv->location = $request->get('location');
              $tmv->type_valve = $request->get('type_valve');
              $tmv->size = $request->get('size');
              $tmv->serial_number = $request->get('serial_number');
              $tmv->temp_range = $request->get('temp_range');

              $tmv->save();

              return redirect('/tmv/' . $job)->with('success', 'TMV has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tmv  $tmv
     * @return \Illuminate\Http\Response
     */
    public function show(Tmv $tmv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tmv  $tmv
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         return view('job.tmv.edit', ['tmv' => Tmv::find($id)]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tmv  $tmv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

          $tmv = Tmv::find($id);
          $tmv->name_establishment  = $request->get('name_establishment');
          $tmv->address             = $request->get('address');
          $tmv->phone             = $request->get('phone');
          $tmv->room_number = $request->get('room_number');
          $tmv->location_number = $request->get('location_number');
          $tmv->location = $request->get('location');
          $tmv->type_valve = $request->get('type_valve');
          $tmv->size = $request->get('size');
          $tmv->serial_number = $request->get('serial_number');
          $tmv->temp_range = $request->get('temp_range');

          $tmv->save();
          return redirect('/tmv/' . $tmv->job_id)->with('success', 'TMV has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tmv  $tmv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tmv $tmv)
    {
        //
    }

    public function action($job, $ids, $action) {

      $arr_ids = explode(",", $ids);

      switch ($action) {

        case 'report':

          $report = new \App\TmvLogReport();

          foreach ($arr_ids as $id) {

            $tmv = TmvLog::find($id);

            $report->add($tmv);

          }

          $report->output();

          break;

        case 'label':
          $report = new \App\LabelTmvLog();
          $report->AddPage('L');

          foreach ($arr_ids as $id) {

            $tmv = Tmv::find($id);

            $report->add($tmv);

          }

          $report->output();
        break;

        case 'update':
          return "here";
        break;
      }
    }

    public function changeJob($ids, $new_job) {
      $arr_ids = explode(",", $ids);
      foreach ($arr_ids as $id) {
        $tmv = Tmv::find($id);
        $tmv->job_id = $new_job;
        $tmv->save();
      }

      return redirect('/tmv/' . $new_job)->with('success', 'TMV Job has been changed');
    }

    public function print($job, $ids, $year = null) {
      if (is_null($year)) {
        $year = Carbon::now()->year;
      }

      $arr_ids = explode(",", $ids);
      $job = \App\Job::find($job);
      $report = new \App\TmvLogRegister();
      $report->job = $job->description;
      $report->address = $job->address;
      $report->phone = $job->phone;
      $report->AddPage('L');
      foreach ($arr_ids as $id) {

        $logs = TmvLog::whereRaw("YEAR(log_dt) = ? and tmv_id = ?", [$year, $id])
                        ->get();

          $report->job = '$logs';
          foreach ($logs as $log) {
            $report->add($log);
          }
      }
      $report->output();

    }


}
