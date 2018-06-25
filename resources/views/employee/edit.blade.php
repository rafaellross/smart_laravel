@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{action('EmployeeController@update', $id)}}">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $employee->name }}" required autofocus>

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
                                <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }} date-picker" name="dob" value="{{Carbon::parse($employee->dob)->format('d/m/Y')}}" autocomplete="Off">
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
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $employee->phone }}">
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
                                <input id="bonus" type="number" step="any" class="form-control{{ $errors->has('bonus') ? ' is-invalid' : '' }}" name="bonus" value="{{  number_format((float)$employee->bonus, 2, '.', '') }}" required>
                                @if ($errors->has('bonus'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('bonus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rdo_bal" class="col-md-4 col-form-label text-md-right">{{ __('RDO Balance') }}</label>
                            <div class="col-md-6">
                                <input id="rdo_bal" type="number" step="any" class="form-control{{ $errors->has('rdo_bal') ? ' is-invalid' : '' }}" name="rdo_bal" value="{{ number_format((float)$employee->rdo_bal, 2, '.', '') }}" required>
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
                                <input id="pld" type="number" step="any" class="form-control{{ $errors->has('pld') ? ' is-invalid' : '' }}" name="pld" value="{{  number_format((float)$employee->pld, 2, '.', '') }}" required>
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
                                <input id="anl" type="number" step="any" class="form-control{{ $errors->has('anl') ? ' is-invalid' : '' }}" name="anl" value="{{ number_format((float)$employee->anl, 2, '.', '') }}" required>
                                @if ($errors->has('anl'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('anl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Entitlements') }}</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="rdo" name="entitlements[]" value="rdo" {{$employee->rdo ? 'checked' : ''}}/>
                                  <label class="form-check-label" for="rdo">RDO</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="travel" name="entitlements[]" value="travel" {{$employee->travel ? 'checked' : ''}}/>
                                  <label class="form-check-label" for="travel">Travel Day</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="site_allow" name="entitlements[]" value="site_allow" {{$employee->site_allow ? 'checked' : ''}}/>
                                  <label class="form-check-label" for="site_allow">Site Allowance</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Apprentice Anniversary Date') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control{{ $errors->has('anniversary_dt') ? ' is-invalid' : '' }} date-picker" name="anniversary_dt" value="{{ $employee->anniversary_dt }}" autocomplete="Off">
                                @if ($errors->has('anniversary_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('anniversary_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Apprentice Year') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control{{ $errors->has('apprentice_year') ? ' is-invalid' : '' }} " name="apprentice_year" value="{{ $employee->apprentice_year }}" autocomplete="Off">
                                @if ($errors->has('apprentice_year'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apprentice_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                            <div class="col-md-6">
                                <select name="location" class="form-control">
                                    <option value="C" {{ $employee->apprentice_year == 'C' ? 'selected' : '' }}>Construction</option>
                                    <option value="O" {{ $employee->apprentice_year == 'O' ? 'selected' : '' }}>Office</option>
                                    <option value="M" {{ $employee->apprentice_year == 'M' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="L" {{ $employee->apprentice_year == 'L' ? 'selected' : '' }}>Labourer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Inactive ?') }}</label>
                            <div class="col-md-6">
                                <select name="inactive" class="form-control">
                                    <option value="1" {{ $employee->inactive == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $employee->inactive == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
@endsection
