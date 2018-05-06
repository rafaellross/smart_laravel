<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Register Employee')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('jobs.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Code')); ?></label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control<?php echo e($errors->has('code') ? ' is-invalid' : ''); ?>" name="code" value="<?php echo e(old('code')); ?>" required autofocus>

                                <?php if($errors->has('code')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Description')); ?></label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>" name="description" value="<?php echo e(old('description')); ?>" required>
                                <?php if($errors->has('description')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Address')); ?></label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" name="address" value="<?php echo e(old('address')); ?>">
                                <?php if($errors->has('address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Create')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>