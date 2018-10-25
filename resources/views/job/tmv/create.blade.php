@extends('layouts.app')

@section('content')
<script src="{{ asset('js/tmv.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create New - TMV') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('TmvController@store', $job)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="room_number" class="col-md-4 col-form-label text-md-right">{{ __('Name of Establishment:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="name_establishment" value="{{ old('name_establishment') }}" maxlength="96">
                                @if ($errors->has('name_establishment'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name_establishment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_number" class="col-md-4 col-form-label text-md-right">{{ __('Room Number:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="room_number" value="{{ old('room_number') }}">
                                @if ($errors->has('room_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('room_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location_number" class="col-md-4 col-form-label text-md-right">{{ __('Location Number:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="location_number" value="{{ old('location_number') }}">
                                @if ($errors->has('location_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('location_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="location" value="{{ old('location') }}">
                                @if ($errors->has('location'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type_valve" class="col-md-4 col-form-label text-md-right">{{ __('Type Valve:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="type_valve" value="{{ old('type_valve') }}">
                                @if ($errors->has('type_valve'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('type_valve') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Size:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="size" value="{{ old('size') }}">
                                @if ($errors->has('size'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serial_number" class="col-md-4 col-form-label text-md-right">{{ __('Serial Number:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="serial_number" value="{{ old('serial_number') }}">
                                @if ($errors->has('serial_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serial_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="temp_range" class="col-md-4 col-form-label text-md-right">{{ __('Temperature Range:') }}</label>
                            <div class="col-md-6">
                              <select class="form-control form-control-lg custom-select" name="temp_range">
                                  <option value="">Select Range</option>
                                  <option value="C">Children 38 - 40.5 deg C</option>
                                  <option value="A">Adults 40.5 - 43.5 deg C</option>
                              </select>
                            </div>
                        </div>

                        <hr/>



                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <a href="{{ URL::to('/home') }}" class="btn btn-danger  btn-lg btn-block">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
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
