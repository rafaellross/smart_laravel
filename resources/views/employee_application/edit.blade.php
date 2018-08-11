
@section('content')
@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/pdf.worker.js') }}"></script>
<script src="{{ asset('js/pdf.js') }}"></script>

        <div class="container">
            <!-- Logo -->
            <div class="row" id="logo">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                    <img src="{{ URL::to('/') }}/img/logo.svg" alt="Smart Plumbing Solutions" class="img-fluid" style="padding: 1em;">
                </div>
            </div>
            <br>
            <!-- Title -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                    <h2>Employee Application Form</h2>
                </div>
            </div>
            <br>
                <div class="row "  style="padding: 0;">
                <div id="content" class="col-xs-12 col-sm-12 col-md-12 col-12" style="padding: 0;">
                <form action="{{ route('employee_application.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <!-- Personal Details -->
                        <div class="card shadow" style=""  id="personalDetails">
                            <h5 class="card-header">Personal Details</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>First Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Type your first name" value="{{$employee_application->first_name}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Last Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Type your last name" value="{{$employee_application->last_name}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 col-12 mb-3">
                                            <label>
                                                <strong>Date of Birth:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="dob" value="{{ Carbon::parse($employee_application->dob)->format('d/m/Y') }}" required>
                                        </div>
                                        <div class="col-md-6 col-12 mb-6">
                                            <label>
                                                <strong>Gender:</strong>
                                            </label>
                                            <select class="form-control form-control-lg" name="gender">F
                                                <option value="M" {{$employee_application->gender == 'M' ? 'selected' : ''}}>Male</option>
                                                <option value="F" {{$employee_application->gender == 'F' ? 'selected' : ''}}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Personal Details -->
                        <br>
                        <!-- Address Details -->
                        <div class="card shadow" id="addressDetails">
                            <h5 class="card-header">Address Details</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Street Address:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="street_address" value="{{$employee_application->street_address}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-10 col-12 mb-3">
                                            <label>
                                                <strong>Suburb:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="suburb" value="{{$employee_application->suburb}}" required>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <label>
                                                <strong>Post Code:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="post_code"  value="{{$employee_application->post_code}}" maxlength="4" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>State:</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="state" required>
                                                <option value="">Select State</option>
                                                @foreach (App\States::all() as $state)
                                                    <option value="{{$state->id}}" {{$state->id == $employee_application->state ? 'selected' : ''}}>{{$state->description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Address Details -->
                        <br>
                        <!-- Contact Details -->
                        <div class="card shadow" id="contactDetails">
                            <h5 class="card-header">Contact Details</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Mobile:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="mobile" value="{{$employee_application->mobile}}"  maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Phone:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="phone" value="{{$employee_application->phone}}"  maxlength="20" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>E-mail:</strong>
                                            </label>
                                            <input type="email" class="form-control form-control-lg" name="email" value="{{$employee_application->email}}" required>
                                        </div>

                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Details -->
                        <br>
                        <!-- Emergency Contact -->
                        <div class="card shadow" id="emergencyDetails">
                            <h5 class="card-header">Emergency Details</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="emergency_name" value="{{$employee_application->emergency_name}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Phone:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="emergency_phone" value="{{$employee_application->emergency_phone}}"  maxlength="20" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Relationship:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="emergency_relationship" value="{{$employee_application->emergency_relationship}}" required>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Emergency Details -->


                        <br>
                        <div class="card shadow" id="employmentDetails">
                            <h5 class="card-header">Employment Details</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Tax File Number:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="tax_file_number" value="{{$employee_application->tax_file_number}}" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Bank A/C Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="bank_acc_name" value="{{$employee_application->bank_acc_name}}" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>BSB Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="bsb" value="{{$employee_application->bsb}}" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>A/C Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="account_number" value="{{$employee_application->account_number}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Superannuation Details:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="superannuation" value="{{$employee_application->superannuation}}" {{is_null($employee_application->superannuation) ? 'disabled' : 'required'}}>
                                            <div class="custom-control custom-checkbox mt-2">
                                              <input type="checkbox" class="custom-control-input" id="chk_no_super" value="accept" {{is_null($employee_application->superannuation) ? 'checked' : ''}}>
                                              <label class="custom-control-label" for="chk_no_super">
                                                I don't have any superannuation details!
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Redundancy Details:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="redundancy" value="{{$employee_application->redundancy}}" {{is_null($employee_application->redundancy) ? 'disabled' : 'required'}}>
                                            <div class="custom-control custom-checkbox input-group-lg mt-2">
                                              <input type="checkbox" class="custom-control-input" id="chk_no_redudancy" value="accept" {{is_null($employee_application->redundancy) ? 'checked' : ''}}>
                                              <label class="custom-control-label" for="chk_no_redudancy">
                                                I don't have any redudancy details!
                                              </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Long Service Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="long_service_number" value="{{$employee_application->long_service_number}}" {{is_null($employee_application->long_service_number) ? 'disabled' : 'required'}}>
                                            <div class="custom-control custom-checkbox input-group-lg mt-2">
                                              <input type="checkbox" class="custom-control-input" id="chk_no_long_service" value="accept" {{is_null($employee_application->long_service_number) ? 'checked' : ''}}>
                                              <label class="custom-control-label" for="chk_no_long_service">
                                                I don't have any long service details!
                                              </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label>
                                                <strong>Are you an apprentice?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice">
                                                <option value="0" {{$employee_application->apprentice ? '' : 'selected'}}>No</option>
                                                <option value="1" {{$employee_application->apprentice ? 'selected' : ''}}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3" id="apprentice-year" style="{{$employee_application->apprentice ? '' : 'display:none;'}}">
                                            <label>
                                                <strong>Which year?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice_year">
                                                <option value="1" {{$employee_application->apprentice_year == '1' ? 'selected' : ''}}>1 st</option>
                                                <option value="2" {{$employee_application->apprentice_year == '2' ? 'selected' : ''}}>2 nd</option>
                                                <option value="3" {{$employee_application->apprentice_year == '3' ? 'selected' : ''}}>3 rd</option>
                                                <option value="4" {{$employee_application->apprentice_year == '4' ? 'selected' : ''}}>4 th</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card shadow">
                            <h5 class="card-header">Tax Declaration</h5>

                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="form-row">
                                    <div class="col-md-4 col-4 mb-3">
                                        <label>
                                            <strong>Date Employment Commenced:</strong>
                                        </label>
                                        <input type="text" class="form-control form-control-lg date-picker" name="date_commenced" value="{{$employee_application->date_commenced}}" required>
                                    </div>
                                    <div class="col-md-4 col-4 mb-3">
                                        <label>
                                            <strong>Employment Type:</strong>
                                        </label>
                                        <select name="paid_basis" class="form-control form-control-lg">
                                            <option value="">Select employment type</option>
                                            <option value="F" {{$employee_application->paid_basis == 'F' ? 'selected' : ''}}>Full-time</option>
                                            <option value="P" {{$employee_application->paid_basis == 'P' ? 'selected' : ''}}>Part-time</option>
                                            <option value="C" {{$employee_application->paid_basis == 'C' ? 'selected' : ''}}>Casual</option>
                                            <option value="L" {{$employee_application->paid_basis == 'L' ? 'selected' : ''}}>Labour hire</option>
                                            <option value="S" {{$employee_application->paid_basis == 'S' ? 'selected' : ''}}>Superannuation or annuity income stream</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-4 mb-3">
                                        <label>
                                            <strong>Are you:</strong><span></span>
                                        </label>
                                        <select name="tax_status" class="form-control form-control-lg">
                                            <option value="">Select Tax Status</option>
                                            <option value="R" {{$employee_application->tax_status == 'R' ? 'selected' : ''}}>An Australian resident for tax purposes</option>
                                            <option value="F" {{$employee_application->tax_status == 'F' ? 'selected' : ''}}>A foreign resident for tax purposes</option>
                                            <option value="H" {{$employee_application->tax_status == 'H' ? 'selected' : ''}}>A working holiday maker</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label>
                                            <strong>Do you want to claim the tax-free threshold from Smart Plumbing Solutions?</strong>
                                        </label>
                                        <br>
                                        <i>Only claim the tax-free threshold from one payer at time, unless your total income from all soures for the financial year will be less than the tax-free threshold.</i>
                                        <select name="claim_threshold" class="form-control form-control-lg">
                                            <option value="">Select an option</option>
                                            <option value="1" {{$employee_application->claim_threshold == '1' ? 'selected' : ''}}>YES</option>
                                            <option value="0" {{$employee_application->claim_threshold == '0' ? 'selected' : ''}}>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label>
                                            <strong>Do you have a Higher Education Loan Program (HELP), Student Start-up Loan (SSL) or Trade Support Loan (TSL) debt?</strong>
                                        </label>
                                        <br>
                                        <select name="educational_loan" class="form-control form-control-lg">
                                            <option value="">Select an option</option>
                                            <option value="1" {{$employee_application->educational_loan == '1' ? 'selected' : ''}}>YES</option>
                                            <option value="0" {{$employee_application->educational_loan == '0' ? 'selected' : ''}}>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label>
                                            <strong>Do you have a Financial Supplement debt?</strong>
                                        </label>
                                        <br>
                                        <select name="financial_supplement" class="form-control form-control-lg">
                                            <option value="">Select an option</option>
                                            <option value="1" {{$employee_application->financial_supplement == '1' ? 'selected' : ''}}>YES</option>
                                            <option value="0" {{$employee_application->financial_supplement == '0' ? 'selected' : ''}}>NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="card" style="padding: 0;" id="licenses-list">
                          <h5 class="card-header">Current Licenses</h5>
                          @foreach ($employee_application->licenses as $license)
                          <div class="card-body">
                              <!-- Start Card -->
                              <h5 class="card-title">{{$license->license->description}} :</h5>

                              <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-row">
                                      <div class="col-md-2 col-12 mb-3">
                                          <label>
                                              <strong>Issue Date:</strong>
                                          </label>
                                          <input type="text" class="form-control form-control-lg date-picker" name="license[{{$license->id}}][issue_date]" placeholder="dd/mm/yyyy" value="{{Carbon::parse($license->issue_date)->format('d/m/Y')}}"  maxlength="10" required>
                                      </div>
                                      <div class="col-md-4 col-12 mb-3 ml-auto">
                                          <label>
                                              <strong>State / Issuer *:</strong>
                                          </label>
                                          <input type="text" class="form-control form-control-lg" name="license[{{$license->id}}][issuer]" placeholder="Issued by" value="{{$license->issuer}}" required>
                                      </div>
                                      <div class="col-md-4 col-12 ml-auto">
                                          <label>
                                              <strong>Card / Licence No *:</strong>
                                          </label>
                                          <input type="text" class="form-control form-control-lg" name="license[{{$license->id}}][number]" placeholder="License Number" value="{{$license->number}}" required>
                                      </div>
                                  </div>
                                  <div class="form-row">
                                      <div class="col-md-4 col-12 mb-3">
                                          <label>
                                              <strong>Photo - Front *:</strong>
                                          </label>
                                          <div class="input-group mb-3">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" name="license[{{$license->id}}][image][front]" accept="image/*" value="1">
                                                  <label class="custom-file-label">Choose file</label>
                                                  <input type="hidden" name="license[{{$license->id}}][image][front][img]" value="{{$license->image_front}}" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-2 col-12 mb-3">
                                          <img src="{{$license->image_front}}" id="license[{{$license->id}}][image][front][preview]" class="img-thumbnail" style="max-width: 50%;display: block;"/>
                                      </div>
                                      <div class="col-md-4 col-12 mb-3">
                                          <label>
                                              <strong>Photo - Back:</strong>
                                          </label>
                                          <div class="input-group mb-3">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" name="license[{{$license->id}}][image][back]" accept="image/*" value="1">
                                                  <label class="custom-file-label">Choose file</label>
                                                  <input type="hidden" name="license[{{$license->id}}][image][back][img]" value="{{$license->image_back}}" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-2 col-12 mb-3">
                                          <img src="{{$license->image_back}}" class="img-thumbnail" id="license[{{$license->id}}][image][back][preview]" style="max-width: 50%;display: block;"/>
                                      </div>
                                  </div>
                                  <!-- End Card -->
                              </div>

                              <hr>
                          </div>

                          @endforeach

                      </div>

                        <br>
                        <!-- Additional Licenses Card-->
                        <div class="card shadow" id="additionalLicenses">
                            <h5 class="card-header">Additional Licenses</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5 col-12 mb-3">
                                            <select class="form-control" id="licenseId" name="licenseId"><option value="">Select License</option>
                                                @foreach (App\License::all() as $license)
                                                    @if ($license->id !== 1 && $license->id !== 16)
                                                        <option value="{{$license->id}}">{{$license->description}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <groupedselectlistitem>
                                            </groupedselectlistitem>
                                        </div>
                                        <div class="col-md-5 col-12 mb-3">
                                            <button type="button" class="btn btn-success" id="addLicense">Add License</button>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Additional Licenses Card-->
                        <br>
                        <!-- Signature-->
                        <div class="card shadow" id="additionalLicenses">
                            <h5 class="card-header">Signature</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="chk_policy" value="accept">
                                        <label class="custom-control-label" for="chk_policy">
                                          I declare that the information I have given is true and correct. I have read and understood <a target="_blank" href="{{asset('templates/policy_procedures.pdf')}}">Smart Plumbing Solutions's Policies & Procedures</a>.

                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-row" style="text-align: center;">
                                      <div class="col-md-12 mb-3">
                                        <input type="hidden" name="signature" value="{{$employee_application->employee_signature}}">
                                          <div id="div_signature" class="div-signature"></div>
                                          <input type="button" value="Clear" id="div_signature" class="btn btn-danger btn-clear-sign" >
                                      </div>
                                      <div class="col-md-3 col-12 mb-3">
                                          <label>
                                              <strong>Date:</strong>
                                          </label>
                                          <input type="text" class="form-control form-control-lg" name="business_dt" value="{{ Carbon::parse($employee_application->business_dt)->format('d/m/Y') ? Carbon::parse($employee_application->business_dt)->format('d/m/Y') : '' }}" required>
                                      </div>
                                  </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Signature-->


                        <!-- End Signature-->

                        <br>
                        <!-- Actions Card-->
                        <div class="card shadow" id="actions">
                            <h5 class="card-header">Actions</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5 col-12 mb-3">
                                            <input id="submit_application" type="submit" class="btn btn-warning" value="Submit"/>
                                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Actions Card-->
                        <br>
                    </div>
                </div>
                </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
        <script src="{{ asset('js/employee_application.js') }}"></script>

@endsection
