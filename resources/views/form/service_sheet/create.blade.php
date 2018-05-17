@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Service Sheet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_checklist.store') }}">
                        @csrf                        
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::now('Australia/Sydney')->format('d/m/Y') }}" >
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="job_no" class="col-form-label text-md-right">{{ __('Job Nº:') }}</label>
                                <input type="text" class="form-control" name="working_for" value="" >
                                @if ($errors->has('job_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('working_for') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="customer_name" class="col-form-label text-md-right">{{ __('Customer Name:') }}</label>
                                <input type="text" class="form-control" name="customer_name" value="" >
                                @if ($errors->has('customer_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="sample" class="col-form-label text-md-right">{{ __('Sample:') }}</label>
                                <input id="sample" type="text" class="form-control" name="sample" value="" >
                                @if ($errors->has('sample'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sample') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>















                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="sample" class="col-form-label text-md-right">{{ __('Sample:') }}</label>
                                <input type="text" class="form-control" name="working_for" value="" >
                                @if ($errors->has('sample'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sample') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="sample" class="col-form-label text-md-right">{{ __('Sample:') }}</label>
                                <input id="sample" type="text" class="form-control" name="sample" value="" >
                                @if ($errors->has('sample'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sample') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="make_model" class="col-form-label text-md-right">{{ __('Make & Model:') }}</label>
                                <input type="text" class="form-control" name="make_model" value="" >
                                @if ($errors->has('make_model'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('make_model') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="make_model" class="col-form-label text-md-right">{{ __('Serial Nº:') }}</label>
                                <input type="text" class="form-control" name="serial_no" value="">
                                @if ($errors->has('make_model'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('make_model') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="job_site" class="col-form-label text-md-right">{{ __('Job Site:') }}</label>
                                <select class="form-control" name="job_site">
                                       <option value="">Select Project</option>
                                    @foreach(App\Job::all() as $job)
                                        @if(!in_array($job->code, ['rdo', 'pld', 'tafe', 'sick', 'anl', 'holiday']))
                                        <option value="{{$job->description}}" selected>{{$job->description}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="reg_permit" class="col-form-label text-md-right">{{ __('Registration or Permit Nº:') }}</label>
                                <input type="text" class="form-control" name="reg_permit" value="">
                                @if ($errors->has('reg_permit'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reg_permit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="expire_dt" class="col-form-label text-md-right">{{ __('Expiry Date:') }}</label>
                                <input id="expire_dt" type="text" class="form-control date-picker" name="expire_dt" value="">
                                @if ($errors->has('expire_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('expire_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="km_reading" class="col-form-label text-md-right">{{ __('Hour Metre / KM Reading:') }}</label>
                                <input type="text" class="form-control" name="km_reading" value="" >
                                @if ($errors->has('km_reading'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('km_reading') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Checklist</h4>
                        <div class="row text-center font-weight-bold card-header mb-1">                            
                            <div class="col-md-5">                                
                                <span>Item</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Monday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Tuesday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Wednesday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Thursday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Friday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Saturday</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Sunday</span>
                            </div>
                        </div>
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Cabin- Access, egress seating, seatbelts, loose objects, controls, rops or fops</span>
                                <input type="hidden" name="items[1][description]" value="Cabin- Access, egress seating, seatbelts, loose objects, controls, rops or fops"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>

                        </div>                        

                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Visibility- windscreen, windows, wipes, washers, mirrors</span>
                                <input type="hidden" name="items[2][description]" value="Visibility- windscreen, windows, wipes, washers, mirrors"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Electrical system- lights, amber beacon, horn, rev travel alarm</span>
                                <input type="hidden" name="items[3][description]" value="Electrical system- lights, amber beacon, horn, rev travel alarm"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>

                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Hydraulics- rams, hoses, leaks, wear</span>
                                <input type="hidden" name="items[4][description]" value="Hydraulics- rams, hoses, leaks, wear"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Leaks- engine, transmission, final drives, cooling systems</span>
                                <input type="hidden" name="items[5][description]" value="Leaks- engine, transmission, final drives, cooling systems"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Brakes- emergency and service</span>
                                <input type="hidden" name="items[6][description]" value="Brakes- emergency and service"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Neutral start</span>
                                <input type="hidden" name="items[7][description]" value="Neutral start"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Compulsory signs, reflective tape, reflectors</span>
                                <input type="hidden" name="items[8][description]" value="Compulsory signs, reflective tape, reflectors"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Misc- air con, fire extinguisher</span>
                                <input type="hidden" name="items[9][description]" value="Misc- air con, fire extinguisher"/>

                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Damage to- panels / guards- cracks to chassis/frame/body.</span>
                                <input type="hidden" name="items[10][description]" value="Damage to- panels / guards- cracks to chassis/frame/body."/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Wheels, tyres, tracks- wear/tension/pressure</span>
                                <input type="hidden" name="items[11][description]" value="Wheels, tyres, tracks- wear/tension/pressure"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Hitch (safety pin) - wear</span>
                                <input type="hidden" name="items[12][description]" value="Hitch (safety pin) - wear"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Articulated joint/linkage</span>
                                <input type="hidden" name="items[13][description]" value="Articulated joint/linkage"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Environmental spill kit</span>
                                <input type="hidden" name="items[14][description]" value="Environmental spill kit"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Daily checklist in machine- plant security information list</span>
                                <input type="hidden" name="items[15][description]" value="Daily checklist in machine- plant security information list"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Plant security</span>
                                <input type="hidden" name="items[16][description]" value="Plant security"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="Y">&#xf00c; OK</option>
                                  <option value="N">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <hr/>
                        <h4 class="text-center">Operators</h4>
                        <div class="row text-center font-weight-bold card-header mb-1">                            
                            <div class="col-md-3">                                
                                <span>Operators Name</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Operators Initials</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Drivers Licence Nº</span>
                            </div>
                            <div class="col-md-2">                                
                                <span>Plant operators ticket Nº</span>
                            </div>
                            <div class="col-md-2">                                
                                <span>Induction card Nº</span>
                            </div>
                            <div class="col-md-1">                                
                                <span>Track safety Awar. Cert Nº</span>
                            </div>
                            <div class="col-md-2">                                
                                <span>Supervisors Signature</span>
                            </div>
                        </div>
                    @for ($i = 1; $i <= 4; $i++)                                                                                
                        <div class="form-group row">   
                            <div class="col-md-3 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_name]" value="" placeholder="Operators Name"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_initials]" value="" placeholder="Operators Initials"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_driver_lic]" value="" placeholder="Drivers Licence Nº"/>
                            </div>
                            <div class="col-md-2 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_ticket]" value="" placeholder="Plant Operators Ticket Nº"/>
                            </div>
                            <div class="col-md-2 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_induction_car]" value="" placeholder="Induction Card Nº"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$i}}][op_track_safety]" value="" placeholder="Track safety Awar. Cert. Nº"/>
                            </div>
                            <div class="col-md-2">  
                                <div class="row">
                                    <input type="hidden" name="operators[{{$i}}][signature]" id="img_signature_{{$i}}" value="">                                
                                    <div class="col-md-8">                                
                                        <img class="ml-1" id="preview_signature_{{$i}}" src="" style="width: 100%;" />                                                                
                                    </div>    
                                    <div class="col-md-4">                                
                                        <button id="signature_{{$i}}" type="button" class="btn btn-secondary btn-lg btn-signature">
                                            {{ __('Sign') }}
                                        </button>                                                                                                                    
                                    </div>                                                                
                                </div>                              
                            </div>
                        </div>
                    @endfor   
                        <hr>
                        <h4 class="text-center">
                            <strong>Details of faults or defects and action taken:</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="details" name="details" rows="5" style="resize: none; text-align: left" maxlength="1000"></textarea>
                        </div>
                        
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="reported_to" class="col-form-label text-md-right">{{ __('Fault reported to:') }}</label>
                                <input type="text" class="form-control" name="reported_to" value="" >
                                @if ($errors->has('reported_to'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reported_to') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="reported_position" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="reported_position" type="text" class="form-control" name="reported_position" value="" >
                                @if ($errors->has('reported_position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reported_position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <label for="reported_to_date" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="reported_to_date" value="" >
                                @if ($errors->has('reported_to_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reported_to_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="fault_hazard" class="col-form-label text-md-right">{{ __('Does fault constitute a safety hazard?') }}</label>
                                <select class="form-control" name="fault_hazard">
                                       <option value="">Select Project</option>
                                       <option value="NO">NO</option>
                                       <option value="YES">YES</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fault_repair" class="col-form-label text-md-right">{{ __('Does machine require immediate repair?') }}</label>
                                <select class="form-control" name="fault_repair">
                                       <option value="">Select Project</option>
                                       <option value="NO">NO</option>
                                       <option value="YES">YES</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-9">
                                <a href="{{url()->previous()}}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    @for ($i = 1; $i <= 4; $i++)
    <div class="modal" tabindex="-1" role="dialog" id="modal_signature_{{$i}}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Signature {{$i}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group alert" role="alert">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">                            
                                <div id="div_signature_{{$i}}" class="div-signature"></div>

                                <input type="button" value="Clear" id="div_signature_{{$i}}" class="btn btn-danger btn-clear-sign" >
                                <script>
                                </script>
                            </div>
                        </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_{{$i}}" data-dismiss="modal" >Save & Close</button>
          </div>
        </div>
      </div>
    </div>
    @endfor 


@endsection


