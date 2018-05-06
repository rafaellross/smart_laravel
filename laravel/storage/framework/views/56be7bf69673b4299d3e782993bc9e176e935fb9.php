<div class="form-group alert alert-success" role="alert" id="groupMonday">
    <?php
        $weekDay = App\WeekDay::select('number','description', 'short')->where("number", "=", $day->week_day)->get()->first();
        
        
    ?>
    
    <h4 style="text-align: center;"><?php echo e($weekDay->description); ?></h4>    
    <!-- Start Job 1  -->        
        <?php $__currentLoopData = $day->dayJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->first): ?>
                <?php echo $__env->make('timesheet.partial.edit.job', ['day' => $day, 'job' => $job, 'first' => true, 'weekDay' => $weekDay], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>            
                <?php break; ?>
            <?php endif; ?>                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div id="extraJobs<?php echo e($weekDay->short); ?>" style="display:none;">
            <?php $__currentLoopData = $day->dayJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$loop->first): ?>
                    <?php echo $__env->make('timesheet.partial.edit.job', ['day' => $day, 'job' => $job, 'first' => false, 'weekDay' => $weekDay], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                                
                <?php endif; ?>                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>     
    <!-- Total day -->
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Normal Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time horNormal" id="<?php echo e($weekDay->short); ?>_nor" value="<?php echo e($day->normal); ?>" maxlength="5" name="days[<?php echo e($weekDay->short); ?>][total][normal]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Hours 1.5</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor15" id="<?php echo e($weekDay->short); ?>_15" value="<?php echo e($day->total_15); ?>" maxlength="5" name="days[<?php echo e($weekDay->short); ?>][total][1.5]">
        </div>
    </div>
    <div class="form-row overtime " style="text-align: center;">
        <div class="col-md-6 mb-3">
            <label>Hours 2.0</label>
            <input readonly="" type="text" class="form-control form-control-lg time hor20" value="<?php echo e($day->total_20); ?>" maxlength="5" id="<?php echo e($weekDay->short); ?>_20" name="days[<?php echo e($weekDay->short); ?>][total][2.0]">
        </div>
        <div class="col-md-6 mb-3">
            <label>Total Hours</label>
            <input readonly="" type="text" class="form-control form-control-lg time hours-total" value="<?php echo e($day->total); ?>" maxlength="5" id="<?php echo e($weekDay->short); ?>_total" name="days[<?php echo e($weekDay->short); ?>][total][total]">
        </div>
    </div>
    <!-- End Total day -->
</div>
