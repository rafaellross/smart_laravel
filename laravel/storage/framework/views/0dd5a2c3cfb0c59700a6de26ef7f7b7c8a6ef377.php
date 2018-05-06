<div class="alert alert-secondary" style="text-align: center;">
    <h4>Job <?php echo e($job_curr); ?></h4>
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 col-12 mb-3">
            <label>Start</label>
            
            <?php if($job_curr === 1): ?>
                <select class="hour-start start-<?php echo e($job_curr); ?> form-control form-control-lg custom-select start group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_start_<?php echo e($job_curr); ?>" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][start]">
            <?php else: ?>
                <select class="hour-start form-control form-control-lg custom-select start group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_start_<?php echo e($job_curr); ?>" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][start]">
            <?php endif; ?>            
                    <option selected value="">-</option>          
                    <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                        <option value="<?php echo e($i); ?>"><?php echo e(date('i:s', $i)); ?></option>
                    <?php endfor; ?>                                                
            </select>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label>End</label>
            <select class="hour-end end-<?php echo e($job_curr); ?> form-control form-control-lg custom-select end group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_end_<?php echo e($job_curr); ?>" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][end]">
                        <option selected value="">-</option>          
                    <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                        <option value="<?php echo e($i); ?>"><?php echo e(date('i:s', $i)); ?></option>
                    <?php endfor; ?>                                                
            </select>
        </div>
    </div>
    <!-- Job and Hours-->
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Job</label>
            <?php if($job_curr === 1): ?>   
                <select class="form-control form-control-lg custom-select job job-1 group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_job_<?php echo e($job_curr); ?>" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][job]">
            <?php else: ?>
                <select class="form-control form-control-lg custom-select job group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_job_<?php echo e($job_curr); ?>" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][job]">
            <?php endif; ?>                         
                <option value="">Select Job</option>
                <?php $__currentLoopData = $jobDB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($day != "sat"): ?>
                        <option value="<?php echo e($job->code); ?>"><?php echo e($job->description); ?></option>
                    <?php else: ?>
                        <?php if(!in_array($job->code, ["sick", "anl", "pld", "tafe", "holiday", "rdo"])): ?>
                            <option value="<?php echo e($job->code); ?>"><?php echo e($job->description); ?></option>
                        <?php endif; ?>                
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                                
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours</label>
                <input readonly="" type="text" class="form-control form-control-lg time job1 hours group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" id="<?php echo e($day); ?>_hours_<?php echo e($job_curr); ?>" value="" maxlength="5" name="days[<?php echo e($day); ?>][<?php echo e($job_curr); ?>][hours]">
        </div>        
        <?php if($first): ?>
            <button type="button" class="btn btn-secondary btn-sm" id="btnShowExtra" onclick="showExtra(this, extraJobs<?php echo e($day); ?>)">Show More Jobs</button>
        <?php endif; ?>        
        
        <input id="group_<?php echo e($day); ?>_<?php echo e($job_curr); ?>" type="button" class="btn btn-danger btn-sm ml-2 btnClear" value="Clear"/>
    </div>
</div>