<?php
$title = "View Apartment";
$subtitle = "View information about this apartment.";
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
@include('page-header',['title' => "Apartments",'subtitle' => "View Apartment"])
@stop

@section('content')
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
										  <a href="{{$au}}">
										   <div class="form-group">
                                               <label>Apartment</label>
                                               <div class="form-control hover">
										         <img class="rounded-circle mr-3 mb-3" src="{{$imgs[0]}}" alt="{{$name}}" style="width: 100px; height: 100px;"/><br>
												 {{$name}}
										       </div>
                                            </div>
										    </a>
										 </div>
										 <div class="col-md-6">
										 <a href="{{$uu}}">
										  <div class="form-group">
                                             <label>Host</label>
                                             <div class="form-control hover">
										       <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$hname}}" style="width: 100px; height: 100px;"/><br>
											   {{$hname}} 
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
                                                  <p class="form-control-plaintext">{{$apartment['apartment_id']}}</p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Name</label>
                                                  <p class="form-control-plaintext">{{$name}}</p>
                                                </div>
										     </div>
										  </div>
										  <div class="row mb-3">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Amount</label>
                                                  <p class="form-control-plaintext">&#8358;{{number_format($adata['amount'],2)}}</p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Description</label>
                                                  <p class="form-control-plaintext">{!! $adata['description'] !!}</p>
                                                </div>
										     </div>
										  </div>
										  <div class="row">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Availability</label>
                                                  <p class="form-control-plaintext">{{$apartment['avb']}}</p>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label>Status</label>
                                                  <p class="form-control-plaintext"><span class="label label-primary">{{$apartment['status']}}</span></p>
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
@stop