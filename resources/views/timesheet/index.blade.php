@extends('layouts.app')

@section('content')

<?php

$curr_filter = array();
$curr_filter['status'] = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
$curr_filter['week_end'] = filter_input(INPUT_GET, 'week_end', FILTER_SANITIZE_SPECIAL_CHARS);
$curr_filter['job'] = filter_input(INPUT_GET, 'job', FILTER_SANITIZE_SPECIAL_CHARS);

?>

<div class="container">
    <h2 style="text-align: center;">Time Sheet ({{count($timesheets)}})</h2>
    <hr>
    <div class="col-md-12 col-lg-12 col-12">
        <a href="{{ URL::to('/timesheets/select') }}" class="btn btn-primary">Create New</a>
        @if(Auth::user()->administrator)
            <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
        @endif
        <button class="btn btn-info mobile dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Print Selected(s)
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button class="dropdown-item" id="btnPrint" style="">Time Sheets</button>
          <button class="dropdown-item" id="btnPrintSummary" style="">Time Sheets Summary</button>
        </div>


        @if(Auth::user()->administrator)
        <button class="btn btn-secondary mobile" id="btnStatus" style="">Change Status</button>
        @endif
        <div id="statusSelect" class="mt-2">
            <label for="">Week End:</label>
            <select class="custom-select mb-4" id="selectWeekEnd">
                <option selected="">Week End...</option>
                @foreach ($filter['week_end'] as $week)
                    @if ($loop->first)
                        <option value="{{ $week }}" selected>{{ Carbon::parse($week)->format('d/m/Y') }}</option>
                    @else
                        <option value="{{ $week }}" {{$week == $curr_filter['week_end'] ? 'selected' : ''}}>{{ Carbon::parse($week)->format('d/m/Y') }}</option>
                    @endif

                @endforeach
            </select>

        </div>

        <div id="statusSelect">
          <label for="">Status:</label>
            <select class="custom-select mb-4" id="selectStatus">
                <option selected="">Status...</option>
                @foreach ($filter['status'] as $status)
                    <option value="{{ $status['code'] }}" {{$status['code'] == $curr_filter['status'] || $status['code'] == 'P' ? 'selected' : ''}}>{{ $status['description'] }}</option>
                @endforeach
            </select>
        </div>
        <div id="statusSelect">
            <label for="">Job:</label>
            <select class="custom-select mb-4" id="selectJob">
                <option selected="">Job...</option>
                <option selected="all">All</option>
                @foreach (\App\Job::all() as $job)
                    <option value="{{ $job->code }}" {{$job->code == $curr_filter['job'] ? 'selected' : ''}}>{{ $job->description }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ URL::to('/timesheets?filter=1') }}" class="btn btn-outline-dark">Clear Filters</a>
    </div>
    <table class="table table-hover table-responsive-sm table-striped">
        <thead>
            <tr>
                <th scope="col" class="mobile"><input type="checkbox" id="chkRow"></th>
                <th scope="col" class="mobile">#</th>
                <th scope="col">User</th>
                <th scope="col" class="mobile">Date</th>
                <th scope="col">Employee</th>
                <th scope="col">Total Hours</th>
                <th scope="col">Hours 1.5</th>
                <th scope="col">Hours 2.0</th>
                <th scope="col">Week End</th>
                <th scope="col">Job</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($timesheets as $timesheet)
            <tr>
            </tr><tr class="P"><th class="mobile"><input type="checkbox" id="chkRow-{{$timesheet->id}}"></th><th class="mobile" scope="row">{{$timesheet->id}}</th>
                <td>{{$timesheet->username}}</td>
                <td class="mobile">{{ Carbon::parse($timesheet->created_at, 'Australia/Sydney')->format('d/m/Y H:i') }}</td>
                <td>{{$timesheet->name}}</td>
                <td>{{$timesheet->total}}</td>
                <td>{{$timesheet->total_15}}</td>
                <td>{{$timesheet->total_20}}</td>
                <td>{{Carbon::parse($timesheet->week_end)->format('d/m/Y')}}</td>
                <th scope="col">{{$timesheet->job}}</th>
                <td>{{$timesheet->status}}</td><td style="text-align: center;">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('action_timesheet', ['id' => $timesheet->id, 'action' => 'print']) }}" target="_blank">View</a>
                            <a class="dropdown-item" href="{{ action('TimeSheetController@edit', ['id' => $timesheet->id])}}">Edit</a>
                            @if(Auth::user()->administrator || $timesheet->status == 'P')
                                <a class="dropdown-item delete" id="{{$timesheet->id}}" href="#">Delete</a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalChangeStatus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select new status:</label>
            <select class="form-control" name="changeStatus">
                <option value="P">Pending</option>
                <option value="A">Approved</option>
                <option value="F">Finalised</option>
                <option value="C">Cancelled</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSaveStatus">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
