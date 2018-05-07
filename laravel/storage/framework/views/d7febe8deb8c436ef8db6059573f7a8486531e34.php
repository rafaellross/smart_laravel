                <!-- Start Group Prefill-->
                <div class="form-group alert alert-info" role="alert" id="groupPre">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="display: none;">
                                <input type="checkbox" id="pre">
                                <strong style="padding-left: 5px;"> Special Leave?</strong>
                            </div>
                        </div>

                    <h4 style="text-align: center;">Autofill Time Sheet</h4>

                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-6 col-12 mb-3">
                                <label>Start</label>
                                <select class="hour-start form-control form-control-lg custom-select " id="preStart" disable>
                                    <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                                        <option value="<?php echo e($i); ?>" <?php echo e($i == (7*60) ? 'selected' : ''); ?>><?php echo e(date('i:s', $i)); ?></option>
                                    <?php endfor; ?>                                                
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label>End</label>
                                <select class="hour-start form-control form-control-lg custom-select " id="preEnd">
                                    <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                                        <option value="<?php echo e($i); ?>" <?php echo e($i == (15.25*60) ? 'selected' : ''); ?>><?php echo e(date('i:s', $i)); ?></option>
                                    <?php endfor; ?>                                                
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="text-align: center;">
                            <div class="col-md-12 mb-3">
                                <label>Job</label>
                                <select class="form-control form-control-lg custom-select " id="preJob">
                                    <option value="">Select Job</option>
                                    <?php $__currentLoopData = $jobDB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($job->code); ?>" <?php echo e($job->code == '001' ? 'selected' : ''); ?>><?php echo e($job->description); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                                
                                </select>
                            </div>
                        </div>
                        <div class="form-row overtime" style="text-align: center;display:none;">
                            <div class="col-md-6 mb-3">
                                <label>Normal Hours</label>
                                <input readonly="" type="text" class="form-control form-control-lg time " id="PreNormal" value="00:00" maxlength="5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Hours 1.5</label>
                                <input readonly="" type="text" class="form-control form-control-lg time " id="Pre15" value="00:00" maxlength="5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Hours 2.0</label>
                                <input readonly="" type="text" class="form-control form-control-lg time" id="Pre20" value="00:00" maxlength="5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Total Hours</label>
                                <input readonly="" type="text" class="form-control form-control-lg time" id="preHours" value="00:00" maxlength="5">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                                <button type="button" class="btn btn-secondary btn-lg btn-block" id="btnPreFill">Autofill Time Sheet</button>
                        </div>

                </div>