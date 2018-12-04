@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Annual Leave Request ({{count($annual_leaves)}})</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">
            <a href="{{ URL::to('/annual_leave/create') }}" class="btn btn-primary">Create New</a>
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>


    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Employee</th>
                <th scope="col">Start Date</th>
                <th scope="col">Return Date</th>
                <th scope="col" class="text-center">Time Sheets Generated?</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($annual_leaves as $annual_leave)
                  <tr class="{{$annual_leave->generated ? 'bg-success' : ''}}">
                        <th>
                            <input type="checkbox" id="chkRow-{{ $annual_leave->id }}">
                        </th>
                        <td>{{ $annual_leave->id }}</td>
                        <td>{{ strtoupper($annual_leave->employee->name) }}</td>
                        <td>{{ Carbon::parse($annual_leave->start_dt)->format('d/m/Y')}}</td>
                        <td>{{ Carbon::parse($annual_leave->return_dt)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $annual_leave->generated ? 'Yes' : 'No' }}</td>

                        <td>
                        </td>

                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="annual_leave/action/{{$annual_leave->id}}/generate_timesheets">Generate Timesheets</a>
                                    <a class="dropdown-item" href="employee_application/action/{{$annual_leave->id}}/print" target="_blank">View</a>
                                    <a class="dropdown-item" href="employee_application/{{$annual_leave->id}}/edit">Edit</a>
                                    <a class="dropdown-item delete" id="{{$annual_leave->id}}" href="#">Delete</a>
                                </div>
                            </div>
                        </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
