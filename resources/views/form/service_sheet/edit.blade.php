@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Daily Plant Inspection Checklist') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_checklist.update', $form_daily_checklist->id) }}">
                        @csrf   
                        @method('PATCH')                     
                        <div class="form-group row">                            
                            <div class="col-md-12">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::parse($form_daily_checklist->dt_form)->format('d/m/Y') }}" >
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
                                <input type="text" class="form-control" name="working_for" value="{{$form_daily_checklist->working_for}}" >
                                @if ($errors->has('working_for'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('working_for') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="plant_description" class="col-form-label text-md-right">{{ __('Plant Description:') }}</label>
                                <input id="dt_form" type="text" class="form-control" name="plant_description" value="{{$form_daily_checklist->plant_description}}" >
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
                                <input type="text" class="form-control" name="make_model" value="{{$form_daily_checklist->make_model}}" >
                                @if ($errors->has('make_model'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('make_model') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="make_model" class="col-form-label text-md-right">{{ __('Serial Nº:') }}</label>
                                <input type="text" class="form-control" name="serial_no" value="{{$form_daily_checklist->serial_no}}">
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
                                   <?php $exists = false;?>   
                                    @foreach(App\Job::all() as $job)
                                        @if(!in_array($job->code, ['rdo', 'pld', 'tafe', 'sick', 'anl', 'holiday']))
                                        <?php                                             
                                            if ($job->description == $form_daily_checklist->job_site) {
                                                $exists = true;
                                            }
                                        ?>                                           
                                        <option value="{{$job->description}}" {{$form_daily_checklist->job_site == $job->description ? 'selected' : ''}}>{{$job->description}}</option>
                                        @endif
                                    @endforeach
                                        @if(!$exists)
                                            <option value="{{$form_daily_checklist->job_site}}" selected>{{$form_daily_checklist->job_site}}</option>
                                        @endif                                    
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="reg_permit" class="col-form-label text-md-right">{{ __('Registration or Permit Nº:') }}</label>
                                <input type="text" class="form-control" name="reg_permit" value="{{$form_daily_checklist->reg_permit}}">
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
                                <input id="expire_dt" type="text" class="form-control date-picker" name="expire_dt" value="{{ is_null($form_daily_checklist->expire_dt) ? null : Carbon::parse($form_daily_checklist->expire_dt)->format('d/m/Y') }}">
                                @if ($errors->has('expire_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('expire_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="km_reading" class="col-form-label text-md-right">{{ __('Hour Metre / KM Reading:') }}</label>
                                <input type="text" class="form-control" name="km_reading" value="{{$form_daily_checklist->km_reading}}" >
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
                        @foreach($form_daily_checklist->items as $item)
                        <div class="form-group row">   
                            <div class="col-md-5">                                
                                <span>{{ $item->description }}</span>
                                <input type="hidden" name="items[{{$item->number}}][description]" value="{{ $item->description }}"/>
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][monday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->monday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->monday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->monday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->monday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][tuesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->tuesday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->tuesday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->tuesday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->tuesday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][wednesday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->wednesday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->wednesday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->wednesday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->wednesday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][thursday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->thursday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->thursday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->thursday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->thursday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][friday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->friday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->friday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->friday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->friday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][saturday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->saturday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->saturday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->saturday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->saturday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>
                            <div class="col-md-1 text-center">                                
                                <select class="form-control" name="items[{{$item->number}}][sunday]" style="font-family: FontAwesome, Arial;">
                                  <option value="" {{ $item->sunday == '' ? 'selected' : ''}}>-</option>
                                  <option value="Y" {{ $item->sunday == 'Y' ? 'selected' : ''}}>&#xf00c; OK</option>
                                  <option value="N" {{ $item->sunday == 'N' ? 'selected' : ''}}>&#xf00d; Fault</option>
                                  <option value="N/A" {{ $item->sunday == 'N/A' ? 'selected' : ''}}>&#32; N/A</option>
                                </select>                                
                            </div>

                        </div>                        
                        @endforeach                      
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
                    @foreach($form_daily_checklist->operators as $operator)
                        <div class="form-group row">   
                            <div class="col-md-3 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_name]" value="{{$operator->op_name}}" placeholder="Operators Name"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_initials]" value="{{$operator->op_initials}}" placeholder="Operators Initials"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_driver_lic]" value="{{$operator->op_driver_lic}}" placeholder="Drivers Licence Nº"/>
                            </div>
                            <div class="col-md-2 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_ticket]" value="{{$operator->op_ticket}}" placeholder="Plant Operators Ticket Nº"/>
                            </div>
                            <div class="col-md-2 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_induction_car]" value="{{$operator->op_induction_car}}" placeholder="Induction Card Nº"/>
                            </div>
                            <div class="col-md-1 px-1">                                
                                <input type="text" class="form-control" name="operators[{{$operator->number}}][op_track_safety]" value="{{$operator->op_track_safety}}" placeholder="Track safety Awar. Cert. Nº"/>
                            </div>
                            <div class="col-md-2">  
                                <div class="row">
                                    <input type="hidden" name="operators[{{$operator->number}}][signature]" id="img_signature_{{$operator->number}}" value="{{$operator->signature}}">                                
                                    <div class="col-md-8">                                
                                        <img class="ml-1" id="preview_signature_{{$operator->number}}" src="{{$operator->signature}}" style="width: 100%;" />                                                                
                                    </div>    
                                    <div class="col-md-4">                                
                                        <button id="signature_{{$operator->number}}" type="button" class="btn btn-secondary btn-lg btn-signature">
                                            {{ __('Sign') }}
                                        </button>                                                                                                                    
                                    </div>                                                                
                                </div>                              
                            </div>
                        </div>
                    @endforeach
                        <hr>
                        <h4 class="text-center">
                            <strong>Details of faults or defects and action taken:</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="details" name="details" rows="5" style="resize: none; text-align: left" maxlength="1000">{{$form_daily_checklist->details}}</textarea>
                        </div>
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="reported_to" class="col-form-label text-md-right">{{ __('Fault reported to:') }}</label>
                                <input type="text" class="form-control" name="reported_to" value="{{$form_daily_checklist->reported_to}}" >
                                @if ($errors->has('reported_to'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reported_to') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="reported_position" class="col-form-label text-md-right">{{ __('Position:') }}</label>
                                <input id="reported_position" type="text" class="form-control" name="reported_position" value="{{$form_daily_checklist->reported_position}}" >
                                @if ($errors->has('reported_position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reported_position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <label for="reported_to_date" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="reported_to_date" value="{{Carbon::parse($form_daily_checklist->reported_to_date)->format('d/m/Y')}}" >
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
                                       <option value="" {{$form_daily_checklist->fault_hazard == '' ? 'selected' : ''}}>Select Project</option>
                                       <option value="NO" {{$form_daily_checklist->fault_hazard == 'NO' ? 'selected' : ''}}>NO</option>
                                       <option value="YES" {{$form_daily_checklist->fault_hazard == 'YES' ? 'selected' : ''}}>YES</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fault_repair" class="col-form-label text-md-right">{{ __('Does machine require immediate repair?') }}</label>
                                <select class="form-control" name="fault_repair">
                                       <option value="" {{$form_daily_checklist->fault_repair == '' ? 'selected' : ''}}>Select Project</option>
                                       <option value="NO" {{$form_daily_checklist->fault_repair == 'NO' ? 'selected' : ''}}>NO</option>
                                       <option value="YES" {{$form_daily_checklist->fault_repair == 'YES' ? 'selected' : ''}}>YES</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-9">
                                <a href="{{url()->previous()}}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    @foreach($form_daily_checklist->operators as $operator)
    <div class="modal" tabindex="-1" role="dialog" id="modal_signature_{{$operator->number}}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Signature {{$operator->number}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group alert" role="alert">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">                            
                                <div id="div_signature_{{$operator->number}}" class="div-signature"></div>

                                <input type="button" value="Clear" id="div_signature_{{$operator->number}}" class="btn btn-danger btn-clear-sign" >
                                <script>
                                </script>
                            </div>
                        </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_{{$operator->number}}" data-dismiss="modal" >Save & Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
@endsection