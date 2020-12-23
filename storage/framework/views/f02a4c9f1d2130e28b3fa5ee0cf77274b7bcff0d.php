<?php
$title = "View Apartment";
$subtitle = "View information about this apartment.";
?>



<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('scripts'); ?>
  <!-- DataTables CSS -->
  <link href="<?php echo e(asset('lib/datatables/css/buttons.bootstrap.min.css')); ?>" rel="stylesheet" /> 
  <link href="<?php echo e(asset('lib/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet" /> 
  <link href="<?php echo e(asset('lib/datatables/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet" /> 
  
      <!-- DataTables js -->
       <script src="<?php echo e(asset('lib/datatables/js/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/datatables/js/datatables-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<?php echo $__env->make('page-header',['title' => "Apartments",'subtitle' => "View Apartment"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
							<?php
														 $au = url('apartment')."?xf=".$apartment['apartment_id'];
														 $name = $apartment['name'];
														 $cmedia = $apartment['cmedia'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $terms = $apartment['terms'];
														 $host = $apartment['host'];
														 $avatar = $host['avatar'];
                                                  if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $hname = $host['fname']." ".$host['lname'];
										  $uu = url('user')."?xf=".$host['email'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 
							?>
                                <h5 class="card-header">Details</h5>
                                <div class="card-body">
                                    <form action="javascript:void(0)" id="t-form">
									    <div class="row">
										
										<div class="col-md-4 row">
										 <div class="col-md-6">
										  <a href="<?php echo e($au); ?>">
										   <div class="form-group">
                                               <label>Apartment</label>
                                               <div class="form-control hover">
										         <img class="rounded-circle mr-3 mb-3" src="<?php echo e($imgs[0]); ?>" alt="<?php echo e($name); ?>" style="width: 100px; height: 100px;"/><br>
												 <?php echo e($name); ?>

										       </div>
                                            </div>
										    </a>
										 </div>
										 <div class="col-md-6">
										 <a href="<?php echo e($uu); ?>">
										  <div class="form-group">
                                             <label>Host</label>
                                             <div class="form-control hover">
										       <img class="rounded-circle mr-3 mb-3" src="<?php echo e($avatar[0]); ?>" alt="<?php echo e($hname); ?>" style="width: 100px; height: 100px;"/><br>
											   <?php echo e($hname); ?> 
										     </div>
                                           </div>
										   </a>
										 </div>
										 
										</div>
										<div class="col-md-8">
										  <div class="row mb-3">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Apartment ID</label>
                                                  <p class="form-control-plaintext"><?php echo e($apartment['apartment_id']); ?></p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Name</label>
                                                  <p class="form-control-plaintext"><?php echo e($name); ?></p>
                                                </div>
										     </div>
										  </div>
										  <div class="row mb-3">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Amount</label>
                                                  <p class="form-control-plaintext">&#8358;<?php echo e(number_format($adata['amount'],2)); ?></p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Description</label>
                                                  <p class="form-control-plaintext"><?php echo $adata['description']; ?></p>
                                                </div>
										     </div>
										  </div>
										  <div class="row">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Availability</label>
                                                  <p class="form-control-plaintext"><?php echo e($apartment['avb']); ?></p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Status</label>
                                                  <p class="form-control-plaintext"><span class="label label-primary"><?php echo e($apartment['status']); ?></span></p>
                                                </div>
										     </div>
										  </div>
										 
										</div>
										
										</div>
										
										

                                    </form>
                                </div>
                            </div>
                        </div>
</div>			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/apartment.blade.php ENDPATH**/ ?>