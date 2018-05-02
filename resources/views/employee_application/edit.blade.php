@extends('layouts.app')

@section('content')
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
                <form method="post" action="{{ route('employee_application.store') }}">
                    @csrf
                        <!-- Personal Details -->
                        <div class="card" style="padding: 0;"  id="personalDetails">
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
                                    </div>
                                    <!-- End Card -->
                                </div>
                            </div>
                        </div>
                        <!-- End Personal Details -->
                        <br>
                        <!-- Address Details -->
                        <div class="card" id="addressDetails">
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
                        <div class="card" id="contactDetails">
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
                        <div class="card" id="emergencyDetails">
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
                        <div class="card" id="employmentDetails">
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
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Date Employment Commenced:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="date_commenced" value="{{Carbon::parse($employee_application->date_commenced)->format('d/m/Y')}}" required>
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
                                            <input type="text" class="form-control form-control-lg" name="superannuation" value="{{$employee_application->superannuation}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Redundancy Details:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="redundancy" value="{{$employee_application->redundancy}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Long Service Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="long_service_number" value="{{$employee_application->long_service_number}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label>
                                                <strong>Are you an apprentice?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice">
                                                <option value="0" {{$employee_application->apprentice == 0 ? 'selected' : ''}}>No</option>
                                                <option value="1" {{$employee_application->apprentice == 1 ? 'selected' : ''}}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3" id="apprentice-year" style="{{$employee_application->apprentice == 1 ? '' : 'display:none;'}}">
                                            <label>
                                                <strong>Which year?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice_year">
                                                <option value="1" {{$employee_application->apprentice_year == 1 ? 'selected' : ''}}>1 st</option>
                                                <option value="2" {{$employee_application->apprentice_year == 2 ? 'selected' : ''}}>2 nd</option>
                                                <option value="3" {{$employee_application->apprentice_year == 3 ? 'selected' : ''}}>3 rd</option>
                                                <option value="4" {{$employee_application->apprentice_year == 4 ? 'selected' : ''}}>4 th</option>
                                            </select>
                                        </div>
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
                                <h5 class="card-title">CIC Construction Induction Card :</h5>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-2 col-12 mb-3">
                                            <label>
                                                <strong>Issue Date:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="license[1][issue_date]" placeholder="dd/mm/yyyy" value="01/01/2001"  maxlength="10" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3 ml-auto">
                                            <label>
                                                <strong>State / Issuer *:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="license[1][issuer]" placeholder="Issued by" value="value" required>
                                        </div>
                                        <div class="col-md-4 col-12 ml-auto">
                                            <label>
                                                <strong>Card / Licence No *:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="license[1][number]" placeholder="License Number" value="value" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Photo - Front *:</strong>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="license[1][image][front]" accept="image/*" required>                                                    
                                                    <label class="custom-file-label">Choose file</label>
                                                    <input type="hidden" name="license[1][image][front][img]"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <img id="license[1][image][front][preview]" class="img-thumbnail" style="max-width: 35%;display: none;"/>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Photo - Back:</strong>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="license[1][image][back]" accept="image/*" required>
                                                    <label class="custom-file-label">Choose file</label>
                                                    <input type="hidden" name="license[1][image][back][img]"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <img class="img-thumbnail" id="license[1][image][back][preview]" style="max-width: 35%;display: none;"/>
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
                        <div class="card" id="additionalLicenses">
                            <h5 class="card-header">Additional Licenses</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5 col-12 mb-3">
                                            <select class="form-control" id="licenseId" name="licenseId"><option value="value">Select License</option>
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
                        <!-- Actions Card-->
                        <div class="card" id="actions">
                            <h5 class="card-header">Actions</h5>
                            <div class="card-body">
                                <!-- Start Card -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5 col-12 mb-3">
                                            <input type="submit" class="btn btn-warning" value="Submit"/>
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
        </div>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
        <script src="{{ asset('js/employee_application.js') }}"></script>
@endsection
