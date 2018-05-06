<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a href="<?php echo e(URL::to('/timesheets')); ?>" class="list-group-item list-group-item-action ">Time Sheet</a>            
                    <a href="<?php echo e(URL::to('/employee_application')); ?>" class="list-group-item list-group-item-action " style="display: none;">Employee Application</a>            
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>