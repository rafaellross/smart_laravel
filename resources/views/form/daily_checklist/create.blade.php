@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New PRESTART ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_prestart.store') }}">
                        @csrf                        
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::now('Australia/Sydney')->format('d/m/Y') }}" required>
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Time:') }}</label>
                                <input type="text" class="form-control" name="time" value="" required>
                                @if ($errors->has('revision'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('revision') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <label for="project" class="col-form-label text-md-right">{{ __('Project:') }}</label>

                                <select class="form-control" name="project">
                                       <option value="">Select Project</option>
                                    @foreach(App\Job::all() as $job)
                                        @if(!in_array($job->code, ['rdo', 'pld', 'tafe', 'sick', 'anl', 'holiday']))
                                        <option value="{{$job->description}}" selected>{{$job->description}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="foreman" class="col-form-label text-md-right">{{ __('Foreman:') }}</label>
                                <select class="form-control" name="foreman">
                                       <option value="">Select Foreman</option>
                                    @foreach(App\Employee::where('foreman', 1)->get() as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr/>


                        <h4 class="text-center">
                            <strong>Details of Discussion</strong>
                        </h4>                        
                        <div class="form-group">                            
                            <textarea class="form-control" id="details" name="details" rows="12" style="resize: none; text-align: left" maxlength="2750"></textarea>
                        </div>

                        <hr/>                                                
                        <h4 class="text-left">
                            <strong>All persons in attendance must sign below.</strong>
                        </h4>                        

                        <div class="form-group row col-md-12 mx-auto" style="width: 90%;">  
                            @for ($i = 1; $i <= 20; $i++)                                                        
                                <div class="col-md-3">
                                    <label for="persons[{{$i}}][name]" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                    <input id="persons[{{$i}}][name]" type="text" class="form-control form-control-lg" name="persons[{{$i}}][name]" value="">
                                </div>
                                <div class="col-md-3">
                                    <label for="signature_{{$i}}" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                    <br>                                
                                    <button id="signature_{{$i}}" type="button" class="btn btn-secondary btn-lg btn-signature">
                                        {{ __('Sign') }}
                                    </button>                                                                                
                                    <input type="hidden" name="persons[{{$i}}][signature]" id="img_signature_{{$i}}" value="">
                                    <img class="ml-1" id="preview_signature_{{$i}}" src="" style="width: 45%;" />
                                </div>                                                                                                                                
                            @endfor                            
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
    @for ($i = 1; $i <= 20; $i++)
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


