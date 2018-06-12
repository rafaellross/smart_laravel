@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Jobs</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="{{ URL::to('/jobs/create') }}" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>                          
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Description</th>      
                <th scope="col">Address</th>                
            </tr>
        </thead>
        <tbody>            
    @foreach ($jobs as $job)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $job->id }}">
                        </th>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->code }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{$job->address}}</td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('JobController@edit', $job->id)}}">Edit</a>                    
                                    <a class="dropdown-item delete" id="{{$job->id}}" href="#">Delete</
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection