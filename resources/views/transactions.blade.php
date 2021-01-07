<?php
$title = "Finance";
$subtitle = "View all transactions on the platform";
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
@include('page-header',['title' => $title,'subtitle' => $subtitle])
@stop

@section('content')
<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">{{$subtitle}}</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first etuk-table">
                                        <thead>
                                            <tr>
                                                <th>Reference #</th>
                                                <th>Guest</th>
                                                <th>Booking Details</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
									   if(count($transactions) > 0)
									   {
										for($d = 0; $d < count($transactions); $d++)
										{
											$t = $transactions[$d];
											$ll = ""; $sm = " class='text-muted'"; $tc = "";
											
											if($d == 0)
											{
												$ll = " active";
											    $sm = "";
											}
		
										  $vu = url('transaction')."?xf=".$t['id'];
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
                                            <tr>
                                                <td>{{$ref}}</td>
                                                <td>
												<center>
												   <img class="rounded-circle mr-3 mb-3" src="{{$avatar[0]}}" alt="{{$gname}}" style="width: 100px; height: 100px;"/><br>
														  {{$gname}} 
												</center>
												</td>
                                                <td>
												  <div class="d-flex w-100 ">
											<img class="rounded-circle mr-3 mb-3" src="{{$temp['imgs'][0]}}" alt="{{$temp['name']}}" style="width: 100px; height: 100px;"/>
											  <div>
                                                <h5 class="mb-1{{$tc}}">{{$temp['name']}}</h5>
                                                <small{{$sm}}>{{$temp['checkin']." - ".$temp['checkout']}}</small>
												
												<p class="mb-1">Adults: {{$temp['guests']}} | Children: {{$temp['kids']}}</p>
                                            <small{{$sm}}>Price per night: &#8358;{{number_format($temp['amount'])}}</small>
											  </div>
                                            </div>
												</td>
                                                <td>
												 <a class="btn btn-primary btn-sm" href="{{$vu}}">View</a>
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