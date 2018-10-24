@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Employees</div>
                <div class="card-body">

                  <table class="table table-hover table-responsive-sm table-striped table-fixed">
                      <thead>
                          <tr>
                              <th scope="col"><input type="checkbox" id="chkRow"></th>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                          </tr>
                      </thead>
                      <tbody >
                  @foreach ($employees as $employee)

                                  <tr class="">
                                      <th>
                                          <input type="checkbox" id="chkRow-{{ $employee->UID }}">
                                      </th>
                                      <td>{{ $employee->UID }}</td>
                                      <td>{{ $employee->LastName . ',' . $employee->FirstName}}</td>

                                </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
