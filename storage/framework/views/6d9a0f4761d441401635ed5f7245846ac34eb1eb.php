<?php
$title = $u['fname']." ".$u['lname'];
$subtitle = "View information about this user.";
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
<?php echo $__env->make('page-header',['title' => "Users",'subtitle' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Personal Information</h5>
                                <div class="card-body">
                                    <form action="#" id="basicform" data-parsley-validate="" novalidate="">
                                        <div class="form-group">
                                            <label for="inputUserName">User Name</label>
                                            <input id="inputUserName" type="text" name="name" data-parsley-trigger="change" required="" placeholder="Enter user name" autocomplete="off" class="form-control parsley-error" data-parsley-id="14" aria-describedby="parsley-id-14"><ul class="parsley-errors-list filled" id="parsley-id-14"><li class="parsley-required">This value is required.</li></ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Email address</label>
                                            <input id="inputEmail" type="email" name="email" data-parsley-trigger="change" required="" placeholder="Enter email" autocomplete="off" class="form-control parsley-error" data-parsley-id="16" aria-describedby="parsley-id-16"><ul class="parsley-errors-list filled" id="parsley-id-16"><li class="parsley-required">This value is required.</li></ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword">Password</label>
                                            <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control parsley-error" data-parsley-id="18" aria-describedby="parsley-id-18"><ul class="parsley-errors-list filled" id="parsley-id-18"><li class="parsley-required">This value is required.</li></ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRepeatPassword">Repeat Password</label>
                                            <input id="inputRepeatPassword" data-parsley-equalto="#inputPassword" type="password" required="" placeholder="Password" class="form-control parsley-error" data-parsley-id="20" aria-describedby="parsley-id-20"><ul class="parsley-errors-list filled" id="parsley-id-20"><li class="parsley-required">This value is required.</li></ul>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"><span class="custom-control-label">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
</div>
<div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="card">
                            <h5 class="card-header">Basic Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Date Joined</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										  <?php
										   if(count($users) > 0)
										   {
											  foreach($users as $u)
											   {
												   $vu = url('user')."?xf=".$u['email'];
												   $statusClass = "danger";
												   $du = url('enable-user')."?xf=".$u['id'];
												   $duText = "Enable user";
												   $duClass = "success";
												   
												   if($u['status'] == "enabled")
												   {
													   $statusClass = "success";
													   $du = url('disable-user')."?xf=".$u['id'];
													   $duText = "Disable user";
												       $duClass = "danger";
												   }
										  ?>
                                            <tr>
                                                <td><?php echo e(ucwords($u['fname']." ".$u['lname'])); ?></td>
                                                <td><?php echo e($u['email']); ?></td>
                                                <td><?php echo e(ucwords($u['role'])); ?></td>
                                                <td><?php echo e($u['date']); ?></td>
                                                <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($u['status'])); ?></td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="<?php echo e($vu); ?>">View</a>
												 <a class="btn btn-<?php echo e($duClass); ?> btn-sm" href="<?php echo e($du); ?>"><?php echo e($duText); ?></a>
												</td>
                                            </tr>
									     <?php
											   }
										   }
										 ?>
									   </tbody>
									</table>
							    </div>
							 </div>
						</div>
                    </div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="card">
                            <h5 class="card-header">Basic Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Date Joined</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										  <?php
										   if(count($users) > 0)
										   {
											  foreach($users as $u)
											   {
												   $vu = url('user')."?xf=".$u['email'];
												   $statusClass = "danger";
												   $du = url('enable-user')."?xf=".$u['id'];
												   $duText = "Enable user";
												   $duClass = "success";
												   
												   if($u['status'] == "enabled")
												   {
													   $statusClass = "success";
													   $du = url('disable-user')."?xf=".$u['id'];
													   $duText = "Disable user";
												       $duClass = "danger";
												   }
										  ?>
                                            <tr>
                                                <td><?php echo e(ucwords($u['fname']." ".$u['lname'])); ?></td>
                                                <td><?php echo e($u['email']); ?></td>
                                                <td><?php echo e(ucwords($u['role'])); ?></td>
                                                <td><?php echo e($u['date']); ?></td>
                                                <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($u['status'])); ?></td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="<?php echo e($vu); ?>">View</a>
												 <a class="btn btn-<?php echo e($duClass); ?> btn-sm" href="<?php echo e($du); ?>"><?php echo e($duText); ?></a>
												</td>
                                            </tr>
									     <?php
											   }
										   }
										 ?>
									   </tbody>
									</table>
							    </div>
							 </div>
						</div>
                    </div>
                </div>			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/user.blade.php ENDPATH**/ ?>