@extends('layouts.app')

@section('content')
<script src="{{ asset('js/forms.js') }}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Service Sheet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('form_service_sheet.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="description" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input id="dt_form" type="text" class="form-control date-picker" name="dt_form" value="{{ Carbon::now('Australia/Sydney')->format('d/m/Y') }}" >
                                @if ($errors->has('dt_form'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dt_form') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="job_no" class="col-form-label text-md-right">{{ __('Job Nº:') }}</label>
                                <input type="text" class="form-control" name="working_for" value="" >
                                @if ($errors->has('job_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('job_no') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <hr/>
                        <h4 class="row text-center font-weight-bold card-header mb-1">Customer</h4>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="customer_name" class="col-form-label text-md-right">{{ __('Customer Name:') }}</label>
                                <input type="text" class="form-control" name="customer_name" value="" >
                                @if ($errors->has('customer_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="customer_address" class="col-form-label text-md-right">{{ __('Customer Address:') }}</label>
                                <input id="customer_address" type="text" class="form-control" name="customer_address" value="" >
                                @if ($errors->has('customer_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('customer_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="requested_by" class="col-form-label text-md-right">{{ __('Service Requested by:') }}</label>
                                <input type="text" class="form-control" name="requested_by" value="" >
                                @if ($errors->has('requested_by'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('requested_by') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="contact_no" class="col-form-label text-md-right">{{ __('Contact No:') }}</label>
                                <input id="contact_no" type="text" class="form-control" name="contact_no" value="" >
                                @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contact_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr/>
                        <h4 class="text-center">Job</h4>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="job_description" class="col-form-label text-md-right">{{ __('Job Description:') }}</label>
                                <input type="text" class="form-control" name="job_description" value="" >
                                @if ($errors->has('job_description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('job_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="job_address" class="col-form-label text-md-right">{{ __('Job Address:') }}</label>
                                <input id="job_address" type="text" class="form-control" name="job_address" value="" >
                                @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('job_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="site_contact" class="col-form-label text-md-right">{{ __('Site Contact:') }}</label>
                                <input type="text" class="form-control" name="site_contact" value="" >
                                @if ($errors->has('site_contact'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('site_contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="site_contact_no" class="col-form-label text-md-right">{{ __('Contact No:') }}</label>
                                <input id="site_contact_no" type="text" class="form-control" name="site_contact_no" value="" >
                                @if ($errors->has('site_contact_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('site_contact_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr/>
                        <h4 class="row text-center font-weight-bold card-header mb-1">AUTHORITY TO PERFORM WORK</h4>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="read_understood" class="col-form-label text-md-right">{{ __('Read and understood by:') }}</label>
                                <input type="text" class="form-control" name="read_understood" value="" >
                                @if ($errors->has('read_understood'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('read_understood') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="authority_name" class="col-form-label text-md-right">{{ __('Name:') }}</label>
                                <input id="authority_name" type="text" class="form-control" name="authority_name" value="" >
                                @if ($errors->has('authority_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('authority_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="authority_dt" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input type="text" class="form-control date-picker" name="authority_dt" value="" >
                                @if ($errors->has('authority_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('authority_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="authority_signature" class="col-form-label text-md-right">{{ __('Signature:') }}</label>
                                        <input type="hidden" name="authority_signature_hidden" id="img_authority_signature" value="">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="authority_signature" type="button" class="btn btn-secondary btn-block btn-signature">
                                            {{ __('Sign') }}
                                        </button>
                                    </div>
                                    <div class="col-md-8">
                                        <img class="ml-1" id="preview_authority_signature" src="" style="width: 100%;" />
                                    </div>

                                </div>

                            </div>
                        </div>
                        <hr>
                        <h4 class="row text-center font-weight-bold card-header mb-1">
                            <strong>DESCRIPTION OF WORK PERFORMED:</strong>
                        </h4>
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description" rows="5" style="resize: none; text-align: left" maxlength="1000"></textarea>
                        </div>
                        <hr/>
                        <h4 class="row text-center font-weight-bold card-header mb-1">
                            <strong>MATERIALS USED FROM STOCK:</strong>
                        </h4>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="purchase_no_1" class="col-form-label text-md-right">{{ __('Purchase Order No:') }}</label>
                                <input type="text" class="form-control" name="purchase_no_1" value="" >
                            </div>
                            <div class="col-md-10">
                                <label for="material_no_1" class="col-form-label text-md-right">{{ __('Materials Used:') }}</label>
                                <input type="text" class="form-control" name="material_no_1" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="purchase_no_2" value="" >
                            </div>
                            <div class="col-md-10">

                                <input type="text" class="form-control" name="material_no_2" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="purchase_no_3" value="" >
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="material_no_3" value="" >
                            </div>
                        </div>
                        <h4 class="row text-center font-weight-bold card-header mb-1">
                            <strong>TIME SHEET:</strong>
                        </h4>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="time_sheet_dt_1" class="col-form-label text-md-right">{{ __('Date:') }}</label>
                                <input type="text" class="form-control" name="time_sheet_dt_1" value="" >
                            </div>
                            <div class="col-md-2">
                                <label for="time_sheet_start_1" class="col-form-label text-md-right">{{ __('Start Time:') }}</label>
                                <input type="text" class="form-control" name="time_sheet_start_1" value="" >
                            </div>
                            <div class="col-md-2">
                                <label for="time_sheet_end_1" class="col-form-label text-md-right">{{ __('Finish Time:') }}</label>
                                <input type="text" class="form-control" name="time_sheet_end_1" value="" >
                            </div>
                            <div class="col-md-2">
                                <label for="time_sheet_total_1" class="col-form-label text-md-right">{{ __('Total Time:') }}</label>
                                <input type="text" class="form-control" name="time_sheet_total_1" value="" >
                            </div>
                            <div class="col-md-3">
                                <label for="time_sheet_initial_1" class="col-form-label text-md-right">{{ __('Employee Initials:') }}</label>
                                <input type="text" class="form-control" name="time_sheet_initial_1" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_dt_2" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_start_2" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_end_2" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_total_2" value="" >
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_initial_2" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_dt_3" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_start_3" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_end_3" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_total_3" value="" >
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_initial_3" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_dt_4" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_start_4" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_end_4" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_total_4" value="" >
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_initial_4" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_dt_5" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_start_5" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_end_5" value="" >
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="time_sheet_total_5" value="" >
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="time_sheet_initial_5" value="" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-9">
                                <a href="{{url()->previous()}}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
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

    @for ($i = 1; $i <= 4; $i++)
    <div class="modal" tabindex="-1" role="dialog" id="modal_signature_{{$i}}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Signature {{$i}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group alert" role="alert">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <div id="div_signature_{{$i}}" class="div-signature"></div>

                                <input type="button" value="Clear" id="div_signature_{{$i}}" class="btn btn-danger btn-clear-sign" >
                                <script>
                                </script>
                            </div>
                        </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-save-sign" id="save_signature_{{$i}}" data-dismiss="modal" >Save & Close</button>
          </div>
        </div>
      </div>
    </div>
    @endfor


@endsection
