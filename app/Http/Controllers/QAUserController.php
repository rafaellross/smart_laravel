<?php

namespace App\Http\Controllers;

use App\QAUser;
use Illuminate\Http\Request;
use App\QATypes;
use App\QAUserActivities;
use Carbon\Carbon;
class QAUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('qa.users.index', ['qa_users' => QAUser::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type_id)
    {
        return view('qa.users.create', ['qa_type' => QATypes::find($type_id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $qa_user = new QAUser();
        $qa_user->description           = $request->get('description');
        $qa_user->qa_type               = $request->get('qa_type');
        $qa_user->title                 = $request->get('title');
        $qa_user->update_date           = Carbon::createFromFormat('d/m/Y', $request->get('update_date'));
        $qa_user->revision              = $request->get('revision');
        $qa_user->project               = $request->get('project');
        $qa_user->customer              = $request->get('customer');
        $qa_user->unit_area             = $request->get('unit_area');
        $qa_user->site_manager          = $request->get('site_manager');
        $qa_user->foreman               = $request->get('foreman');
        $qa_user->distribution          = $request->get('distribution');
        $qa_user->location              = $request->get('location');
        $qa_user->save();

        foreach ($request->get('activities') as $key => $value) {
            $qa_activities = new QAUserActivities();
            $qa_activities->qa_type         = $qa_user->id;
            $qa_activities->order           = $value["order"];
            $qa_activities->description     = $value["description"];
            $qa_activities->at              = $value["at"];            
            $qa_activities->requirements    = $value["requirements"];
            $qa_activities->reference       = $value["reference"];
            $qa_activities->installed_by    = $value["installed_by"];
            $qa_activities->checked_by      = $value["checked_by"];
            $qa_activities->activity_date   = Carbon::createFromFormat('d/m/Y', $value["activity_date"]);
            $qa_activities->save();
        }
        return $request;
        //return redirect('/qa_users')->with('success', 'Q.A Type has been added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QAUser  $qAUser
     * @return \Illuminate\Http\Response
     */
    public function show(QAUser $qAUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QAUser  $qAUser
     * @return \Illuminate\Http\Response
     */
    public function edit(QAUser $qAUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QAUser  $qAUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QAUser $qAUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QAUser  $qAUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(QAUser $qAUser)
    {
        //
    }
}
