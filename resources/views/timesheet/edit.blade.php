@extends('layouts.app')

@section('content')


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
            <form method="POST" action="{{action('TimeSheetController@update', ['id' => $timesheet->id])}}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="empname">
                        <h5>Name:</h5>
                    </label>
                    <input readonly="" type="text" class="form-control form-control-lg" id="empname" placeholder="Type employee name" value="{{ $timesheet->employee->name }}">
                </div>
                <div class="form-group">
                    <label for="empname">
                        <h5>Week End:</h5>
                    </label>
                    <input type="text" class="form-control form-control-lg date-picker" name="week_end" data-date-days-of-week-disabled="1,2,3,4,5,6" id="week_end" required="" value="{{ Carbon::parse($timesheet->week_end)->format('d/m/Y') }}">
                </div>
                <?php
                    $jobDB = App\Job::select('id', 'code','description')->get();            
                ?>                

                @include('timesheet.partial.autofill')                

                <!-- Start Group Monday-->
                @foreach($timesheet->days as $day)
                    @include('timesheet.partial.edit.day', ['day'=>$day])
                @endforeach                                 
                <!--End Group Monday -->
                <!-- Start Group Tuesday-->
                
                
                <!-- Group Special Request -->
                @include('timesheet.partial.edit.special')                
                <!-- End Group Special Request -->
                <!-- Start Group Total-->
                @include('timesheet.partial.edit.total')                
                <!--End Group Total -->

                <!-- Start Group Signature-->
                <div class="form-group alert alert-success" role="alert" id="groupFriday">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">

                                <input type="hidden" name="emp_signature" id="output" value="">
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
                                <input type="text" class="form-control form-control-lg date-picker" name="empDate" id="empDate" required value="{{Carbon::now()->format('d/m/Y')}}">
                            </div>
                        </div>
                </div>
                <!-- Start Group Date-->
                <div class="form-group alert alert-success" role="alert" id="groupStatus" style="">
                    <h4 style="text-align: center;">Status</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                  <label for="status">Status</label>
                                  <select class="form-control" name="status" id="status">
                                    <option selected="" value="P">Pending</option>
                                    <option value="A">Approved</option>
                                    <option value="A">Finalised</option>
                                    <option value="C">Cancelled</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                </div>
                <!--End Group Total -->
                <div class="form-row" style="text-align: center;">
                    <div class="col-md-6 mb-3">
                        <a href="view.php?type=TimeSheet.php" class="btn btn-secondary btn-lg btn-block">Cancel</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
