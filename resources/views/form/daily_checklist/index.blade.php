@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container">
    <h2 style="text-align: center;">Daily Plant Inspection Checklist</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="{{ URL::to('/form_checklist/create') }}" class="btn btn-primary btn-lg">Create New</a>                
            <a href="#" class="btn btn-danger mobile btn-lg" id="btnDelete">Delete Selected(s)</a>
            <button class="btn btn-info mobile btn-lg" id="btnPrintChecklist" style="">Print Selected(s)</button>                        
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>                          
                <th scope="col">#</th>                
                <th scope="col">Project</th>                      
                <th scope="col">Date</th>                                                      
                <th scope="col">Actions</th>                      
            </tr>
        </thead>
        <tbody>            
    @foreach ($form_daily_checklists as $form_checklist)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $form_checklist->id }}">
                        </th>
                        <td>{{ $form_checklist->id }}</td>                    
                        <td>{{ $form_checklist->job_site }}</td>                        
                        <td>{{ Carbon::parse($form_checklist->dt_form)->format('d/m/Y')}}</td>                        
                        
                        
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                    <a class="dropdown-item" href="{{ URL::to('/form_checklist/action/' . $form_checklist->id .'/print') }}" target="_blank">View</a>                    
                                    <a class="dropdown-item" href="{{action('FormDailyCheckListController@edit', $form_checklist->id)}}">Edit</a>                    
                                    <a class="dropdown-item delete" id="{{$form_checklist->id}}" href="#">Delete</a>
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
