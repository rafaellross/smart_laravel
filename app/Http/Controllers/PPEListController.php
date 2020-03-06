<?php

namespace App\Http\Controllers;

use App\PPEList;
use Illuminate\Http\Request;
use App\Employee;
use App\Job;

class PPEListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($job)
    {
        return view('job.ppe_list.index', ['job' => $job]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($job_id)
    {

      $jobs = Job::where('inactive', 0)
                     ->orderBy('code', 'asc')
                     ->get();
      $employees = Employee::where('inactive', 0)
                     ->orderBy('name', 'asc')
                     ->get();

        return view('job.ppe_list.create', ['current_job' => $job_id, 'jobs' => $jobs, 'employees' => $employees]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PPEList  $pPEList
     * @return \Illuminate\Http\Response
     */
    public function show(PPEList $pPEList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PPEList  $pPEList
     * @return \Illuminate\Http\Response
     */
    public function edit(PPEList $pPEList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PPEList  $pPEList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PPEList $pPEList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PPEList  $pPEList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PPEList $pPEList)
    {
        //
    }
}
