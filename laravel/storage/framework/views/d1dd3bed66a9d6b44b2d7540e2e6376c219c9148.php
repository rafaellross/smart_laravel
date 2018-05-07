<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 style="text-align: center;">Time Sheet</h2>
    <hr>
    <div class="col-md-12 col-lg-12 col-12">           
        <a href="<?php echo e(URL::to('/timesheets/select')); ?>" class="btn btn-primary">Create New</a>            
        <button class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</button>
        <button class="btn btn-info mobile" id="btnPrint" style="">Print Selected(s)</button>            
        <button class="btn btn-secondary mobile" id="btnStatus" style="">Change Status</button>            
        <div style="float: right;" id="statusSelect">
            <select class="custom-select mb-4" id="selectStatus">
                <option selected="">Status...</option>
                <option value="all">All</option>
                <option value="A">Approved</option>        
                <option value="F">Finalised</option>        
                <option value="P">Pending</option>
                <option value="C">Cancelled</option>
            </select>            

        </div>    
    </div>
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col" class="mobile"><input type="checkbox" id="chkRow"></th>    
                <th scope="col" class="mobile">#</th>
                <th scope="col">User</th>
                <th scope="col" class="mobile">Date</th>

                <th scope="col">Employee</th><th scope="col">Week End</th><th scope="col">Status</th>      <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $timesheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            </tr><tr class="P"><th class="mobile"><input type="checkbox" id="chkRow-<?php echo e($timesheet->id); ?>"></th><th class="mobile" scope="row"><?php echo e($timesheet->id); ?></th>
                <td><?php echo e($timesheet->user->username); ?></td>
                <td class="mobile"><?php echo e(Carbon::parse($timesheet->created_at)->format('d/m/Y')); ?></td>
                <td><?php echo e($timesheet->employee->name); ?></td>
                <td><?php echo e(Carbon::parse($timesheet->week_end)->format('d/m/Y')); ?></td>
                <td><?php echo e($timesheet->status); ?></td><td style="text-align: center;">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="timesheets/action/<?php echo e($timesheet->id); ?>/print" target="_blank">View</a>
                            <a class="dropdown-item" href="timesheets/<?php echo e($timesheet->id); ?>/edit">Edit</a>
                            <a class="dropdown-item delete" id="<?php echo e($timesheet->id); ?>" href="#">Delete</a>                                                
                        </div>
                    </div>        
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalChangeStatus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select new status:</label>
            <select class="form-control" name="changeStatus">
                <option value="P">Pending</option>
                <option value="A">Approved</option>
                <option value="F">Finalised</option>        
                <option value="C">Cancelled</option>
            </select>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSaveStatus">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>