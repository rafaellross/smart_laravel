@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2 style="text-align: center;">Employees ({{count($employees)}})</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">
            <a href="{{ URL::to('/employees/create') }}" class="btn btn-primary">Create New</a>
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
            <button class="btn btn-secondary mobile" id="btnEntitlements" style="">Update Entitlements</button>

              <button class="btn btn-info mobile dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Print Selected(s)
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item btnPrintEmployee" href="#" id="awareness">Drug & Alcohol Awareness Card</a>
                <a class="dropdown-item btnPrintEmployee" href="#" id="awareness">ID Card</a>
              </div>
              <div style="float: right;" id="locationSelect">
                  <select class="custom-select mb-4" id="selectLocation">
                      <option selected="">Location...</option>
                      <option value="C">Construction</option>
                      <option value="M">Maintenance</option>
                      <option value="MA">Apprentice - Maintenance</option>
                      <option value="CA">Apprentice - Construction</option>
                      <option value="O">Office</option>
                      <option value="L">Labourer</option>
                      <option value="null/true">Inactives</option>
                  </select>

              </div>

        </div>


    </div>
    <table class="table table-hover table-responsive-sm table-striped table-fixed">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">D.O.B</th>
                <th scope="col">Phone</th>
                <th scope="col">RDO Balance</th>
                <th scope="col">PLD Balance</th>
                <th scope="col">Location</th>
                <th scope="col">Annual Leave Balance</th>
                <th scope="col">Apprentice Year</th>
                <th scope="col">Apprentice Anniversary Date</th>
                <th scope="col">Time Sheet</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($employees as $employee)
                  <tr style="{{is_null($employee->last_timesheet) ? 'background-color: red; color: white;' : ""}}">
                        <th>
                            <input type="checkbox" id="chkRow-{{ $employee->id }}">
                        </th>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{is_null($employee->dob) ? '' :  Carbon::parse($employee->dob)->format('d/m/Y') }}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->rdo_bal}}</td>
                        <td>{{$employee->pld}}</td>
                        <td>{{isset($employee->location) ? $employee->location : ''}}</td>
                        <td>{{$employee->anl}}</td>
                        <td>{{isset($employee->apprentice_year) ? $employee->apprentice_year : ''}}</td>
                        <td>{{isset($employee->anniversary_dt) ? Carbon::parse($employee->anniversary_dt)->format('d/m/Y') : ''}}</td>

                        <td>
                            @if (!is_null($employee->last_timesheet))
                                <a class="btn btn-success" href="timesheets/action/{{$employee->last_timesheet}}/print" role="button" target="_blank">View</a>
                            @else
                                <span>No Time Sheet this Week</span>
                            @endif
                        </td>

                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{URL::to('/employee_entries/'.$employee->id)}}">View Entries</a>
                                    <a class="dropdown-item" href="{{action('EmployeeController@edit', $employee->id)}}">Edit</a>
                                    <a class="dropdown-item delete" id="{{$employee->id}}" href="#">Delete</a>
                                </div>
                            </div>
                        </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalUpdateEntitlements">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{action('EmployeeController@updateEntitlements')}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Employees Entitlements</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">

                <label for="entitlements_balance">Select File:</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="entitlements_balance" name="entitlements_balance" required/>
                    <label class="custom-file-label" for="entitlements_balance">Choose file</label>
                  </div>


            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Continue"/>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
