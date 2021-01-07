<?php
$title = "Post Apartment";
$subtitle = "Post a new apartment to the system.";
?>

@extends('layout')

@section('title',$title)


@section('page-header')
@include('page-header',['title' => "Apartments",'subtitle' => $title])
@stop


@section('content')
<div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
     <div class="card">
        <h4 class="card-header">{{$subtitle}}</h4>
        <div class="card-body">
          <form action="{{url('add-banner')}}" id="pa-form" method="post" enctype="multipart/form-data">
		     <input type="hidden" id="tk-pa" value="{{csrf_token()}}"/>
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
					  <option value="{{$v}}">{{$k}}</option>
					  <?php
					  }
					  ?>
					</select>
				  </div>
				</div>
			 </div>
          </form>
        </div>
     </div>
   </div>
</div>
@stop