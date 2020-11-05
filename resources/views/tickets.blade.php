<?php
$title = "Tickets";
$subtitle = "View all support tickets raised on the platform.";
$pu = url('add-ticket');
?>

@extends('layout')

@section('title',$title)

@section('scripts')
  <!-- DataTables CSS -->
  <link href="{{asset('lib/datatables/css/buttons.bootstrap.min.css')}}" rel="stylesheet" /> 
  <link href="{{asset('lib/datatables/css/buttons.dataTables.min.css')}}" rel="stylesheet" /> 
  <link href="{{asset('lib/datatables/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" /> 
  
      <!-- DataTables js -->
       <script src="{{asset('lib/datatables/js/datatables.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('lib/datatables/js/datatables-init.js')}}"></script>
@stop

@section('page-header')
@include('page-header',['title' => "Tickets",'subtitle' => $title])
@stop

@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Tickets</h5>
							<a href="{{$pu}}" class="btn btn-outline-secondary">Add ticket</a>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                <th>Ticket ID</th>
                                                <th>Raised by</th>
                                                <th>Subject</th>
                                                <th>Apartment</th>
                                                <th>Date raised</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
									    if(count($tickets) > 0)
										{
										  foreach($tickets as $t)
										   {
											   $vu = url('ticket')."?xf=".$t['ticket_id'];
											   $ru = url('remove-ticket')."?xf=".$t['ticket_id'];
											   
											    $guest = $t['user'];
										        $avatar = $guest['avatar'];
                                         
										        if($avatar == "") $avatar = [asset("images/avatar.png")];
										        $gname = $guest['fname']." ".$guest['lname'];
										        $uu = url('user')."?xf=".$guest['email'];
												
												$temp = [];
														 $apartment = $t['apartment'];
														 $au = url('apartment')."?xf=".$apartment['apartment_id'];
														 $temp['name'] = $apartment['name'];
														 $cmedia = $apartment['cmedia'];
														 $temp['imgs'] = $cmedia['images'];
									   ?>
                                            <tr>
                                                <td>{{$t['ticket_id']}}</td>
                                                <td>
												  <a href="{{$uu}}">
												   <div class="form-control hover">
										             <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$gname}}" style="width: 100px; height: 100px;"/><br>
											         {{$gname}} 
										           </div>
												  </a>
												</td>
                                                <td>{{$t['subject']}}</td>
												<td>
												 <a href="{{$au}}">
												   <div class="form-control hover">
										             <img class="rounded-circle mr-3 mb-3" src="{{$temp['imgs'][0]}}" alt="{{$temp['name']}}" style="width: 100px; height: 100px;"/><br>
												     {{$temp['name']}}
										           </div>
												 </a>
												</td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="{{$uu}}">View</a>
												 <a class="btn btn-danger btn-sm" href="{{$ru}}">Remove</a>
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
<div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="card">
                            <h5 class="card-header">Apartments</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                <th>Apartment</th>
                                                <th>Location</th>
                                                <th>Rating</th>
                                                <th>Date added</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
									    if(count($apts) > 0)
										{
										  foreach($apts as $a)
										   {
											   $statusClass = "danger";
											   $name = $a['name'];
											   $address = $a['address'];
											   #$reviews = $a['reviews'];
											   $uu = url('apartment')."?xf=".$a['apartment_id'];
											    $sss = $a['status'];
												
												if($a['status'] == "enabled")
												{
													$statusClass = "success";
													$sss = "approved";
												}
											   $imgs = $a['cmedia']['images'];
											   
									   ?>
                                            <tr>
                                                <td>
												  <img class="img-fluid" onclick="window.location='{{$uu}}'" src="{{$imgs[0]}}" alt="{{$name}}" style="cursor: pointer; width: 100px; height: 100px;"/>
												  <a href="{{$uu}}"><h4>{{ucwords($name)}}</h4></a><br>							  
												</td>
                                                <td>{{ucwords($address['address'].",")}}<br>{{ucwords($address['city'].", ".$address['state'])}}</td>
                                                <td>
												@for($i = 0; $i < $a['rating']; $i++)
												  <i class="fas fa-star"></i>
											    @endfor
												&nbsp;({{count($a['reviews'])}} reviews)
												</td>
                                                <td>{{$a['date']}}</td>
                                                <td><span class="label label-{{$statusClass}}">{{strtoupper($sss)}}</td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="{{$uu}}">View</a>
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
                                                <th>Apartment</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Date Added</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										  <?php
										   if(count($reviews) > 0)
										   {
											  foreach($reviews as $r)
											   {
												   $a = $r['apartment'];
						     			        $statusClass = "danger";
											   $name = $a['name'];
											   $uu = url('apartment')."?xf=".$a['apartment_id'];
											    $sss = $r['status'];
												
												if($sss == "approved")
												{
													$statusClass = "success";
												}
											   $imgs = $a['cmedia']['images'];

												   
												   $ar = ($r['service'] + $r['location'] + $r['security'] + $r['cleanliness'] + $r['comfort']) / 5;
										  ?>
                                            <tr>
                                               <td>
												  <img class="img-fluid" onclick="window.location='{{$uu}}'" src="{{$imgs[0]}}" alt="{{$name}}" style="cursor: pointer; width: 100px; height: 100px;"/>
												  <a href="{{$uu}}"><h4>{{ucwords($name)}}</h4></a><br>							  
												</td>
												<td>
												  <h3>
												   @for($i = 0; $i < $ar; $i++)
												     <i class="fas fa-star"></i>
											       @endfor
												  </h3>
												  <ul>
												    <li>Service: <b>{{$r['service']}}</b></li>
												    <li>Location: <b>{{$r['location']}}</b></li>
												    <li>Security: <b>{{$r['security']}}</b></li>
												    <li>Cleanliness: <b>{{$r['cleanliness']}}</b></li>
												    <li>Comfort: <b>{{$r['comfort']}}</b></li>
												  </ul>							  
												</td>
                                                <td><em>{{$r['comment']}}</em></td>
                                                <td>{{$r['date']}}</td>
                                                <td><span class="label label-{{$statusClass}}">{{strtoupper($r['status'])}}</td>
                                                
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
@stop