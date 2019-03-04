@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{action('EmployeeController@update', $employee->id)}}">
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
                            <label for="bonus_type" class="col-md-4 col-form-label text-md-right">{{ __('Bonus Type') }}</label>
                            <div class="col-md-6">
                                <select name="bonus_type" class="form-control">
                                  <option value="" {{ $employee->bonus_type == '' ? 'selected' : '' }}>None</option>
                                  <option value="F" {{ $employee->bonus_type == 'F' ? 'selected' : '' }}>Foreman</option>
                                  <option value="L" {{ $employee->bonus_type == 'L' ? 'selected' : '' }}>Leading Hand</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="car_allowance" class="col-md-4 col-form-label text-md-right">{{ __('Car Allowance') }}</label>
                            <div class="col-md-6">
                                <input id="car_allowance" type="number" step="any" class="form-control{{ $errors->has('car_allowance') ? ' is-invalid' : '' }}" name="car_allowance" value="{{  number_format((float)$employee->car_allowance, 2, '.', '') }}" required>
                                @if ($errors->has('car_allowance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('car_allowance') }}</strong>
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
                                <input id="dob" type="text" class="form-control{{ $errors->has('anniversary_dt') ? ' is-invalid' : '' }} date-picker" name="anniversary_dt" value="{{ is_null($employee->anniversary_dt) ? '' : Carbon::parse($employee->anniversary_dt)->format('d/m/Y') }}" autocomplete="Off">
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
                                <select name="apprentice_year" class="form-control">
                                  <option value="" {{ $employee->apprentice_year == '' || $employee->apprentice_year == '0' ? 'selected' : '' }}>-</option>
                                  <option value="1" {{ $employee->apprentice_year == '1' ? 'selected' : '' }}>1st</option>
                                  <option value="2" {{ $employee->apprentice_year == '2' ? 'selected' : '' }}>2nd</option>
                                  <option value="3" {{ $employee->apprentice_year == '3' ? 'selected' : '' }}>3rd</option>
                                  <option value="4" {{ $employee->apprentice_year == '4' ? 'selected' : '' }}>4th</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                  <select name="location" class="form-control">
                                    <option value="P" {{ $employee->location == 'P' ? 'selected' : '' }}>Plumber</option>
                                    <option value="A" {{ $employee->location == 'A' ? 'selected' : '' }}>Apprentice</option>
                                    <option value="O" {{ $employee->location == 'O' ? 'selected' : '' }}>Office</option>
                                    <option value="L" {{ $employee->location == 'L' ? 'selected' : '' }}>Labourer</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>
                            <div class="col-md-6">
                                  <select name="company" class="form-control">
                                    <option value="C" {{ $employee->company == 'C' ? 'selected' : '' }}>Construction</option>
                                    <option value="M" {{ $employee->company == 'M' ? 'selected' : '' }}>Maintenance</option>
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
        <div class="timesheets card mt-5 pt-5">
          <h4 class="text-center">Time Sheets</h4>
          <table class="table table-hover table-responsive-sm table-striped">
              <thead>
                  <tr>
                      <th scope="col" class="mobile"><input type="checkbox" id="chkRow"></th>
                      <th scope="col" class="mobile">#</th>
                      <th scope="col">User</th>
                      <th scope="col" class="mobile">Date</th>

                      <th scope="col">Total Hours</th>
                      <th scope="col">Hours 1.5</th>
                      <th scope="col">Hours 2.0</th>
                      <th scope="col">Week End</th>

                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($timesheets as $timesheet)
                  <tr>
                  </tr><tr class="P"><th class="mobile"><input type="checkbox" id="chkRow-{{$timesheet->id}}"></th><th class="mobile" scope="row">{{$timesheet->id}}</th>
                      <td>{{$timesheet->user->username}}</td>
                      <td class="mobile">{{ Carbon::parse($timesheet->created_at)->format('d/m/Y') }}</td>

                      <td>{{$timesheet->total}}</td>
                      <td>{{$timesheet->total_15}}</td>
                      <td>{{$timesheet->total_20}}</td>
                      <td>{{Carbon::parse($timesheet->week_end)->format('d/m/Y')}}</td>

                      <td>{{$timesheet->status}}</td><td style="text-align: center;">
                          <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{ route('action_timesheet', ['id' => $timesheet->id, 'action' => 'print']) }}" target="_blank">View</a>
                                  <a class="dropdown-item" href="{{ action('TimeSheetController@edit', ['id' => $timesheet->id])}}">Edit</a>
                                  @if(Auth::user()->administrator || $timesheet->status == 'P')
                                      <a class="dropdown-item delete" id="{{$timesheet->id}}" href="#">Delete</a>
                                  @endif
                              </div>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
    </div>
</div>
@endsection
