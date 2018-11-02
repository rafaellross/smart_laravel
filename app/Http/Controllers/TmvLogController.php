<?php

namespace App\Http\Controllers;

use App\TmvLog;
use Illuminate\Http\Request;

class TmvLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tmv)
    {

        return view('job.tmv_log.index', ['logs' => TmvLog::where('tmv_id', $tmv)->paginate(20), 'tmv' =>$tmv]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tmv)
    {
        return view('job.tmv_log.create', ['tmv' => $tmv]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {

        $tmv = new TmvLog();
        $tmv->log_dt = $request->get('log_dt');
        $tmv->tmv_id = $id;
        $tmv->type  = $request->get('type');

        $tmv->task_tk_1 = $request->get('task_tk_1') == "on" ? true : false;
        $tmv->task_tk_2 = $request->get('task_tk_2') == "on" ? true : false;
        $tmv->task_tk_3 = $request->get('task_tk_3') == "on" ? true : false;
        $tmv->task_tk_4 = $request->get('task_tk_4') == "on" ? true : false;
        $tmv->task_tk_5 = $request->get('task_tk_5') == "on" ? true : false;
        $tmv->task_tk_6 = $request->get('task_tk_6') == "on" ? true : false;
        $tmv->task_tk_7 = $request->get('task_tk_7') == "on" ? true : false;

        $tmv->task_rmk_1 = $request->get('task_rmk_1');
        $tmv->task_rmk_2 = $request->get('task_rmk_2');
        $tmv->task_rmk_3 = $request->get('task_rmk_3');
        $tmv->task_rmk_4 = $request->get('task_rmk_4');
        $tmv->task_rmk_5 = $request->get('task_rmk_5');
        $tmv->task_rmk_6 = $request->get('task_rmk_6');
        $tmv->task_rmk_7 = $request->get('task_rmk_7');

        //Endorsed 1
        $tmv->endorsed_by1 = $request->get('endorsed_by1');
        $tmv->endorsed_position1 = $request->get('endorsed_position1');

        //Thermal shut off test
        $tmv->temp_bfr_test = $request->get('temp_bfr_test');
        $tmv->temp_reset = $request->get('temp_reset');
        $tmv->therm_shutoff = $request->get('therm_shutoff_pass') == "on" ? true : false;

        //Serviceman 2
        $tmv->serviceman2 = $request->get('serviceman2');
        $tmv->serviceman2_lic = $request->get('serviceman2_lic');

        //Endorsed 2
        $tmv->endorsed_by2 = $request->get('endorsed_by2');
        $tmv->endorsed_position2 = $request->get('endorsed_position2');


        $tmv->serviceman2_sig = $request->get('hidden_serviceman2_sig');

        $tmv->endorsed1_sig = $request->get('hidden_endorsed1_sig');
        $tmv->endorsed2_sig = $request->get('hidden_endorsed2_sig');

        $tmv->photo = $request->get('photo_hidden');

        $tmv->save();

        return redirect('/tmv_log/' . $id)->with('success', 'TMV Log has been added');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TmvLog  $tmvLog
     * @return \Illuminate\Http\Response
     */
    public function show(TmvLog $tmvLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TmvLog  $tmvLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('job.tmv_log.edit', ['tmv' => TmvLog::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TmvLog  $tmvLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmvLog $tmv)
    {
        //return $request;
        $tmv->log_dt = $request->get('log_dt');

        $tmv->type  = $request->get('type');

        $tmv->task_tk_1 = $request->get('task_tk_1') == "on" ? true : false;
        $tmv->task_tk_2 = $request->get('task_tk_2') == "on" ? true : false;
        $tmv->task_tk_3 = $request->get('task_tk_3') == "on" ? true : false;
        $tmv->task_tk_4 = $request->get('task_tk_4') == "on" ? true : false;
        $tmv->task_tk_5 = $request->get('task_tk_5') == "on" ? true : false;
        $tmv->task_tk_6 = $request->get('task_tk_6') == "on" ? true : false;
        $tmv->task_tk_7 = $request->get('task_tk_7') == "on" ? true : false;

        $tmv->task_rmk_1 = $request->get('task_rmk_1');
        $tmv->task_rmk_2 = $request->get('task_rmk_2');
        $tmv->task_rmk_3 = $request->get('task_rmk_3');
        $tmv->task_rmk_4 = $request->get('task_rmk_4');
        $tmv->task_rmk_5 = $request->get('task_rmk_5');
        $tmv->task_rmk_6 = $request->get('task_rmk_6');
        $tmv->task_rmk_7 = $request->get('task_rmk_7');


        //Endorsed 1
        $tmv->endorsed_by1 = $request->get('endorsed_by1');
        $tmv->endorsed_position1 = $request->get('endorsed_position1');

        //Thermal shut off test
        $tmv->temp_bfr_test = $request->get('temp_bfr_test');
        $tmv->temp_reset = $request->get('temp_reset');
        $tmv->therm_shutoff = $request->get('therm_shutoff_pass') == "on" ? true : false;

        //Serviceman 2
        $tmv->serviceman2 = $request->get('serviceman2');
        $tmv->serviceman2_lic = $request->get('serviceman2_lic');

        //Endorsed 2
        $tmv->endorsed_by2 = $request->get('endorsed_by2');
        $tmv->endorsed_position2 = $request->get('endorsed_position2');


        $tmv->serviceman2_sig = $request->get('hidden_serviceman2_sig');
        $tmv->save();
        $tmv->endorsed1_sig = $request->get('hidden_endorsed1_sig');
        $tmv->save();
        $tmv->endorsed2_sig = $request->get('hidden_endorsed2_sig');
        $tmv->save();


        $photo = $this->createImageFromBase64($request->get('photo_hidden'), $tmv->id);
        $this->compress($photo, $photo, 50);

        $type = pathinfo($photo, PATHINFO_EXTENSION);
        $data = file_get_contents($photo);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


        $tmv->photo = $base64;

        $tmv->save();
        


        return redirect('/tmv_log/' . $tmv->tmv_id)->with('success', 'TMV Log has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TmvLog  $tmvLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TmvLog $tmvLog)
    {
        //
    }

    public function action($ids, $action) {

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

            $tmv = TmvLog::find($id);

            $report->add($tmv);

          }

          $report->output();
        break;
      }
    }

    public function createImageFromBase64($data, $path = ""){
       $file_data = $data;
       $file_name = $path . time().'.png'; //generating unique file name;
       @list($type, $file_data) = explode(';', $file_data);
       @list(, $file_data) = explode(',', $file_data);
       if($file_data!=""){ // storing image in storage/app/public Folder
              \Storage::disk('public')->put($file_name,base64_decode($file_data));
        }
        return \Storage::disk('public')->path($file_name);
    }

    function compress($source, $destination, $quality) {

    		$info = getimagesize($source);

    		if ($info['mime'] == 'image/jpeg')
    			$image = imagecreatefromjpeg($source);

    		elseif ($info['mime'] == 'image/gif')
    			$image = imagecreatefromgif($source);

    		elseif ($info['mime'] == 'image/png')
    			$image = imagecreatefrompng($source);

    		imagejpeg($image, $destination, $quality);

    		return $destination;
    	}

}
