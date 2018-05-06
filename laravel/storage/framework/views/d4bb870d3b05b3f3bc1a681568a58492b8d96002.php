<?php $__env->startSection('content'); ?>


<div class="container">
        <!-- Logo -->
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
                <img src="<?php echo e(URL::to('/')); ?>/img/logo.svg" alt="Smart Plumbing Solutions" class="img-fluid" style="padding: 1em;">
            </div>
        <!-- Title -->
        <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center">
            <h2>Time Sheet</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <form method="POST" action="<?php echo e(action('TimeSheetController@update', ['id' => $timesheet->id])); ?>" id="timesheet_form">
                <?php echo method_field('PATCH'); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="empname">
                        <h5>Name:</h5>
                    </label>
                    <input readonly="" type="text" class="form-control form-control-lg" id="empname" placeholder="Type employee name" value="<?php echo e($timesheet->employee->name); ?>">
                </div>
                <div class="form-group">
                    <label for="empname">
                        <h5>Week End:</h5>
                    </label>
                    <input type="text" class="form-control form-control-lg date-picker" name="week_end" data-date-days-of-week-disabled="1,2,3,4,5,6" id="week_end" required="" value="<?php echo e(Carbon::parse($timesheet->week_end)->format('d/m/Y')); ?>">
                </div>
                <?php
                    $jobDB = App\Job::select('id', 'code','description')->get();            
                ?>                

                <?php echo $__env->make('timesheet.partial.autofill', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                

                <!-- Start Group Monday-->
                <?php $__currentLoopData = $timesheet->days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('timesheet.partial.edit.day', ['day'=>$day], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                 
                <!--End Group Monday -->
                <!-- Start Group Tuesday-->

                
                <div class="form-group alert alert-info" role="alert">                
                    <h4 style="text-align: center;">Medical Certificates</h4>    
                    <?php $cert_num = 0;?>
                    <?php $certificates = App\TimeSheetCertificate::where('time_sheet_id', $timesheet->id)->get(); ?>
                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <div class="alert alert-secondary">                          
                            <h5 style="text-align: center;">Certificate <?php echo e($certificate->certificate_number); ?></h5>          
                            <div class="input-group col-12 mb-3">
                              <div class="custom-file" id="medical_certificates_list">
                                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]" name="medical_certificates[<?php echo e($certificate->certificate_number); ?>]"/>                        
                                <label class="custom-file-label" for="medical_certificates[<?php echo e($certificate->certificate_number); ?>]">Choose files</label>
                              </div>
                            </div>
                            <div class="input-group col-12 mb-3">
                                <img id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_img" src="<?php echo e($certificate->certificate_img); ?>" class="img-fluid" style="">
                            </div>   
                            <input id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                            <input type="hidden" class="custom-file-input" id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_hidden" name="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_hidden" value="<?php echo e($certificate->certificate_img); ?>">                        
                        </div>
                    <?php endif; ?>                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                 
                <?php if($certificates->count() == 0): ?>                    
                    <div class="alert alert-secondary">                          
                        <h5 style="text-align: center;">Certificate 1</h5>          
                        <div class="input-group col-12 mb-3">
                          <div class="custom-file" id="medical_certificates_list">
                            <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[1]" name="medical_certificates[1]"/>                        
                            <label class="custom-file-label" for="medical_certificates[1]">Choose files</label>
                          </div>
                        </div>
                        <div class="input-group col-12 mb-3">
                            <img id="medical_certificates[1]_img" class="img-fluid" style="">
                        </div>   
                        <input id="medical_certificates[1]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                        <input type="hidden" class="custom-file-input" id="medical_certificates[1]_hidden" name="medical_certificates[1]_hidden" value="">                        
                    </div>
                <?php endif; ?>
                <div id="aditional_certificates">               
                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$loop->first): ?>
                        <div class="alert alert-secondary" id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_row">                          
                            <h5 style="text-align: center;">Certificate <?php echo e($certificate->certificate_number); ?></h5>          
                            <div class="input-group col-12 mb-3">
                              <div class="custom-file" id="medical_certificates_list">
                                <input type="file" class="custom-file-input medical_certificates" id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]" name="medical_certificates[<?php echo e($certificate->certificate_number); ?>]"/>                        
                                <label class="custom-file-label" for="medical_certificates[<?php echo e($certificate->certificate_number); ?>]">Choose files</label>
                              </div>
                            </div>
                            <div class="input-group col-12 mb-3">
                                <img id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_img" src="<?php echo e($certificate->certificate_img); ?>" class="img-fluid" style="">
                            </div>   
                            <input id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]-delete" type="button" class="btn btn-danger btn-sm ml-2 delCert" value="Delete">
                            <input type="hidden" class="custom-file-input" id="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_hidden" name="medical_certificates[<?php echo e($certificate->certificate_number); ?>]_hidden" value="<?php echo e($certificate->certificate_img); ?>">                        
                        </div>                                                    
                    <?php endif; ?>                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                </div>                            

                    <div>                                
                        <input id="addCert" type="button" class="btn btn-success btn-sm ml-2 addCert" value="Add Certificate">
                    </div>                    
                </div>
                
                <!-- Group Special Request -->
                <?php echo $__env->make('timesheet.partial.edit.special', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                
                <!-- End Group Special Request -->
                <!-- Start Group Total-->
                <?php echo $__env->make('timesheet.partial.edit.total', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                
                <!--End Group Total -->

                <!-- Start Group Signature-->
                <div class="form-group alert alert-success" role="alert" id="groupFriday">
                    <h4 style="text-align: center;">Signature</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">

                                <input type="hidden" name="emp_signature" id="output" value="">
                                <div id="signature"></div>

                                <input type="button" value="Clear" id="btnClearSign" class="btn btn-danger" >

                                <script>
                                    $(document).ready(function() {
                                        var $sigdiv = $("#signature")
                                        $sigdiv.jSignature() // inits the jSignature widget.
                                        // after some doodling...
                                        $('#btnClearSign').click(function(){
                                            $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
                                        });

                                       $('form').submit(function(){
                                           $('#output').val($sigdiv.jSignature("getData"));
                                       });
                                    });
                                </script>
                            </div>
                        </div>
                </div>
                <!-- Start Group Date-->
                <div class="form-group alert alert-success" role="alert" id="groupFriday">
                    <h4 style="text-align: center;">Date</h4>

                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <input type="text" class="form-control form-control-lg date-picker" name="empDate" id="empDate" required value="<?php echo e(Carbon::now()->format('d/m/Y')); ?>">
                            </div>
                        </div>
                </div>
                <!-- Start Group Date-->
                <div class="form-group alert alert-success" role="alert" id="groupStatus" style="<?php echo e(!Auth::user()->administrator ? 'display: none;' : ''); ?>">
                    <h4 style="text-align: center;">Status</h4>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                  <label for="status">Status</label>
                                  <select class="form-control" name="status" id="status">
                                    <option selected="" value="P">Pending</option>
                                    <option value="A">Approved</option>
                                    <option value="F">Finalised</option>
                                    <option value="C">Cancelled</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                </div>
                <!--End Group Total -->
                <div class="form-row" style="text-align: center;">
                    <div class="col-md-6 mb-3">
                        <a href="view.php?type=TimeSheet.php" class="btn btn-secondary btn-lg btn-block">Cancel</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>