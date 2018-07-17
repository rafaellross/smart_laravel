@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New - SERVICES PENETRATION FIRE SEAL') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('FireIdentificationController@store', $job)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Fire Seal Reference') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control{{ $errors->has('fire_seal_ref') ? ' is-invalid' : '' }}" name="fire_seal_ref" value="{{ old('fire_seal_ref') }}" required autofocus>

                                @if ($errors->has('fire_seal_ref'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fire_seal_ref') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="drawing" class="col-md-4 col-form-label text-md-right">{{ __('Drawing') }}</label>

                            <div class="col-md-6">
                                <input id="drawing" type="text" class="form-control{{ $errors->has('drawing') ? ' is-invalid' : '' }}" name="drawing" value="{{ $fire_seal->drawing }}" required>

                                @if ($errors->has('drawing'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('drawing') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fire_resist_level" class="col-md-4 col-form-label text-md-right">{{ __('Fire Resistance Level (FRL):') }}</label>
                            <div class="col-md-6">
                                <input id="fire_resist_level" type="text" class="form-control{{ $errors->has('fire_resist_level') ? ' is-invalid' : '' }}" name="fire_resist_level" value="{{ old('fire_resist_level') }}" required>
                                @if ($errors->has('fire_resist_level'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fire_resist_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="install_dt" class="col-md-4 col-form-label text-md-right">{{ __('Installed Date:') }}</label>
                            <div class="col-md-6">
                                <input id="install_dt" type="text" class="form-control{{ $errors->has('install_dt') ? ' is-invalid' : '' }} date-picker" name="install_dt" value="{{ old('install_dt') }}">
                                @if ($errors->has('install_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('install_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="install_by" class="col-md-4 col-form-label text-md-right">{{ __('Installed By:') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('install_by') ? ' is-invalid' : '' }}" name="install_by" value="{{ old('install_by') }}">
                                @if ($errors->has('install_by'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('install_by') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manufacturer" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer of Fire Stopping System:') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('manufacturer') ? ' is-invalid' : '' }}" name="manufacturer" value="{{ old('manufacturer') }}">
                                @if ($errors->has('manufacturer'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('manufacturer') }}</strong>
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
                                    <img id="medical_certificates[1]_img" class="img-fluid" style="" src="">
                                </div>
                                <input id="medical_certificates[1]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                                <input type="hidden" class="custom-file-input" id="medical_certificates[1]_hidden" name="photo_hidden" value="">
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
