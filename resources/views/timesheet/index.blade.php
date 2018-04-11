@extends('layouts.app')

@section('content')

<div class="container">
    <h2 style="text-align: center;">Time Sheet</h2>
    <hr>
    <div class="col-md-12 col-lg-12 col-12">           
        <a href="{{ URL::to('/timesheets/create') }}" class="btn btn-primary">Create New</a>            
        <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
        <button class="btn btn-info" id="btnPrint" style="">Print Selected(s)</button>            
        <button class="btn btn-secondary" id="btnStatus" style="">Change Status</button>            
        <div style="float: right;" id="statusSelect">
            <select class="custom-select mb-4" id="selectStatus">
                <option selected="">Status...</option>
                <option value="all">All</option>
                <option value="A">Approved</option>        
                <option value="P">Pending</option>
                <option value="C">Cancelled</option>
            </select>            

        </div>    
    </div>
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col" class="mobile"><input type="checkbox" id="chkRow"></th>    
                <th scope="col" class="mobile">#</th>
                <th scope="col">User</th>
                <th scope="col" class="mobile">Date</th>

                <th scope="col">Employee</th><th scope="col">Week End</th><th scope="col">Status</th>      <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($timesheets as $timesheet)
            <tr>
            </tr><tr class="P"><th class="mobile"><input type="checkbox" id="chkRow-{{$timesheet->id}}"></th><th class="mobile" scope="row">{{$timesheet->id}}</th>
                <td>{{$timesheet->user()->username}}</td>
                <td class="mobile"{{$timesheet->created_at}}</td>
                <td>{{$timesheet->employee()->name}}</td>
                <td>{{$timesheet->week_end}}</td><td>{{$timesheet->status}}</td><td style="text-align: center;">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="pdf.php?id=1" target="_blank">View</a>
                            <a class="dropdown-item" href="?controller=timesheets&action=edit&id={{$timesheet->id}}" style="">Edit</a>                    
                            <a href="#" id="{{$timesheet->id}}" class="dropdown-item delete" style="">Delete</a>
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