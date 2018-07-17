@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Entry') }}</div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('employee_entries.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label>
                            <div class="col-md-6">

                              @foreach($employees as $employee)
                                  <input readonly="" type="text" class="form-control form-control-lg" id="empname" placeholder="Type employee name" value="{{ $employee->name}}">
                                  <input type="hidden" name="employees[{{$employee->id}}][id]" value="{{$employee->id}}">

                              @endforeach

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
                              <input type="date" class="form-control form-control-lg" name="entry_dt" value="{{ Carbon::now('Australia/Sydney')->format('Y-m-d') }}"/>
                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>
                            <div class="col-md-6">

                              <select class="custom-select" name="entry_time">

                              @for ($i = (isset($last_entry->entry_time) && Auth::user()->administrator == 0 ? $last_entry->entry_time : 0 ); $i <= (24*60)-1; $i+=15)

                                  @if (Auth::user()->administrator == 0 && $i == $now)

                                    <option value="{{$i}}" selected>{{ date('i:s', $i)}}</option>

                                  @elseif(Auth::user()->administrator == 1)

                                    <option value="{{$i}}" {{$i == $now ? 'selected' : ''}}>{{ date('i:s', $i)}}</option>

                                  @endif

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
