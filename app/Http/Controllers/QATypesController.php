<?php

namespace App\Http\Controllers;

use App\QATypes;
use Illuminate\Http\Request;
use App\QAActivities;

class QATypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('qa.types.index', ['qa_types' => QATypes::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('qa.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        
        $qa_type = new QATypes();
        $qa_type->description   = $request->get('description');
        $qa_type->title         = $request->get('title');
        $qa_type->save();

        foreach ($request->get('activities') as $key => $value) {
            $qa_activities = new QAActivities();
            $qa_activities->qa_type         = $qa_type->id;
            $qa_activities->order           = $value["order"];
            $qa_activities->at              = $value["at"];
            $qa_activities->description     = $value["description"];
            $qa_activities->requirements    = $value["requirements"];
            $qa_activities->save();
        }
        return redirect('/qa_types')->with('success', 'Q.A Type has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QATypes  $qATypes
     * @return \Illuminate\Http\Response
     */
    public function show(QATypes $qATypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QATypes  $qATypes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        return view('qa.types.edit', ['qa_types' => QATypes::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QATypes  $qATypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $qa_type = QATypes::find($id);
        $qa_type->description   = $request->get('description');
        $qa_type->title         = $request->get('title');
        $qa_type->save();

        foreach ($qa_type->activities as $activity) {
            $activity->delete();
        }

        if (!empty($request->get('activities'))) {
            foreach ($request->get('activities') as $key => $value) {
                $qa_activities = new QAActivities();
                $qa_activities->qa_type         = $qa_type->id;
                $qa_activities->order           = $value["order"];
                $qa_activities->at              = $value["at"];
                $qa_activities->description     = $value["description"];
                $qa_activities->requirements    = $value["requirements"];
                $qa_activities->save();
            }
        }

        return redirect('/qa_types')->with('success', 'Q.A Type has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QATypes  $qATypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(QATypes $qATypes)
    {
        //
    }

    public function action($id, $action, $status = null)
    {        

        $ids = explode(",", $id);
        if ($action == "delete") {
            
        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    QATypes::find($id)->delete();
                }                
                return redirect('qa_types')->with('success','Q.A Type(s) has been deleted');        
                break;
            default:
                return redirect('qa_types')->with('error','There was no action selected');        
                break;
        }        
    }    
}
