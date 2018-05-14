@extends('layouts.app')

@section('content')
<script src="{{ asset('js/qa.js') }}"></script>
<div class="container">
    <h2 style="text-align: center;">Q.A Sign Off</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <button id="btn-create-qa-users" class="btn btn-primary">Create New</button>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>                          
                <th scope="col">#</th>                
                <th scope="col">User</th>             
                <th scope="col">Q.A Type</th>                      
                <th scope="col">Project</th>                      
                <th scope="col">Customer</th>                      
                <th scope="col">Site Manager</th>                      
                <th scope="col">Update Date</th>                      
                <th scope="col">Actions</th>                      
            </tr>
        </thead>
        <tbody>            
    @foreach ($qa_users as $qa_user)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $qa_user->id }}">
                        </th>
                        <td>{{ $qa_user->id }}</td>                    
                        <td>{{ $qa_user->user->username }}</td>                    
                        <td>{{ $qa_user->title }}</td>                                                
                        <td>{{ $qa_user->job['description']}}</td>                                                                        
                        <td>{{ $qa_user->site_manager}}</td>                                                                        
                        <td>{{ $qa_user->customer}}</td>                                                                        
                        <td>{{ Carbon::parse($qa_user->update_date)->format('d/m/Y')}}</td>                                                                        
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                                    
                                    <a class="dropdown-item" href="{{ URL::to('/qa_users/action/' . $qa_user->id .'/print') }}" target="_blank">View</a>                    
                                    <a class="dropdown-item" href="{{ URL::to('/qa_users/' . $qa_user->id .'/edit') }}">Edit</a>                    
                                    <a class="dropdown-item delete" id="{{$qa_user->id}}" href="#">Delete</a>
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalCreateNew">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Q.A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="new_qa_type">Select Q.A Type:</label>
            <select class="form-control" name="new_qa_type">
                   <option value="">Select Type to continue</option>
                @foreach(App\QATypes::all() as $qa_type)
                    <option value="{{$qa_type->id}}">{{$qa_type->title}}</option>
                @endforeach
            </select>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSelectType">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection