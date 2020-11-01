<?php
$title = $u['fname']." ".$u['lname'];
$subtitle = "View information about this user.";
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
@include('page-header',['title' => "Users",'subtitle' => $title])
@stop

@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Personal Information</h5>
                                <div class="card-body">
                                    <form action="{{url('user')}}" id="user-form" method="post">
										{!! csrf_field() !!}
										<input type="hidden" name="xf" value="{{$u['id']}}"/>
                                        <div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-fname">First Name</label>
                                            <input id="user-fname" type="text" name="fname" value="{{$user['fname']}}" placeholder="Enter first name" class="form-control">
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-lname">Last Name</label>
                                            <input id="user-lname" type="text" name="lname" value="{{$user['lname']}}" placeholder="Enter last name" class="form-control">
                                        </div>
										</div>
										</div>
										<div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-email">Email address</label>
                                            <input id="user-email" type="email" name="email" value="{{$user['email']}}" placeholder="Enter email address" class="form-control">
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-email">Email address</label>
                                            <input id="user-email" type="email" name="email" value="{{$user['email']}}" placeholder="Enter email address" class="form-control">
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
											 <option value="{{$r}}"{{$ss}}>{{ucwords($rr)}}</option>
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
											 <option value="{{$s}}"{{$ss}}>{{ucwords($sss)}}</option>
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
                                                   <span class="custom-control-label">Last updated: <em>{{$u['updated']}}</em></span>
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
                                                <td>{{ucwords($u['fname']." ".$u['lname'])}}</td>
                                                <td>{{$u['email']}}</td>
                                                <td>{{ucwords($u['role'])}}</td>
                                                <td>{{$u['date']}}</td>
                                                <td><span class="label label-{{$statusClass}}">{{strtoupper($u['status'])}}</td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="{{$vu}}">View</a>
												 <a class="btn btn-{{$duClass}} btn-sm" href="{{$du}}">{{$duText}}</a>
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
                                                <td>{{ucwords($u['fname']." ".$u['lname'])}}</td>
                                                <td>{{$u['email']}}</td>
                                                <td>{{ucwords($u['role'])}}</td>
                                                <td>{{$u['date']}}</td>
                                                <td><span class="label label-{{$statusClass}}">{{strtoupper($u['status'])}}</td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="{{$vu}}">View</a>
												 <a class="btn btn-{{$duClass}} btn-sm" href="{{$du}}">{{$duText}}</a>
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
@stop