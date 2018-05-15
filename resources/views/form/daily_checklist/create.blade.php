@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Daily Plant Inspection Checklist') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_checklist.store') }}">
                        @csrf                        
                        <div class="form-group row">                            
                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::now('Australia/Sydney')->format('d/m/Y') }}" >
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="working_for" class="col-form-label text-md-right">{{ __('Working For:') }}</label>
                                <input type="text" class="form-control" name="working_for" value="" >
                                @if ($errors->has('working_for'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('working_for') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="plant_description" class="col-form-label text-md-right">{{ __('Plant Description:') }}</label>
                                <input id="dt_form" type="text" class="form-control" name="plant_description" value="" >
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
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
                                <input type="text" class="form-control" name="make_model" value="">
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
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[1][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
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
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[2][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
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
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[3][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
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
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[4][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
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
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[5][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Brakes- emergency and service</span>
                                <input type="hidden" name="items[5][description]" value="Leaks- engine, transmission, final drives, cooling systems"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[6][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Neutral start</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[7][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Compulsory signs, reflective tape, reflectors</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[8][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Misc- air con, fire extinguisher</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[9][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Damage to- panels / guards- cracks to chassis/frame/body.</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[10][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Wheels, tyres, tracks- wear/tension/pressure</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[11][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Hitch (safety pin) - wear</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[12][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Articulated joint/linkage</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[13][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Environmental spill kit</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[14][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Daily checklist in machine- plant security information list</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[15][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                        </div>                        
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>Plant security</span>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[16][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="">-</option>
                                  <option value="OK">&#xf00c; OK</option>
                                  <option value="Fault">&#xf00d; Fault</option>
                                  <option value="N/A">&#32; N/A</option>
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
@endsection


