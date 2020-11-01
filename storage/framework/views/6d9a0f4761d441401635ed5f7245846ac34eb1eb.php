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
                                    <form action="<?php echo e(url('user')); ?>" id="user-form" method="post">
										<?php echo csrf_field(); ?>

										<input type="hidden" name="xf" value="<?php echo e($u['id']); ?>"/>
                                        <div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-fname">First Name</label>
                                            <input id="user-fname" type="text" name="fname" value="<?php echo e($user['fname']); ?>" placeholder="Enter first name" class="form-control">
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-lname">Last Name</label>
                                            <input id="user-lname" type="text" name="lname" value="<?php echo e($user['lname']); ?>" placeholder="Enter last name" class="form-control">
                                        </div>
										</div>
										</div>
										<div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-email">Email address</label>
                                            <input id="user-email" type="email" name="email" value="<?php echo e($user['email']); ?>" placeholder="Enter email address" class="form-control">
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-email">Email address</label>
                                            <input id="user-email" type="email" name="email" value="<?php echo e($user['email']); ?>" placeholder="Enter email address" class="form-control">
                                        </div>
										</div>
										</div>
										<div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-role">Role</label>
											<?php
											 $roles = ['user','admin','su'];
											?>
											<select id="user-role" name="role" class="form-control">
											 <option value="none">Select role</option>
											 <?php
											  foreach($roles as $r)
											  {
												  $ss = $r == $u['role'] ? " selected='selected'" : "";
												  $rr = $r == "su" ? "super user" : $r;
											 ?>
											 <option value="<?php echo e($r); ?>"<?php echo e($ss); ?>><?php echo e(ucwords($rr)); ?></option>
											  <?php
											  }
											  ?>
											</select>
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-role">Status</label>
											<?php
											 $statuses = ['enabled','disabled'];
											?>
											<select id="user-status" name="status" class="form-control">
											 <option value="none">Select account status</option>
											 <?php
											  foreach($statuses as $s)
											  {
												  $ss = $s == $u['status'] ? " selected='selected'" : "";
												  $sss = $s == "enabled" ? "active" : $s;
											 ?>
											 <option value="<?php echo e($s); ?>"<?php echo e($ss); ?>><?php echo e(ucwords($sss)); ?></option>
											  <?php
											  }
											  ?>
											</select>
                                        </div>
										</div>
										</div>
										
                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                   <span class="custom-control-label">Last updated: <em><?php echo e($u['updated']); ?></em></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button class="btn btn-space btn-secondary" id="user-form-btn">Save</button>
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
                            <h5 class="card-header">Apartments</h5>
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
                            <h5 class="card-header">Reviews</h5>
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