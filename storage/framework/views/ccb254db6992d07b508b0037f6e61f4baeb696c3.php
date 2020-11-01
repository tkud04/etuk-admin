<?php
$title = "Dashboard";
$subtitle = "Admin dashboard";
?>



<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="text-center">Content goes here!</h3>
                    </div>
</div>			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/index.blade.php ENDPATH**/ ?>