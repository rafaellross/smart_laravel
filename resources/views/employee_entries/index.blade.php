@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Employees Entries</h2>
    <hr/>
    <div class="form-group row">
      @if(Auth::user()->administrator)
        <div class="col-md-12 col-lg-12 col-12">
            <a href="{{ URL::to('/employee_entries/scan') }}" class="btn btn-primary">Scan QR Code</a>
            <a href="{{ URL::to('/employee_entries/create') }}" class="btn btn-primary">Create New</a>
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>
      @endif

    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">In / Out</th>
                <th scope="col">Notes</th>
                <th scope="col">Entry Date</th>
                <th scope="col">Entry Time</th>
                <th scope="col">Created At</th>
                <th scope="col">Created by</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($employee_entries as $employee_entry)
                  <tr>
                        <th>
                            <input type="checkbox" id="chkRow-{{ $employee_entry->id }}">
                        </th>
                        <td>{{ $employee_entry->id }}</td>
                        <td>{{ strtoupper($employee_entry->name ) }}</td>
                        <td>{{ $employee_entry->in_out ? 'In' : 'Out' }}</td>
                        <td>{{ $employee_entry->notes }}</td>
                        <td>{{ Carbon::parse($employee_entry->entry_dt)->format('d/m/Y') }}</td>
                        <td>{{ App\Hour::convertToHour($employee_entry->entry_time) }}</td>
                        <td>{{Carbon::parse($employee_entry->created_at)->format('d/m/Y - H:i')}}</td>
                        <td>{{ $employee_entry->username }}</td>


                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="employee_entries/action/{{$employee_entry->id}}/print" target="_blank">View</a>
                                    <a class="dropdown-item" href="employee_entries/{{$employee_entry->id}}/edit">Edit</a>
                                    <a class="dropdown-item delete" id="{{$employee_entry->id}}" href="#">Delete</a>
                                </div>
                            </div>
                        </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
