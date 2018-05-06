<?php $__env->startSection('content'); ?>
        <div class="container">
            <!-- Logo -->
            <div class="row" id="logo">
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                    <img src="<?php echo e(URL::to('/')); ?>/img/logo.svg" alt="Smart Plumbing Solutions" class="img-fluid" style="padding: 1em;">
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
                <form method="post" action="<?php echo e(route('employee_application.store')); ?>">
                    <?php echo csrf_field(); ?>
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
                                            <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Type your first name" value="<?php echo e($employee_application->first_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Last Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Type your last name" value="<?php echo e($employee_application->last_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 col-12 mb-3">
                                            <label>
                                                <strong>Date of Birth:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="dob" value="<?php echo e(Carbon::parse($employee_application->dob)->format('d/m/Y')); ?>" required>
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
                                            <input type="text" class="form-control form-control-lg" name="street_address" value="<?php echo e($employee_application->street_address); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-10 col-12 mb-3">
                                            <label>
                                                <strong>Suburb:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="suburb" value="<?php echo e($employee_application->suburb); ?>" required>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <label>
                                                <strong>Post Code:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="post_code"  value="<?php echo e($employee_application->post_code); ?>" maxlength="4" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>State:</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="state" required>
                                                <option value="">Select State</option>
                                                <?php $__currentLoopData = App\States::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($state->id); ?>" <?php echo e($state->id == $employee_application->state ? 'selected' : ''); ?>><?php echo e($state->description); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
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
                                            <input type="text" class="form-control form-control-lg" name="mobile" value="<?php echo e($employee_application->mobile); ?>"  maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Phone:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="phone" value="<?php echo e($employee_application->phone); ?>"  maxlength="20" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>E-mail:</strong>
                                            </label>
                                            <input type="email" class="form-control form-control-lg" name="email" value="<?php echo e($employee_application->email); ?>" required>
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
                                            <input type="text" class="form-control form-control-lg" name="emergency_name" value="<?php echo e($employee_application->emergency_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Phone:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="emergency_phone" value="<?php echo e($employee_application->emergency_phone); ?>"  maxlength="20" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Relationship:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="emergency_relationship" value="<?php echo e($employee_application->emergency_relationship); ?>" required>
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
                                            <input type="text" class="form-control form-control-lg" name="tax_file_number" value="<?php echo e($employee_application->tax_file_number); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Date Employment Commenced:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="date_commenced" value="<?php echo e(Carbon::parse($employee_application->date_commenced)->format('d/m/Y')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Bank A/C Name:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="bank_acc_name" value="<?php echo e($employee_application->bank_acc_name); ?>" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>BSB Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="bsb" value="<?php echo e($employee_application->bsb); ?>" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>A/C Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="account_number" value="<?php echo e($employee_application->account_number); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Superannuation Details:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="superannuation" value="<?php echo e($employee_application->superannuation); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Redundancy Details:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="redundancy" value="<?php echo e($employee_application->redundancy); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 col-12 mb-3">
                                            <label>
                                                <strong>Long Service Nº:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="long_service_number" value="<?php echo e($employee_application->long_service_number); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label>
                                                <strong>Are you an apprentice?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice">
                                                <option value="0" <?php echo e($employee_application->apprentice == 0 ? 'selected' : ''); ?>>No</option>
                                                <option value="1" <?php echo e($employee_application->apprentice == 1 ? 'selected' : ''); ?>>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3" id="apprentice-year" style="<?php echo e($employee_application->apprentice == 1 ? '' : 'display:none;'); ?>">
                                            <label>
                                                <strong>Which year?</strong>
                                            </label>
                                            <select class="form-control form-control-lg custom-select" name="apprentice_year">
                                                <option value="1" <?php echo e($employee_application->apprentice_year == 1 ? 'selected' : ''); ?>>1 st</option>
                                                <option value="2" <?php echo e($employee_application->apprentice_year == 2 ? 'selected' : ''); ?>>2 nd</option>
                                                <option value="3" <?php echo e($employee_application->apprentice_year == 3 ? 'selected' : ''); ?>>3 rd</option>
                                                <option value="4" <?php echo e($employee_application->apprentice_year == 4 ? 'selected' : ''); ?>>4 th</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="card" style="padding: 0;" id="licenses-list">
                            <h5 class="card-header">Current Licenses</h5>
                            <?php $__currentLoopData = $employee_application->licenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $license): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-body">
                                <!-- Start Card -->
                                <h5 class="card-title"><?php echo e($license->license->description); ?> :</h5>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-2 col-12 mb-3">
                                            <label>
                                                <strong>Issue Date:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg date-picker" name="license[<?php echo e($license->id); ?>][issue_date]" placeholder="dd/mm/yyyy" value="<?php echo e(Carbon::parse($license->issue_date)->format('d/m/Y')); ?>"  maxlength="10" required>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3 ml-auto">
                                            <label>
                                                <strong>State / Issuer *:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="license[<?php echo e($license->id); ?>][issuer]" placeholder="Issued by" value="<?php echo e($license->issuer); ?>" required>
                                        </div>
                                        <div class="col-md-4 col-12 ml-auto">
                                            <label>
                                                <strong>Card / Licence No *:</strong>
                                            </label>
                                            <input type="text" class="form-control form-control-lg" name="license[<?php echo e($license->id); ?>][number]" placeholder="License Number" value="<?php echo e($license->id); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Photo - Front *:</strong>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="license[<?php echo e($license->id); ?>][image][front]" accept="image/*" value="0" required>                                                    
                                                    <label class="custom-file-label">Choose file</label>
                                                    <input type="hidden" name="license[<?php echo e($license->id); ?>][image][front][img]" value="<?php echo e($license->image_front); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <img src="<?php echo e($license->image_front); ?>" id="license[<?php echo e($license->id); ?>][image][front][preview]" class="img-thumbnail" style="max-width: 50%;display: block;"/>
                                        </div>
                                        <div class="col-md-4 col-12 mb-3">
                                            <label>
                                                <strong>Photo - Back:</strong>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="license[<?php echo e($license->id); ?>][image][back]" accept="image/*" value="0" required>
                                                    <label class="custom-file-label">Choose file</label>
                                                    <input type="hidden" name="license[<?php echo e($license->id); ?>][image][back][img]" value="<?php echo e($license->image_back); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-3">
                                            <img src="<?php echo e($license->image_back); ?>" class="img-thumbnail" id="license[<?php echo e($license->id); ?>][image][back][preview]" style="max-width: 50%;display: block;"/>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                </div>
                                
                                <hr>
                            </div>                                                    

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            

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
                                            <select class="form-control" id="licenseId" name="licenseId">
                                                <option value="">Select License</option>
                                                <?php $__currentLoopData = App\License::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $license): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($license->id !== 1 && $license->id !== 16): ?>
                                                        <option value="<?php echo e($license->id); ?>"><?php echo e($license->description); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
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
        <script src="<?php echo e(asset('js/employee_application.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>