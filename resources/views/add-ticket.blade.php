<?php
$title = "Add Ticket";
$subtitle = "Raise a new support ticket.";
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
@include('page-header',['title' => "Add Ticket",'subtitle' => $title])
@stop

@section('content')
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Add Ticket</h5>
                                <div class="card-body">
                                    <form action="{{url('add-ticket')}}" id="add-ticket-form" method="post">
										{!! csrf_field() !!}
										<div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-fname">First Name</label>
                                            <input id="user-fname" type="text" name="fname" value="{{$u['fname']}}" placeholder="Enter first name" class="form-control">
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-lname">Last Name</label>
                                            <input id="user-lname" type="text" name="lname" value="{{$u['lname']}}" placeholder="Enter last name" class="form-control">
                                        </div>
										</div>
										</div>
										<div class="row">
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-email">Email address</label>
                                            <input id="user-email" type="email" name="email" value="{{$u['email']}}" placeholder="Enter email address" class="form-control" readonly>
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="user-phone">Phone number</label>
                                            <input id="user-phone" type="number" name="phone" value="{{$u['phone']}}" placeholder="Enter phone number" class="form-control">
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
                                            <label for="user-status">Status</label>
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
@stop