@extends('layouts.app')

@section('content')

<style type="text/css">
@media only screen and (max-width: 600px) {
    .container {
        width: 100vw;
        padding: 0;
    }

    .container .col-xs-12, .alert {
        width: 100vw;
        padding: 1px;
    }

}
</style>
<div class="container">

        <!-- Logo -->
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                <img src="{{ URL::to('/') }}/img/logo.svg" alt="Smart Plumbing Solutions" class="img-fluid" style="padding: 1em;">
            </div>
        <!-- Title -->
        <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
            <h2>Time Sheet</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="{{action('TimeSheetController@store')}}" id="timesheet_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="empname">
                        <h5>Name:</h5>
                    </label>
                    @foreach($employees as $employee)
                        <input readonly="" type="text" class="form-control form-control-lg" id="empname" placeholder="Type employee name" value="{{ $employee->name}}">
                        <input type="hidden" name="employees[{{$employee->id}}]" value="{{$employee->id}}">
                        <input type="hidden" name="employees[{{$employee->id}}][pld_bal]" value="{{$employee->pld}}" />
                        <input type="hidden" name="employees[{{$employee->id}}][rdo_bal]" value="{{$employee->rdo_bal}}" />
                        <input type="hidden" name="employees[{{$employee->id}}][anl_bal]" value="{{$employee->anl}}" />
                        <input type="hidden" name="employees[{{$employee->id}}][sick_bal]" value="{{$employee->sick_bal}}" />

                    @endforeach
                </div>
                <div class="form-group">
                    <label for="empname">
                        <h5>Week End:</h5>
                    </label>
                    <input type="text" class="form-control form-control-lg" name="week_end" data-date-days-of-week-disabled="1,2,3,4,5,6" id="week_end" required="" value="{{Carbon::parse(App\Parameters::all()->first()->week_end_timesheet)->format('d/m/Y')}}" autocomplete="off" {{isset(Auth::user()->administrator) && Auth::user()->administrator ? '' : 'readonly'}}>
                    @if ($errors->has('week_end'))
                        <span class="invalid-feedback" style="display: block;">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                                <br>
                            @endforeach
                        </span>
                    @endif

                </div>
                <?php
                    $jobDB = App\Job::select('code','description')->get();
                ?>

                @include('timesheet.partial.autofill')

                <!-- Start Group Monday-->
                @foreach($days as $day)
                    @include('timesheet.partial.create.day', ['day'=>$day])
                @endforeach

                <!--End Group Monday -->
                <!-- Start Group Tuesday-->
                <div class="form-group alert alert-info" role="alert">
                    <h4 style="text-align: center;">Medical Certificates</h4>
                    <div class="alert alert-secondary">
                        <h5 style="text-align: center;">Certificate 1</h5>
                        <div class="input-group col-12 mb-3">
                          <div class="custom-file" id="medical_certificates_list">
                            <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[1]" name="medical_certificates[1]" accept="image/*"/>
                            <label class="custom-file-label" for="medical_certificates[1]">Choose files</label>
                          </div>
                        </div>
                        <div class="input-group col-12 mb-3">
                            <img id="medical_certificates[1]_img" class="img-fluid" style="" src="">
                        </div>
                        <input id="medical_certificates[1]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                        <input type="hidden" class="custom-file-input" id="medical_certificates[1]_hidden" name="medical_certificates[1]_hidden" value="">
                    </div>
                    <div id="aditional_certificates">

                    </div>
                    <div>
                        <input id="addCert" type="button" class="btn btn-success btn-sm ml-2 addCert" value="Add Certificate">
                    </div>
                </div>

                <!-- Group Special Request -->
                @include('timesheet.partial.create.special')
                <!-- End Group Special Request -->
                <!-- Start Group Total-->
                @include('timesheet.partial.create.total')
                <!--End Group Total -->

                <!-- Start Group Signature-->
                <div class="form-group alert alert-success" role="alert" id="groupFriday">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">

                                <input type="hidden" name="emp_signature" id="output" value="{{old('week_end')}}">
                                <div id="signature"></div>

                                <input type="button" value="Clear" id="btnClearSign" class="btn btn-danger" >

                                <script>
                                    $(document).ready(function() {
                                        var $sigdiv = $("#signature")
                                        $sigdiv.jSignature() // inits the jSignature widget.
                                        // after some doodling...
                                        $('#btnClearSign').click(function(){
                                            $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
                                        });

                                       $('form').submit(function(){
                                           $('#output').val($sigdiv.jSignature("getData"));
                                       });
                                    });
                                </script>
                            </div>
                        </div>
                </div>
                <!-- Start Group Date-->
                <div class="form-group alert alert-success" role="alert" id="groupFriday">
                    <h4 style="text-align: center;">Date</h4>

                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control form-control-lg date-picker" name="empDate" id="empDate" required value="{{Carbon::now('Australia/Sydney')->format('d/m/Y')}}">
                            </div>
                        </div>
                </div>
                <!-- Start Group Date-->
                <div class="form-group alert alert-success" role="alert" id="groupStatus" style="{{!Auth::user()->administrator ? 'display: none;' : '' }}">
                    <h4 style="text-align: center;">Status</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                  <label for="status">Status</label>
                                  <select class="form-control" name="status" id="status">
                                    <option selected value="P">Pending</option>
                                    <option value="A" {{ old('status') == 'A' ? 'selected' : ''}}>Approved</option>
				                             <option value="F" {{ old('status') == 'F' ? 'selected' : ''}}>Finalised</option>
                                    <option value="C" {{ old('status') == 'C' ? 'selected' : ''}}>Cancelled</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                </div>
                <!--End Group Total -->
                <div class="form-row" style="text-align: center;">
                    <div class="col-md-6 mb-3">
                        <a href="../" class="btn btn-secondary btn-lg btn-block">Cancel</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(count(old()) > 0)
    {{dd( old())}}
    @endif

@include('timesheet.partial.description')
@endsection
