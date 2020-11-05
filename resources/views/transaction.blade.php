<?php
$title = "View Transaction";
$subtitle = "View information about this transaction.";
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
							<?php
							 $guest = $t['guest'];
										  $avatar = $guest['avatar'];
                                         
										 if($avatar == "") $avatar = [asset("images/avatar.png")];
										  $gname = $guest['fname']." ".$guest['lname'];
										
										  $i = $t['item'];
										  $ref = $i['order_id'];
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
							?>
                                <h5 class="card-header">Transaction Details</h5>
                                <div class="card-body">
                                    <form action="javascript:void(0)" id="t-form">
									    <div class="row">
										
										<div class="col-md-4 row">
										 <div class="col-md-6">
										 <a href="javascript:void(0)">
										  <div class="form-group">
                                             <label>Guest</label>
                                             <div class="form-control hover">
										       <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$gname}}" style="width: 100px; height: 100px;"/><br>
											   {{$gname}} 
										     </div>
                                           </div>
										   </a>
										 </div>
										 <div class="col-md-6">
										  <a href="javascript:void(0)">
										   <div class="form-group">
                                               <label>Apartment</label>
                                               <div class="form-control hover">
										         <img class="rounded-circle mr-3 mb-3" src="{{$temp['imgs'][0]}}" alt="{{$temp['name']}}" style="width: 100px; height: 100px;"/><br>
												 {{$temp['name']}}
										       </div>
                                            </div>
										    </a>
										 </div>
										</div>
										<div class="col-md-8">
										  <div class="row">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-email">Email address</label>
                                                  <input type="text" value="" placeholder="Enter email address" class="form-control" readonly>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-phone">Phone number</label>
                                                  <input type="text" value="" placeholder="Enter phone number" class="form-control" readonly>
                                                </div>
										     </div>
										  </div>
										  <div class="row">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-email">Email address</label>
                                                  <input type="text" value="" placeholder="Enter email address" class="form-control" readonly>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-phone">Phone number</label>
                                                  <input type="text" value="" placeholder="Enter phone number" class="form-control" readonly>
                                                </div>
										     </div>
										  </div>
										  <div class="row">
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-email">Email address</label>
                                                  <input type="text" value="" placeholder="Enter email address" class="form-control" readonly>
                                                </div>
										     </div>
										     <div class="col-md-6">
										        <div class="form-group">
                                                  <label for="user-phone">Phone number</label>
                                                  <input type="text" value="" placeholder="Enter phone number" class="form-control" readonly>
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