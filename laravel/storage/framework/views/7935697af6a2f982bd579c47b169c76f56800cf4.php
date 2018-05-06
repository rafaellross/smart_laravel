<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 style="text-align: center;">Employees</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="<?php echo e(URL::to('/employees/create')); ?>" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>      
                <th scope="col">Time Sheet</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>            
    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr style="<?php echo e(is_null($employee->last_timesheet) ? 'background-color: red; color: white;' : ""); ?>">                    
                        <th>
                            <input type="checkbox" id="chkRow-<?php echo e($employee->id); ?>">
                        </th>
                        <td><?php echo e($employee->id); ?></td>
                        <td><?php echo e($employee->name); ?></td>
                        <td><?php echo e($employee->phone); ?></td>
                        <td>
                            <?php if(!is_null($employee->last_timesheet)): ?>
                                <a class="btn btn-success" href="timesheets/action/<?php echo e($employee->last_timesheet); ?>/print" role="button" target="_blank">View</a>
                            <?php else: ?>
                                <span>No Time Sheet this Week</span>    
                            <?php endif; ?>
                        </td>

                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="<?php echo e(action('EmployeeController@edit', $employee->id)); ?>">Edit</a>                    
                                    <a class="dropdown-item delete" id="<?php echo e($employee->id); ?>" href="#">Delete</
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