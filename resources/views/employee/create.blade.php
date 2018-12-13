@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('D.O.B') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }} date-picker" name="dob" value="{{ old('dob') }}" autocomplete="Off">
                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bonus" class="col-md-4 col-form-label text-md-right">{{ __('Bonus') }}</label>
                            <div class="col-md-6">
                                <input id="bonus" type="number" step="any" class="form-control{{ $errors->has('bonus') ? ' is-invalid' : '' }}" name="bonus" value="0.00" required>
                                @if ($errors->has('bonus'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bonus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bonus_type" class="col-md-4 col-form-label text-md-right">{{ __('Bonus Type') }}</label>
                            <div class="col-md-6">
                                <select name="location" class="form-control">
                                  <option value="" selected>None</option>
                                  <option value="F">Foreman</option>
                                  <option value="L">Leading Hand</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rdo_bal" class="col-md-4 col-form-label text-md-right">{{ __('RDO Balance') }}</label>
                            <div class="col-md-6">
                                <input id="rdo_bal" type="number" step="any" class="form-control{{ $errors->has('rdo_bal') ? ' is-invalid' : '' }}" name="rdo_bal" value="0.00" required>
                                @if ($errors->has('rdo_bal'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rdo_bal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pld" class="col-md-4 col-form-label text-md-right">{{ __('PLD Balance') }}</label>
                            <div class="col-md-6">
                                <input id="pld" type="number" step="any" class="form-control{{ $errors->has('pld') ? ' is-invalid' : '' }}" name="pld" value="0.00" required>
                                @if ($errors->has('pld'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('pld') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anl" class="col-md-4 col-form-label text-md-right">{{ __('Annual Leave Balance') }}</label>
                            <div class="col-md-6">
                                <input id="anl" type="number" step="any" class="form-control{{ $errors->has('anl') ? ' is-invalid' : '' }}" name="anl" value="0.00" required>
                                @if ($errors->has('anl'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('anl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bonus" class="col-md-4 col-form-label text-md-right">{{ __('Entitlements') }}</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="rdo" name="entitlements[]" value="rdo" checked/>
                                  <label class="form-check-label" for="rdo">RDO</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="travel" name="entitlements[]" value="travel" checked/>
                                  <label class="form-check-label" for="travel">Travel Day</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="site_allow" name="entitlements[]" value="site_allow" checked/>
                                  <label class="form-check-label" for="site_allow">Site Allowance</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Apprentice Anniversary Date') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control{{ $errors->has('anniversary_dt') ? ' is-invalid' : '' }} date-picker" name="anniversary_dt" value="{{ old('anniversary_dt') }}" autocomplete="Off">
                                @if ($errors->has('anniversary_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('anniversary_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apprentice_year" class="col-md-4 col-form-label text-md-right">{{ __('Apprentice Year') }}</label>
                            <div class="col-md-6">
                              <select name="apprentice_year" class="form-control">
                                <option value="" selected>-</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select name="location" class="form-control">
                                  <option value="P">Plumber</option>
                                  <option value="A">Apprentice</option>
                                  <option value="O">Office</option>
                                  <option value="L">Labourer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>
                            <div class="col-md-6">
                                <select name="company" class="form-control">
                                  <option value="C">Construction</option>
                                  <option value="M">Maintenance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Inactive ?') }}</label>
                            <div class="col-md-6">
                                <select name="inactive" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>
                        </div>


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
@endsection
