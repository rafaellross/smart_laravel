@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Entry') }}</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('employee_entries.update', $employeeEntry->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control-plaintext" name="employee_name" required value="{{$employeeEntry->employee->name}}" readonly>
                              <input type="hidden" name="employee_id" required value="{{$employeeEntry->employee->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('In / Out') }}</label>
                            <div class="col-md-6">
                              <select class="custom-select" name="in_out">

                                  <option value="1" {{$employeeEntry->in_out == '1' ? 'selected' : ''}}>In</option>

                                  <option value="0" {{$employeeEntry->in_out == '0' ? 'selected' : ''}}>Out</option>

                               </select>
                             </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control form-control-lg" name="notes"/>
                             </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
                              <input type="date" class="form-control form-control-lg" name="entry_dt" value="{{ Carbon::parse($employeeEntry->entry_dt)->format('Y-m-d') }}"/>
                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>
                            <div class="col-md-6">

                              <select class="custom-select" name="entry_time">
                              @for ($i = 0 ; $i <= (24*60)-15; $i += 15)

                                    <option value="{{$i}}" {{$employeeEntry->entry_time == $i ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>

                              @endfor
                            </select>
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
<script src="{{ asset('js/parameters.js') }}"></script>
@endsection
