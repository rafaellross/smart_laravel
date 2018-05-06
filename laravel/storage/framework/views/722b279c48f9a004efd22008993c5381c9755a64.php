<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 style="text-align: center;">Jobs</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="<?php echo e(URL::to('/jobs/create')); ?>" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>                          
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Description</th>      
                <th scope="col">Address</th>                
            </tr>
        </thead>
        <tbody>            
    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-<?php echo e($job->id); ?>">
                        </th>
                        <td><?php echo e($job->id); ?></td>
                        <td><?php echo e($job->code); ?></td>
                        <td><?php echo e($job->description); ?></td>
                        <td><?php echo e($job->address); ?></td>
                        <td></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="<?php echo e(action('JobController@edit', $job->id)); ?>">Edit</a>                    
                                    <a class="dropdown-item delete" id="<?php echo e($job->id); ?>" href="#">Delete</
                                </div>
                            </div>        
                        </td>                    
                  </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>