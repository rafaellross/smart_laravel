@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Employees Applications</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="{{ URL::to('/employee_application/create') }}" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>      
                <th scope="col">E-mail</th>
                <th scope="col">Mobile</th>
            </tr>
        </thead>
        <tbody>            
    @foreach ($employee_applications as $employee_application)
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-{{ $employee_application->id }}">
                        </th>
                        <td>{{ $employee_application->id }}</td>
                        <td>{{ $employee_application->last_name }}</td>
                        <td>{{ $employee_application->first_name }}</td>
                        <td>{{ $employee_application->email }}</td>
                        <td>{{ $employee_application->mobile }}</td>
                        <td>
                        </td>

                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="employee_application/{{$employee_application->id}}">View</a>                    
                                    <a class="dropdown-item" href="employee_application/{{$employee_application->id}}/edit">Edit</a>                    
                                    <a class="dropdown-item delete" id="{{$employee_application->id}}" href="#">Delete</a>
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection