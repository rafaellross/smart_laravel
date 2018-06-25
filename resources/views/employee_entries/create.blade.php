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
                              @if(is_null($employee))
                              <select class="custom-select" name="employee_id">
                                  @foreach (App\Employee::all() as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                  @endforeach

                               </select>
                              @else
                              <input type="text" class="form-control-plaintext" name="employee_name" required value="{{$employee->name}}" readonly>
                              <input type="hidden" name="employee_id" required value="{{$employee->id}}">

                              @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('In / Out') }}</label>
                            <div class="col-md-6">
                              <select class="custom-select" name="in_out">
                                @if((isset($last_entry->in_out) && $last_entry->in_out))
                                  <option value="0">Out</option>
                                @else
                                 <option value="1">In</option>
                                @endif
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
                              <input type="date" class="form-control form-control-lg" name="entry_dt" value="{{ Carbon::now('Australia/Sydney')->format('Y-m-d') }}"/>
                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>
                            <div class="col-md-6">

                              <select class="custom-select" name="entry_time">
                              @for ($i = (isset($last_entry->entry_time) ? $last_entry->entry_time : 0 ); $i <= (24*60)-15; $i += 15)
                                  @if (($i - $now) < 15 && ($i - $now) >= 0)
                                    <option value="{{$i}}" selected>{{ date('i:s', $i)}}</option>
                                  @elseif(Auth::user()->administrator == 1)
                                    <option value="{{$i}}" >{{ date('i:s', $i)}}</option>
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
