<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job.index', ['jobs' => Job::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = $this->validate(request(), [
            'code' => 'required|string|max:10',
            'description' => 'required|string|max:100',
            'address' => 'nullable',
        ]);
        Job::create($job);
        return redirect('/jobs')->with('success', 'Job has been added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        return view('job.edit',compact('job','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $this->validate(request(), [
            'code' => 'required|string|max:10',
            'description' => 'required|string|max:100',
            'address' => 'nullable',
        ]);
        $job->code = $request->get('code');
        $job->description = $request->get('description');
        $job->address = $request->get('address');
        $job->save();
        return redirect('/jobs')->with('success', 'Job has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id){
        $job = Job::find($id);
        $job->delete();
        return redirect('jobs')->with('success','Job has been  deleted');
    }

    public function action($id, $action, $status = null)
    {

        $ids = explode(",", $id);
        if ($action == "delete") {

        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    Job::find($id)->delete();
                }
                return redirect('jobs')->with('success','Job(s) has been deleted');
                break;
            default:
                return redirect('jobs')->with('error','There was no action selected');
                break;
        }
    }

}
