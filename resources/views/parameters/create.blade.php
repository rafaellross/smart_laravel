@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Business') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('parameters.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Business Name') }}</label>

                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control{{ $errors->has('business_name') ? ' is-invalid' : '' }}" name="business_name" value="{{ old('business_name') }}" maxlength="57" required autofocus>

                                @if ($errors->has('business_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="abn" class="col-md-4 col-form-label text-md-right">{{ __('ABN') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('abn') ? ' is-invalid' : '' }}" name="abn" value="{{ old('abn') }}" maxlength="11" required>
                                @if ($errors->has('abn'))
                                <strong>{{ $errors->first('abn') }}</strong>
                                    <span class="invalid-feedback">
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="business_address" type="text" class="form-control{{ $errors->has('business_address') ? ' is-invalid' : '' }}" maxlength="38" name="business_address" value="{{ old('business_address') }}">
                                @if ($errors->has('business_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_suburb" class="col-md-4 col-form-label text-md-right">{{ __('Suburb') }}</label>
                            <div class="col-md-6">
                                <input id="business_suburb" type="text" class="form-control{{ $errors->has('business_suburb') ? ' is-invalid' : '' }}" name="business_suburb" maxlength="19" value="{{ old('business_suburb') }}">
                                @if ($errors->has('business_suburb'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_suburb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="business_state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                              <select class="form-control form-control-lg custom-select" name="business_state" required>
                                  <option value="">Select State</option>
                                  @foreach (App\States::all() as $state)
                                      <option value="{{$state->code}}">{{$state->description}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_post_code" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>
                            <div class="col-md-6">
                                <input id="business_suburb" type="text" class="form-control{{ $errors->has('business_post_code') ? ' is-invalid' : '' }}" name="business_post_code" maxlength="4" value="{{ old('business_post_code') }}">
                                @if ($errors->has('business_post_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_post_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                            <div class="col-md-6">
                                <input id="business_email" type="email" class="form-control{{ $errors->has('business_email') ? ' is-invalid' : '' }}" name="business_email" maxlength="38" value="{{ old('business_email') }}">
                                @if ($errors->has('business_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business_contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Person') }}</label>
                            <div class="col-md-6">
                                <input id="business_contact" type="text" class="form-control{{ $errors->has('business_contact') ? ' is-invalid' : '' }}" name="business_contact" maxlength="19" value="{{ old('business_contact') }}">
                                @if ($errors->has('business_contact'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="business_phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="business_phone" type="text" class="form-control{{ $errors->has('business_phone') ? ' is-invalid' : '' }}" name="business_phone" maxlength="10" value="{{ old('business_phone') }}">
                                @if ($errors->has('business_phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('business_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="business_no_abn" class="col-md-4 col-form-label text-md-right">{{ __("If you don't have an ABN or withholding payer number, have you applied for one?") }}</label>
                            <div class="col-md-6">
                              <select class="form-control form-control-lg custom-select" name="business_no_abn">
                                  <option value="">Select </option>
                                      <option value="1">Yes</option>
                                      <option value="0">No</option>
                              </select>
                            </div>
                        </div>
                        <br>
                        <!-- Signature-->
                        <div class="card" id="business_signature">

                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-11">
                                    <div class="form-row">
                                        <div class="col-md-9 offset-md-2">
                                            <div class="col-md-12 mb-3">
                                                <input type="hidden" name="business_signature_hidden" value="">
                                                <div id="div_signature_business" class="div-signature"></div>

                                            </div>
                                            <div class="col-md-12 mb-3">
                                              <input type="button" value="Clear" id="clear_signature_business" class="btn btn-danger btn-clear-sign" >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
<script src="{{ asset('js/parameters.js') }}"></script>
@endsection
