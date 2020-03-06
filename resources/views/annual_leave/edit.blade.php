@section('content')
@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/pdf.worker.js') }}"></script>
<script src="{{ asset('js/pdf.js') }}"></script>

        <div class="container">
            <!-- Logo -->
            <div class="row" id="logo">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                    <img src="{{ URL::to('/') }}/img/logo.svg" alt="Smart Plumbing Solutions" class="img-fluid" style="padding: 1em;">
                </div>
            </div>
            <br>
            <!-- Title -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                    <h2>Annual Leave Request</h2>
                </div>
            </div>
            <br>
                <div class="row "  style="padding: 0;">
                <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-12" style="padding: 0;">
                <form action="{{ route('annual_leave.update', $annual_leave->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <!-- Personal Details -->
                        <div class="card shadow" style=""  id="personalDetails">
                            <h5 class="card-header">New Annual Leave Request</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Name:</strong>
                                            </label>
                                            <select class="form-control form-control-lg" name="employee_id">
                                                <option value="">{{'Select Employee'}}</option>
                                              @foreach (App\Employee::where('inactive', 0)->orderBy('name', 'asc')->get() as $employee)
                                                <option value="{{$employee->id}}" {{$employee->id == $annual_leave->employee_id ? 'selected' : ''}}>{{$employee->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <label>
                                                <strong>Start Date:</strong>
                                            </label>
                                            <input type="date" class="form-control form-control-lg" name="start_dt" value="{{$annual_leave->start_dt}}" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label>
                                                <strong>Return Date:</strong>
                                            </label>
                                            <input type="date" class="form-control form-control-lg" name="return_dt" value="{{$annual_leave->return_dt}}" required>
                                        </div>
                                        <br/>
                                        <br/>
                                        <div class="col-md-12 col-12 mt-3">
                                            <label>
                                                <strong>Comments:</strong>
                                            </label>
                                            <textarea class="form-control form-control-lg" id="comments" name="comments" rows="5" style="resize: none;">{{$annual_leave->comments}}</textarea>
                                        </div>

                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Personal Details -->
                        <br>
                        <!-- Signature-->
                        <div class="card shadow" id="additionalLicenses">
                            <h5 class="card-header">Signature</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-row" style="text-align: center;">
                                      <div class="col-md-12 mb-3">
                                        <input type="hidden" name="emp_signature" value="{{$annual_leave->emp_signature}}">
                                          <div id="div_signature" class="div-signature"></div>
                                          <input type="button" value="Clear" id="div_signature" class="btn btn-danger btn-clear-sign" >
                                      </div>
                                      <div class="col-md-3 col-12 mb-3">
                                          <label>
                                              <strong>Date:</strong>
                                          </label>
                                          <input type="text" class="form-control form-control-lg date-picker" name="form_dt" value="{{Carbon::now('Australia/Sydney')->format('d/m/Y')}}" >
                                      </div>
                                  </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Signature-->


                        <!-- End Signature-->

                        <br>
                        <!-- Actions Card-->
                        <div class="card shadow" id="actions">
                            <h5 class="card-header">Actions</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5 col-12 mb-3">
                                            <input id="submit_request" type="submit" class="btn btn-warning" value="Submit"/>
                                            <a href="{{ URL::to('/annual_leave') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Actions Card-->
                        <br>
                    </div>
                </div>
                </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
        <script>
          $(document).ready(function(){
            $('#div_signature').jSignature({
              'decor-color': 'transparent',
            });

            if ($("input[name=emp_signature]").val() !== "") {
              $('#div_signature').jSignature("setData", $("input[name=emp_signature]").val());
            }

            $('form').submit(function(){
                $('input[name=emp_signature]').val($('#div_signature').jSignature("getData"));
            });

            $('.btn-clear-sign').click(function(event) {
              $('#div_signature').jSignature("reset");
            });

          });

        </script>

@endsection
