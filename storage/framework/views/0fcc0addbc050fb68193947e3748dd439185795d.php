<?php
$title = "Post Apartment";
$subtitle = "Post a new apartment to the system.";
?>



<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('page-header'); ?>
<?php echo $__env->make('page-header',['title' => "Apartments",'subtitle' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
     <div class="card">
        <h4 class="card-header"><?php echo e($subtitle); ?></h4>
        <div class="card-body">
          <form action="<?php echo e(url('add-banner')); ?>" id="pa-form" method="post" enctype="multipart/form-data">
		     <input type="hidden" id="tk-pa" value="<?php echo e(csrf_token()); ?>"/>
			 <div class="row" id="pa-side-1">
			    <div class="col-md-12">
				  <h3><span class="label label-primary">Basic Information</span></h3>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Apartment ID<span class="req">*</span></h4>
                    <p class="form-control-plaintext">Will be genereated</p>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Friendly URL<span class="req">*</span></h4>
                    <input type="text" class="form-control" id="pa-url" placeholder="Friendly URL e.g my-apartment"/>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Friendly Name<span class="req">*</span></h4>
                    <input type="text" class="form-control" id="pa-name" placeholder="Give your apartment a name e.g L Lodge"/>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Price per day<span class="req">*</span></h4>
                    <input type="number" class="form-control" id="pa-amount" placeholder="Enter price in NGN"/>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Max no. of guests<span class="req">*</span></h4>
                    <input type="number" class="form-control" id="pa-max-adults" placeholder="The max amount of guests allowed to check-in"/>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Pets<span class="req">*</span></h4>
                    <select class="form-control" id="pa-pets">
					  <option value="none">Are pets allowed?</option>
					  <?php
					  $opts3 = [
								 'no' => "No",
								 'yes' => "Yes"
					  ];
					   foreach($opts3 as $k => $v)
					   {
					  ?>
					  <option value="<?php echo e($v); ?>"><?php echo e($k); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
			 </div>
          </form>
        </div>
     </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/add-apartment.blade.php ENDPATH**/ ?>