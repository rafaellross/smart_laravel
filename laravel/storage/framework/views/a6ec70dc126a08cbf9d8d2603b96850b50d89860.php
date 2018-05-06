<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
		<input class="form-control form-control-lg" type="text" placeholder="Search Employee" id="search">
		</div>
		<div class="row">
		<button type="button" class="btn btn-info btn-lg btn-block" id="btnSearch">Search</button>
		</div>
		<hr>
		<div id="employee" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"></div>				
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>