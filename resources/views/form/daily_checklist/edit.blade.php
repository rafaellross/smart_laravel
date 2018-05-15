@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New PRESTART ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_prestart.update', $form_prestart->id) }}">
                        @csrf                        
                        @method('PATCH')
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::parse($form_prestart->dt_form)->format('d/m/Y') }}" required>
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Time:') }}</label>
                                <input type="text" class="form-control" name="time" value="{{$form_prestart->time}}" required>
                                @if ($errors->has('time'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="project" class="col-form-label text-md-right">{{ __('Project:') }}</label>

                                <select class="form-control" name="project">
                                       <option value="">Select Project</option>
                                    <?php $exists = false;?>   
                                    @foreach(App\Job::orderBy('code', 'asc')->get() as $job)
                                        @if(!in_array($job->code, ['rdo', 'pld', 'tafe', 'sick', 'anl', 'holiday']))
                                        <?php                                             
                                            if ($job->description == $form_prestart->project) {
                                                $exists = true;
                                            }
                                        ?>   
                                        <option value="{{$job->description}}" {{$job->description == $form_prestart->project ? 'selected' : ''}}>{{$job->description}}</option>
                                        @endif
                                        @if(!$exists)
                                            <option value="{{$form_prestart->project}}" selected>{{$form_prestart->project}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="foreman" class="col-form-label text-md-right">{{ __('Foreman:') }}</label>
                                <select class="form-control" name="foreman">
                                       <option value="">Select Foreman</option>
                                    @foreach(App\Employee::where('foreman', 1)->get() as $employee)
                                        <option value="{{$employee->id}}" {{$employee->id == $form_prestart->foreman ? 'selected' : ''}}>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <h4 class="text-center">
                            <strong>Details of Discussion</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="details" name="details" rows="12" style="resize: none; text-align: left" maxlength="2750">{{trim(stripslashes(htmlentities($form_prestart->details)))}}</textarea>
                        </div>

                        <hr/>                                                
                        <h4 class="text-left">
                            <strong>All persons in attendance must sign below.</strong>
                        </h4>                        

                        <div class="form-group row col-md-12 mx-auto" style="width: 90%;">  
                            @foreach($form_prestart->persons as $person)                                                      
                                <div class="col-md-3">
                                    <label for="persons[{{$person->number}}][name]" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                    <input id="persons[{{$person->number}}][name]" type="text" class="form-control form-control-lg" name="persons[{{$person->number}}][name]" value="{{$person->name}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="signature_{{$person->number}}" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                    <br>                                
                                    <button id="signature_{{$person->number}}" type="button" class="btn btn-secondary btn-lg btn-signature">
                                        {{ __('Sign') }}
                                    </button>                                                                                
                                    <input type="hidden" name="persons[{{$person->number}}][signature]" id="img_signature_{{$person->number}}" value="{{$person->signature}}">
                                    <img class="ml-1" id="preview_signature_{{$person->number}}" src="{{$person->signature}}" style="width: 45%;" />
                                </div>                                                                                                                                
                            @endforeach                            
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
    @foreach($form_prestart->persons as $person) 
    <div class="modal" tabindex="-1" role="dialog" id="modal_signature_{{$person->number}}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Signature {{$person->number}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group alert" role="alert">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">                            
                                <div id="div_signature_{{$person->number}}" class="div-signature"></div>

                                <input type="button" value="Clear" id="div_signature_{{$person->number}}" class="btn btn-danger btn-clear-sign" >
                                <script>
                                </script>
                            </div>
                        </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_{{$person->number}}" data-dismiss="modal" >Save & Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
@endsection


