<?php

namespace App\Http\Controllers;

use App\QAUser;
use Illuminate\Http\Request;
use App\QATypes;
use App\QAUserActivities;
use App\QAUserReport;
use App\QAUserPhoto;
use Carbon\Carbon;
use Auth;
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
        $qa_user->user_id               = Auth::user()->id;
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
        $qa_user->comments              = trim(stripslashes(htmlentities($request->get('comments'))));
        $qa_user->location              = $request->get('location');
        $qa_user->approved_name_1       = $request->get('approved_name_1');
        $qa_user->approved_name_2       = $request->get('approved_name_2');
        $qa_user->approved_name_3       = $request->get('approved_name_3');
        $qa_user->approved_name_4       = $request->get('approved_name_4');
        $qa_user->approved_company_1    = $request->get('approved_company_1');
        $qa_user->approved_company_2    = $request->get('approved_company_2');
        $qa_user->approved_company_3    = $request->get('approved_company_3');
        $qa_user->approved_company_4    = $request->get('approved_company_4');
        $qa_user->approved_position_1   = $request->get('approved_position_1');
        $qa_user->approved_position_2   = $request->get('approved_position_2');
        $qa_user->approved_position_3   = $request->get('approved_position_3');
        $qa_user->approved_position_4   = $request->get('approved_position_4');
        $qa_user->approved_sign_1       = $request->get('img_signature_1');
        $qa_user->approved_sign_2       = $request->get('img_signature_2');
        $qa_user->approved_sign_3       = $request->get('img_signature_3');
        $qa_user->approved_sign_4       = $request->get('img_signature_4');
        $qa_user->save();

        if (!empty($request->get('photos')) > 0) {

            foreach ($request->get('photos') as $key => $photo) {
                
                $qa_photo                  = new QAUserPhoto();
                $qa_photo->qa_user         = $qa_user->id;
                $qa_photo->photo_number    = $key;
                $qa_photo->qa_photo        = $photo;
                $qa_photo->save();                                
            }            
        }

        foreach ($request->get('activities') as $key => $value) {
            $qa_activities = new QAUserActivities();
            $qa_activities->qa_type         = $qa_user->id;
            $qa_activities->order           = $value["order"];
            $qa_activities->description     = $value["description"];
            $qa_activities->at              = $value["at"];            
            $qa_activities->requirements    = $value["requirements"];
            $qa_activities->reference       = $value["reference"];
            $qa_activities->installed_by    = $value["installed_by"];
            $qa_activities->yes_no          = $value["yes_no"];
            $qa_activities->checked_by      = $value["checked_by"];
            $qa_activities->activity_date   = Carbon::createFromFormat('d/m/Y', $value["activity_date"]);
            $qa_activities->save();
        }

        return redirect('/qa_users')->with('success', 'Q.A Sign Off has been added');
        
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
    public function edit($id)
    {
        return view('qa.users.edit', ['qa_user' => QAUser::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QAUser  $qAUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $qa_user                        = QAUser::find($id);
        $qa_user->user_id               = Auth::user()->id;
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
        $qa_user->comments              = trim(stripslashes(htmlentities($request->get('comments'))));
        $qa_user->location              = $request->get('location');
        $qa_user->approved_name_1       = $request->get('approved_name_1');
        $qa_user->approved_name_2       = $request->get('approved_name_2');
        $qa_user->approved_name_3       = $request->get('approved_name_3');
        $qa_user->approved_name_4       = $request->get('approved_name_4');
        $qa_user->approved_company_1    = $request->get('approved_company_1');
        $qa_user->approved_company_2    = $request->get('approved_company_2');
        $qa_user->approved_company_3    = $request->get('approved_company_3');
        $qa_user->approved_company_4    = $request->get('approved_company_4');
        $qa_user->approved_position_1   = $request->get('approved_position_1');
        $qa_user->approved_position_2   = $request->get('approved_position_2');
        $qa_user->approved_position_3   = $request->get('approved_position_3');
        $qa_user->approved_position_4   = $request->get('approved_position_4');
        $qa_user->approved_sign_1       = $request->get('img_signature_1');
        $qa_user->approved_sign_2       = $request->get('img_signature_2');
        $qa_user->approved_sign_3       = $request->get('img_signature_3');
        $qa_user->approved_sign_4       = $request->get('img_signature_4');

        $qa_user->save();

        foreach ($qa_user->photos as $photo) {
            $photo->delete();
        }

        if (!empty($request->get('photos')) > 0) {

            foreach ($request->get('photos') as $key => $photo) {
                
                $qa_photo                  = new QAUserPhoto();
                $qa_photo->qa_user         = $qa_user->id;
                $qa_photo->photo_number    = $key;
                $qa_photo->qa_photo        = $photo;
                $qa_photo->save();                                
            }            
        }

        foreach ($qa_user->activities as $activity) {
            $activity->delete();
        }

        foreach ($request->get('activities') as $key => $value) {
            $qa_activities                  = new QAUserActivities();
            $qa_activities->qa_type         = $qa_user->id;
            $qa_activities->order           = $value["order"];
            $qa_activities->description     = $value["description"];
            $qa_activities->at              = $value["at"];            
            $qa_activities->requirements    = $value["requirements"];
            $qa_activities->reference       = $value["reference"];
            $qa_activities->installed_by    = $value["installed_by"];
            $qa_activities->checked_by      = $value["checked_by"];
            $qa_activities->yes_no          = $value["yes_no"];
            $qa_activities->activity_date   = Carbon::createFromFormat('d/m/Y', $value["activity_date"]);
            $qa_activities->save();
        }
        
        return redirect('/qa_users')->with('success', 'Q.A Sign Off has been updated');
        
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

    public function action($id, $action, $status = null)
    {        

        $ids = explode(",", $id);

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    QAUser::find($id)->delete();
                }                
                return redirect('qa_users')->with('success','Q.A Sign Off(s) has been deleted');        
                break;

            case 'print':
                
                $report = new QAUserReport();
                
                foreach ($ids as $id) {
                    $qa_user = QAUser::find($id);
                    if ($qa_user) {
                        $report->add($qa_user);
                    }
                }
                return $report->output();
                break;

            default:
                return redirect('qa_users')->with('error','There was no action selected');        
                break;
        }        
    }      
}
