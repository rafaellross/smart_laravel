@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Employees</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="{{ URL::to('/employees/create') }}" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>      
                <th scope="col">Time Sheet</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>            
    @foreach ($employees as $employee)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $employee->id }}">
                        </th>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{$employee->phone}}</td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{action('EmployeeController@edit', $employee->id)}}">Edit</a>                    
                                    <form action="{{action('EmployeeController@destroy', $employee->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="dropdown-item" type="submit">Delete</button>
                                     </form>                                                                        
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection