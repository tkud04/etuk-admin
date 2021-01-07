<?php
$title = "Post Apartment";
$subtitle = "Post a new apartment to the system.";
?>



<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('page-header'); ?>
<?php echo $__env->make('page-header',['title' => "Apartments",'subtitle' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<script>
let selectedSide = "1", facilities = [], aptImages = [], aptImgCount = 1, aptCover = "none";              
  
$(document).ready(() => {
$('#pa-loading').hide();
let postApartmentDescriptionEditor = new Simditor({
		textarea: $('#pa-description'),
		toolbar: toolbar,
		placeholder: `Enter description here`
	});	
});

</script>
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
					  <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-12">
				  <div class="form-group">
                    <h4>Description<span class="req">*</span></h4>
                    <textarea class="form-control" id="pa-description"></textarea>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Category<span class="req">*</span></h4>
                    <select class="form-control" id="pa-category">
					  <option value="none">Select category</option>
					  <?php
					  $opts4 = [
								'studio' => "Studio",
												    '1bed' => "1 bedroom",
												    '2bed' => "2 bedrooms",
												    '3bed' => "3 bedrooms",
												    'penthouse' => "Penthouse apartment",
					  ];
					   foreach($opts4 as $k => $v)
					   {
					  ?>
					  <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>Property type<span class="req">*</span></h4>
                    <select class="form-control" id="pa-ptype">
					  <option value="none">Select property type</option>
					  <?php
					  $opts5 = [
								'unfurnished' => "Unfurnished apartment",
												    'Furnished' => "Furnished apartment",
												    'serviced' => "Serviced apartment",
					  ];
					   foreach($opts5 as $k => $v)
					   {
					  ?>
					  <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>No. of rooms<span class="req">*</span></h4>
                    <select class="form-control" id="pa-rooms">
					  <option value="none">Select no. of rooms</option>
					  <?php
					   for($i = 0; $i < 5; $i++)
					   {
						   $rr = $i == 0 ? "room" : "rooms";
					  ?>
					  <option value="<?php echo e($i + 1); ?>"><?php echo e($i + 1); ?> <?php echo e($rr); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>No. of units<span class="req">*</span></h4>
                    <select class="form-control" id="pa-units">
					  <option value="none">Select no. of units</option>
					  <?php
					  for($i = 0; $i < 5; $i++)
					   {
						   $rr = $i == 0 ? "unit" : "units";
					  ?>
					  <option value="<?php echo e($i + 1); ?>"><?php echo e($i + 1); ?> <?php echo e($rr); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>No. of bathrooms<span class="req">*</span></h4>
                    <select class="form-control" id="pa-bathrooms">
					  <option value="none">Select no. of bathrooms</option>
					  <?php
					  for($i = 0; $i < 5; $i++)
					   {
						   $rr = $i == 0 ? "bathroom" : "bathrooms";
					  ?>
					  <option value="<?php echo e($i + 1); ?>"><?php echo e($i + 1); ?> <?php echo e($rr); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
                    <h4>No. of bedrooms<span class="req">*</span></h4>
                    <select class="form-control" id="pa-bedrooms">
					  <option value="none">Select no. of bedrooms</option>
					  <?php
					  for($i = 0; $i < 5; $i++)
					   {
						   $rr = $i == 0 ? "bedhroom" : "bedhrooms";
					  ?>
					  <option value="<?php echo e($i + 1); ?>"><?php echo e($i + 1); ?> <?php echo e($rr); ?></option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
				<div class="col-sm-12 pl-0">
                   <p class="text-center">
                      <button class="btn btn-space btn-secondary" id="pa-side-1-next">Next</button>
                   </p>
                </div>
			 </div>
          </form>
        </div>
     </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/add-apartment.blade.php ENDPATH**/ ?>