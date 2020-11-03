<?php
$title = "Dashboard";
$subtitle = "Admin dashboard";
?>



<?php $__env->startSection('scripts'); ?>
<link href="<?php echo e(asset('lib/morris-bundle/morris.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('lib/morris-bundle/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('lib/morris-bundle/morris.js')); ?>"></script>
<script src="<?php echo e(asset('lib/morris-bundle/morris-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('content'); ?>
 <div class="ecommerce-widget">

                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Revenue</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">&#8358;12,000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Affiliate Revenue</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">&#8358;12,000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue2"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Refunds</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">&#8358;0.00</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                            <span>N/A</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Avg. Revenue Per User</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">&#8358;28,000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                            <span>-2.00%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>
                        </div>
                        
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="row">
							<div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Orders</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Reference</th>
                                                        <th class="border-0">Details</th>
                                                        <th class="border-0">Status</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
									   if(count($orders) > 0)
									   {
										   $ordersLength = count($orders) > 5 ? 5 : count($orders);
									    for($ctr = 0; $ctr < $ordersLength; $ctr++)
										{
											$o = $orders[$ctr];
										  $ref = $o['reference'];
										  $ru = url('receipt')."?xf=".$ref;
										  $cu = "javascript:void(0)";
										  $s = ""; $liClass = ""; $ps = "";
										  
										  if($o['status'] == "paid")
										  {
											  $liClass = "approved-booking";
											  $s = "Active";									
										  }
										  else if($o['status'] == "expired")
										  {
											  $liClass = "pending-booking";
											  $s = "Expired";
											  $ps = " pending";
										  }
										  else if($o['status'] == "cancelled")
										  {
											  $liClass = "canceled-booking";
											  $s = "Cancelled";
										  }
										  
										  $items = $o['items'];
										  $ii = $items['data'];
										  $subtotal = $items['subtotal'];
										  $bookingDetails = [];
										  
										  foreach($ii as $i)
										  {
											            $temp = [];
														 $apartment = $i['apartment'];
														 $temp['au'] = $apartment['url'];
														 $temp['name'] = $apartment['name'];
														 $cmedia = $apartment['cmedia'];
														 $temp['imgs'] = $cmedia['images'];
														 $adata = $apartment['data'];
														 $temp['terms'] = $apartment['terms'];
														 $host = $apartment['host'];
														 $temp['hostName'] = $host['fname']." ".substr($host['lname'],0,1).".";
														 $temp['amount'] = $adata['amount'];
														 $address = $apartment['address'];
														 $temp['location'] = $address['city'].", ".$address['state'];
														 $temp['checkin'] = $i['checkin'];
														 $temp['checkout'] = $i['checkout'];
														 $temp['guests'] = $i['guests'];
														 $temp['kids'] = $i['kids'];
														 array_push($bookingDetails,$temp);
										  }			 
											  
									   ?>
                                                    <tr>
                                                        <td><?php echo e($ctr); ?></td>
                                                        <td><?php echo e($ref); ?></td>
                                                        <td>
														   <div class="card" style="overflow-y: scroll;">
                                <h5 class="card-header">Items</h5>
                                <div class="card-body">
                                    <div class="list-group">
									   <?php
									    for($iiCtr = 0; $iiCtr < count($ii); $iiCtr++)
										{
											$i = $bookingDetails[$iiCtr];
											$ll = ""; $sm = " class='text-muted'"; $tc = "";
											$iiu = "javascript:void(0)";
											
											if($iiCtr == 0)
											{
												$ll = " active";
											    $sm = "";
											    $tc = " text-white";
											}
											
											$imgs = $i['imgs'];
											
									   ?>
                                        <a href="<?php echo e($iiu); ?>" class="list-group-item list-group-item-action flex-column align-items-start<?php echo e($ll); ?>">
                                            <div class="d-flex w-100 justify-content-between">
											<img class="rounded-circle mr-3 mb-3" src="<?php echo e($imgs[0]); ?>" alt="<?php echo e($i['name']); ?>" style="width: 100px; height: 100px;"/>
											  <div>
                                                <h5 class="mb-1<?php echo e($tc); ?>"><?php echo e($i['name']); ?></h5>
                                                <small<?php echo e($sm); ?>><?php echo e($i['checkin']." - ".$i['checkout']); ?></small>
												
												<p class="mb-1">Adults: <?php echo e($i['guests']); ?> | Children: <?php echo e($i['kids']); ?></p>
                                            <small<?php echo e($sm); ?>>Price per night: &#8358;<?php echo e(number_format($i['amount'])); ?></small>
											  </div>
                                            </div>
                                            
                                        </a>
										<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
                                                            <div class="m-r-10"><img src="assets/images/product-pic.jpg" alt="user" class="rounded" width="45"></div>
                                                        </td>
                                                        <td><span class="badge-dot badge-success mr-1"></span>Active </td>
                                                    </tr>
                                        <?php
										 
										}
										}
										?>       
                                                    <tr>
                                                        <td colspan="9"><a href="<?php echo e(url('orders')); ?>" class="btn btn-outline-light float-right">View more</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->		
							
							<div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- top perfomimg  -->
                                <!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header">Top Performing Campaigns</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table no-wrap p-table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Campaign</th>
                                                        <th class="border-0">Visits</th>
                                                        <th class="border-0">Revenue</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Campaign#1</td>
                                                        <td>98,789 </td>
                                                        <td>$4563</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#2</td>
                                                        <td>2,789 </td>
                                                        <td>$325</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#3</td>
                                                        <td>1,459 </td>
                                                        <td>$225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#4</td>
                                                        <td>5,035 </td>
                                                        <td>$856</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a href="#" class="btn btn-outline-light float-right">Details</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end top perfomimg  -->
                                <!-- ============================================================== -->
							</div>
							</div>
							
							<div class="row">
                            <!-- ============================================================== -->
                            <!-- total revenue  -->
                            <!-- ============================================================== -->
  
                            
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- category revenue  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Revenue by Category</h5>
                                    <div class="card-body">
                                        <div id="morris_donut" style="height: 420px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end category revenue  -->
                            <!-- ============================================================== -->

                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Total Revenue</h5>
                                    <div class="card-body">
                                        <div id="morris_totalrevenue"></div>
                                    </div>
                                    <div class="card-footer">
                                        <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">&#8358;26,000</span><span class="text-success float-right">+9.45%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
							
							</div>
							
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-admin\resources\views/index.blade.php ENDPATH**/ ?>