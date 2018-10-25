@extends('layouts.app')

@section('content')
<script src="{{ asset('js/tmv.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create New - Annual TMV Service Log') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('TmvLogController@store', $tmv)}}">
                        @csrf
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Date:') }}</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control form-control-lg" name="log_dt" value="{{ old('log_dt') }}" required>
                                @if ($errors->has('log_dt'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('log_dt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="temp_range" class="col-md-4 col-form-label text-md-right">{{ __('Type:') }}</label>
                            <div class="col-md-6">
                              <select class="form-control form-control-lg custom-select" name="type">
                                  <option value="">Select Type</option>
                                  <option value="C">Commissioning Report - Temperature &  Thermal Shutoff test</option>
                                  <option value="A">12 Month Annual Temperature - Temperature &  Thermal Shutoff test</option>
                              </select>
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

                        <h4 lass="card-header" style="text-align: center;">Service Details</h4>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Replace all O-ring seals. Lubricate rings, seals & threads with High Temperature Silicone Grease.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_1" name="task_tk_1">
                                      <label class="custom-control-label" for="task_tk_1">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_1">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_1" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Remove, inspect & clean or replace in line filters.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_2" name="task_tk_2">
                                      <label class="custom-control-label" for="task_tk_2">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_2">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_2" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Flush out valve body & fittings.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_3" name="task_tk_3">
                                      <label class="custom-control-label" for="task_tk_3">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_3">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_3" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Reassemble valve & install.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_4" name="task_tk_4">
                                      <label class="custom-control-label" for="task_tk_4">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_4">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_4" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Check temperature range / reset as per commissioning instructions.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_5" name="task_tk_5">
                                      <label class="custom-control-label" for="task_tk_5">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_5">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_5" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Reset temperature is ... deg C</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_6" name="task_tk_6">
                                      <label class="custom-control-label" for="task_tk_6">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_6">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_6" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row alert">
                            <div class="col-md-12">
                                <p class="text-justify font-weight-bold">* Carry out thermal shutdown test.</p>
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox form-control-lg">
                                      <input type="checkbox" class="custom-control-input" id="task_tk_7" name="task_tk_7">
                                      <label class="custom-control-label" for="task_tk_7">Completed?</label>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                   <label for="task_rmk_7">Remarks:</label>
                                   <textarea class="form-control" name="task_rmk_7" rows="3"></textarea>
                                 </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="form-group row">
                            <label for="endorsed_by1" class="col-md-4 col-form-label text-md-right">{{ __('Endorsed by:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="endorsed_by1" value="{{ old('endorsed_by1') }}">
                                @if ($errors->has('endorsed_by1'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('endorsed_by1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endorsed_position1" class="col-md-4 col-form-label text-md-right">{{ __('Position:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="endorsed_position1" value="{{ old('endorsed_position1') }}">
                                @if ($errors->has('endorsed_position1'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('endorsed_position1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="serviceman1_lic" class="col-md-4 col-form-label text-md-right">{{ __('Signature:') }}</label>
                            <div class="col-md-6">
                              <div id="div_endorsed1_sig" class="div-signature"></div>
                              <input type="hidden" name="hidden_endorsed1_sig" id="hidden_endorsed1_sig" value="">
                              <input type="button" value="Clear" id="clear_endorsed1_sig" class="btn btn-danger btn-clear-sign" >
                            </div>
                        </div>

                        <hr/>

                        <h4 lass="card-header" style="text-align: center;">12 Month Temp & Thermal Shut off test</h4>

                        <div class="form-group row">
                            <label for="temp_bfr_test" class="col-md-4 col-form-label text-md-right">Temp before test (&#176;C):</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="temp_bfr_test" value="{{ old('temp_bfr_test') }}">
                                @if ($errors->has('temp_bfr_test'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temp_bfr_test') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="temp_reset" class="col-md-4 col-form-label text-md-right">Reset Temp (&#176;C):</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="temp_bfr_test" value="{{ old('temp_reset') }}">
                                @if ($errors->has('temp_reset'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temp_reset') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="therm_shutoff" class="col-md-4 col-form-label text-md-right">Thermal shutoff test:</label>
                            <div class="col-md-6">
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="therm_shutoff_pass" name="therm_shutoff_pass" class="custom-control-input">
                                <label class="custom-control-label" for="therm_shutoff_pass">Passed</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="therm_shutoff_fail" name="therm_shutoff_fail" class="custom-control-input">
                                <label class="custom-control-label" for="therm_shutoff_fail">Failed</label>
                              </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="serviceman2" class="col-md-4 col-form-label text-md-right">{{ __('Serviceman:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="serviceman2" value="{{ old('serviceman2') }}">
                                @if ($errors->has('serviceman2'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serviceman2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serviceman2_lic" class="col-md-4 col-form-label text-md-right">{{ __('Licence Number:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="serviceman2_lic" value="{{ old('serviceman2_lic') }}">
                                @if ($errors->has('serviceman2_lic'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('serviceman2_lic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serviceman2_lic" class="col-md-4 col-form-label text-md-right">{{ __('Signature:') }}</label>
                            <div class="col-md-6">
                              <div id="div_serviceman2_sig" class="div-signature"></div>
                              <input type="hidden" name="hidden_serviceman2_sig" id="hidden_serviceman2_sig" value="">
                              <input type="button" value="Clear" id="clear_serviceman2_sig" class="btn btn-danger btn-clear-sign" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endorsed_by2" class="col-md-4 col-form-label text-md-right">{{ __('Endorsed by:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="endorsed_by2" value="{{ old('endorsed_by2') }}">
                                @if ($errors->has('endorsed_by2'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('endorsed_by2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endorsed_position2" class="col-md-4 col-form-label text-md-right">{{ __('Position:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" name="endorsed_position2" value="{{ old('endorsed_position2') }}">
                                @if ($errors->has('endorsed_position2'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('endorsed_position2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="div_endorsed2_sig" class="col-md-4 col-form-label text-md-right">{{ __('Signature:') }}</label>
                            <div class="col-md-6">
                              <div id="div_endorsed2_sig" class="div-signature"></div>
                              <input type="hidden" name="hidden_endorsed2_sig" id="hidden_endorsed2_sig" value="">
                              <input type="button" value="Clear" id="clear_endorsed2_sig" class="btn btn-danger btn-clear-sign" >
                            </div>
                        </div>
                        <hr/>
                        <h4 style="text-align: center;">Photo</h4>
                        <div class="form-group row" role="alert">
                            <div class="alert alert-secondary col-12">

                                <div class="input-group col-12 mb-3">
                                    <div class="custom-file" id="medical_certificates_list">
                                        <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[1]" name="medical_certificates[1]" accept="image/*"/>
                                        <label class="custom-file-label" for="medical_certificates[1]">Choose file</label>
                                    </div>
                                </div>
                                <div class="input-group col-12 mb-3">
                                    <img id="medical_certificates[1]_img" class="img-fluid" style="" src="">
                                </div>
                                <input id="medical_certificates[1]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                                <input type="hidden" class="custom-file-input" id="medical_certificates[1]_hidden" name="photo_hidden" value="">
                            </div>
                        </div>

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
