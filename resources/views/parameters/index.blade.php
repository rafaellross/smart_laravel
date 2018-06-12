@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Parameters') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('parameters.update', $parameter->id) }}">
                        @csrf
                        @method('patch')

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Week End for Time Sheet') }}</label>

                            <div class="col-md-6">
                              <input type="text" class="form-control form-control-lg date-picker" name="week_end_timesheet" data-date-days-of-week-disabled="1,2,3,4,5,6" id="week_end_timesheet" required="" value="{{Carbon::parse($parameter->week_end_timesheet)->format('d/m/Y')}}" autocomplete="off">
                              @if ($errors->has('week_end_timesheet'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('week_end_timesheet') }}</strong>
                                  </span>
                              @endif
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
<script src="{{ asset('js/parameters.js') }}"></script>
@endsection
