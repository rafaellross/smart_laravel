<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 style="text-align: center;">Users</h2>
    <hr/>
    <div class="form-group row">
        <div class="col-md-12 col-lg-12 col-12">                 
            <a href="<?php echo e(URL::to('/users/create')); ?>" class="btn btn-primary">Create New</a>                
            <a href="#" class="btn btn-danger mobile" id="btnDelete">Delete Selected(s)</a>
        </div>

    </div> 
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="chkRow"></th>          
                <th scope="col">User</th>
                <th scope="col">Date Created</th>
                <th scope="col">Administrator</th>      
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>            
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>                    
                        <th>
                            <input type="checkbox" id="chkRow-<?php echo e($user->id); ?>">
                        </th>
                        <td><?php echo e($user->username); ?></td>
                        
                        <td><?php echo e(Carbon\Carbon::parse($user->created_at)->format('d/m/Y')); ?></td>

                        <td><?php echo e($user->administrator ? "Yes" : "No"); ?></td>
                        <td style="text-align: center;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/users/<?php echo e($user->id); ?>/edit">Edit</a>                    
                                    <form action="<?php echo e(action('UserController@destroy', $user->id)); ?>" method="post">
                                        <?php echo e(csrf_field()); ?>

                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="dropdown-item" type="submit">Delete</button>
                                     </form>                                                                        
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