@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Q.A Types</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <button href="{{ URL::to('/qa_types/create') }}" class="btn btn-primary">Create New</button>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>                          
                <th scope="col">#</th>                
                <th scope="col">Title</th>                      
                <th scope="col">Description</th>                      
                <th scope="col">Actions</th>                      
            </tr>
        </thead>
        <tbody>            
    @foreach ($qa_types as $qa_type)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $qa_type->id }}">
                        </th>
                        <td>{{ $qa_type->id }}</td>                    
                        <td>{{ $qa_type->title }}</td>                        
                        <td>{{ $qa_type->description }}</td>                        
                        
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('QATypesController@edit', $qa_type->id)}}">Edit</a>                    
                                    <a class="dropdown-item delete" id="{{$qa_type->id}}" href="#">Delete</a>
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection