@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New - Fire Matrix') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('FireMatrixController@update', $fire_matrix->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="reference" class="col-md-4 col-form-label text-md-right">{{ __('Reference') }}</label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" value="{{ $fire_matrix->reference }}" autofocus>

                                @if ($errors->has('reference'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="service_type" class="col-md-4 col-form-label text-md-right">{{ __('Service Type') }}</label>

                            <div class="col-md-6">
                                
                                <textarea class="form-control" id="service_type" name="service_type" rows="4">{{ $fire_matrix->service_type }}</textarea>
                                @if ($errors->has('service_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('service_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wall_type" class="col-md-4 col-form-label text-md-right">{{ __('Wall or Slab Type:') }}</label>
                            <div class="col-md-6">                                
                                <textarea class="form-control" id="wall_type" name="wall_type" rows="4">{{ $fire_matrix->wall_type }}</textarea>
                                @if ($errors->has('wall_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('wall_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wall_type_ref" class="col-md-4 col-form-label text-md-right">{{ __('Wall or Slab Type Refernce:') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="wall_type_ref" name="wall_type_ref" rows="4">{{ $fire_matrix->wall_type_ref }}</textarea>                                
                                @if ($errors->has('wall_type_ref'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('wall_type_ref') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fire_stop_sys" class="col-md-4 col-form-label text-md-right">{{ __('Fire Stopping System:') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="fire_stop_sys" name="fire_stop_sys" rows="4">{{ $fire_matrix->fire_stop_sys }}</textarea>                                                                
                                @if ($errors->has('fire_stop_sys'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fire_stop_sys') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="test_report_ref" class="col-md-4 col-form-label text-md-right">{{ __('Test Report Reference:') }}</label>
                            <div class="col-md-6">                                
                                <input id="test_report_ref" type="text" class="form-control{{ $errors->has('test_report_ref') ? ' is-invalid' : '' }}" name="test_report_ref" value="{{ $fire_matrix->test_report_ref }}">
                                @if ($errors->has('test_report_ref'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('test_report_ref') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="test_specimen" class="col-md-4 col-form-label text-md-right">{{ __('Test Specimen:') }}</label>
                            <div class="col-md-6">
                            <textarea class="form-control" id="test_specimen" name="test_specimen" rows="4">{{ $fire_matrix->test_specimen }}</textarea>                                                                                                
                                @if ($errors->has('test_specimen'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('test_specimen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="frl_achieved" class="col-md-4 col-form-label text-md-right">{{ __('FRL Achieved:') }}</label>
                            <div class="col-md-6">
                                <input id="frl_achieved" type="text" class="form-control{{ $errors->has('frl_achieved') ? ' is-invalid' : '' }}" name="frl_achieved" value="{{ $fire_matrix->frl_achieved }}">
                                @if ($errors->has('frl_achieved'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('frl_achieved') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="test_dt" class="col-md-4 col-form-label text-md-right">{{ __('Dt. Test Report:') }}</label>
                            <div class="col-md-6">
                                <input id="test_dt" type="date" class="form-control{{ $errors->has('test_dt') ? ' is-invalid' : '' }}" name="test_dt" value="{{ Carbon::parse($fire_matrix->test_dt)->format('Y-m-d') }}" required>
                                
                                @if ($errors->has('test_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('test_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments:') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="comments" name="comments" rows="4">{{ $fire_matrix->comments }}</textarea>                                                                                                                                
                                @if ($errors->has('comments'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="approval_status" class="col-md-4 col-form-label text-md-right">{{ __('Approval Status:') }}</label>
                            <div class="col-md-6">                                
                                <input id="approval_status" type="text" class="form-control{{ $errors->has('approval_status') ? ' is-invalid' : '' }}" name="approval_status" value="{{ $fire_matrix->approval_status }}">
                                @if ($errors->has('approval_status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('approval_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <hr/>
                        <h4 style="text-align: center;">Photo</h4>
                        <div class="form-group row" role="alert">                            
                            <div class="alert alert-secondary col-12">                                

                                <div class="input-group col-12 mb-3">
                                    <div class="custom-file" id="medical_certificates_list">
                                        <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[1]" name="medical_certificates[1]" accept="image/*"/>
                                        <label class="custom-file-label" for="medical_certificates[1]">Choose file</label>
                                    </div>
                                </div>
                                <div class="input-group col-12 mb-3">                                    
                                    <img id="medical_certificates[1]_img" src="{{$fire_matrix->picture}}" class="img-fluid" style="">
                                </div>
                                <input id="medical_certificates[1]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                                
                                <input type="hidden" class="custom-file-input" id="medical_certificates[1]_hidden" name="photo_hidden" value="{{ $fire_matrix->picture}}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
