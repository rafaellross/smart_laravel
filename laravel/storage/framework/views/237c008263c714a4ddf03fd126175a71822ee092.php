<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 style="text-align: center;">Employees Applications</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="<?php echo e(URL::to('/employee_application/create')); ?>" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>      
                <th scope="col">E-mail</th>
                <th scope="col">Mobile</th>
            </tr>
        </thead>
        <tbody>            
    <?php $__currentLoopData = $employee_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee_application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-<?php echo e($employee_application->id); ?>">
                        </th>
                        <td><?php echo e($employee_application->id); ?></td>
                        <td><?php echo e($employee_application->last_name); ?></td>
                        <td><?php echo e($employee_application->first_name); ?></td>
                        <td><?php echo e($employee_application->email); ?></td>
                        <td><?php echo e($employee_application->mobile); ?></td>
                        <td>
                        </td>

                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="employee_application/<?php echo e($employee_application->id); ?>">View</a>                    
                                    <a class="dropdown-item" href="employee_application/<?php echo e($employee_application->id); ?>/edit">Edit</a>                    
                                    <a class="dropdown-item delete" id="<?php echo e($employee_application->id); ?>" href="#">Delete</a>
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