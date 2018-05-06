<div class="alert alert-secondary" style="text-align: center;">
    <h4>Job <?php echo e($job->number); ?></h4>
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 col-12 mb-3">
            <label>Start</label>
            
            <?php if($job->number === 1): ?>
                <select class="hour-start start-<?php echo e($job->number); ?> form-control form-control-lg custom-select start group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_start_<?php echo e($job->number); ?>" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][start]">
            <?php else: ?>
                <select class="hour-start form-control form-control-lg custom-select start group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_start_<?php echo e($job->number); ?>" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][start]">
            <?php endif; ?>  
                <option selected value="">-</option>          
                <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                    <option value="<?php echo e($i); ?>" <?php echo e(!is_null($job->start) && $job->start == $i ? 'selected' : ''); ?>><?php echo e(date('i:s', $i)); ?></option>
                <?php endfor; ?>                                                                
            </select>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label>End</label>
            <select class="hour-end end-<?php echo e($job->number); ?> form-control form-control-lg custom-select end group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_end_<?php echo e($job->number); ?>" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][end]">
                    <option selected value=""></option>          
                <?php for($i = 0; $i <= (24*60)-15; $i += 15): ?>        
                    <option value="<?php echo e($i); ?>" <?php echo e(!is_null($job->end) && $job->end == $i ? 'selected' : ''); ?>><?php echo e(date('i:s', $i)); ?></option>
                <?php endfor; ?>                                                                
            </select>
        </div>
    </div>
    <!-- Job and Hours-->
    <div class="form-row" style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Job</label>
            <?php if($job->number === 1): ?>   
                <select class="form-control form-control-lg custom-select job job-1 group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_job_<?php echo e($job->number); ?>" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][job]">
            <?php else: ?>
                <select class="form-control form-control-lg custom-select job group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_job_<?php echo e($job->number); ?>" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][job]">
            <?php endif; ?>         
                    <option value="">Select Job</option>
                <?php $__currentLoopData = $jobDB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($weekDay->short != "sat"): ?>
                        <option value="<?php echo e($jobList->code); ?>" <?php echo e($job->job_id == $jobList->id ? 'selected' : ''); ?>><?php echo e($jobList->description); ?></option>
                    <?php else: ?>
                        <?php if(!in_array($jobList->code, ["sick", "anl", "pld", "tafe", "holiday", "rdo"])): ?>
                            <option value="<?php echo e($jobList->code); ?>" <?php echo e($job->job_id == $jobList->id ? 'selected' : ''); ?>><?php echo e($jobList->description); ?></option>
                        <?php endif; ?>                
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                                

            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time job1 hours group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" id="<?php echo e($weekDay->short); ?>_hours_<?php echo e($job->number); ?>" value="<?php echo e(!is_null($job->hours()) && $job->hours() != '00:00' ? date('i:s', $job->hours()) : ""); ?>" maxlength="5" name="days[<?php echo e($weekDay->short); ?>][<?php echo e($job->number); ?>][hours]">    
        </div>        
        <?php if($first): ?>
            <button type="button" class="btn btn-secondary btn-sm" id="btnShowExtra" onclick="showExtra(this, extraJobs<?php echo e($weekDay->short); ?>)">Show More Jobs</button>
        <?php endif; ?>        
        
        <input id="group_<?php echo e($weekDay->short); ?>_<?php echo e($job->number); ?>" type="button" class="btn btn-danger btn-sm ml-2 btnClear" value="Clear">
    </div>
</div>