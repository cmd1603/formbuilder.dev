@extends('layouts.master')
@section('content')

<div class="row ph-title text-center">
	<img class="" src="/img/MultiCam.png">
</div>

<div class="full_width">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
				<a href="{{ url('configurations/create') }}" alt="Configuration">
					<img src="/img/config_copy2.png" alt="Create Home" class="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
				<p class="lead"><span class="strong" style="font-weight: 900">Create a Configuration</span> to be used as a Quote or Order.<a class="see_project" href="{{ url('configurations/create') }}" alt="Create Configuration">&nbsp;&nbsp;click here</a></p>
				<hr>
				<p class="categories_small"></p>
			</div>
		</div>
	</div>
</div>

<div class="white_bg">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
				<a href="{{ url('rule_ids/create') }}" alt="Rule">
					<img src="/img/rule_copy.png" alt="Rule" class="" style="border: 1px solid steelblue; border-width: thin">
				</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
				<p class="lead"><span class="strong" style="font-weight: 900">Create a Rule</span> or multiple rules for a given configuration.<a class="see_project" href="{{ url('rule_ids/create') }}" alt="">&nbsp;&nbsp;click here</a></p>
				<hr>
				<p class="categories_small"></p>
			</div>
		</div>
	</div>
</div>

<div class="full_width" style="margin-bottom: 65px">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
				<a href="{{ url('productaccess/create') }}" alt="Product">
					<img src="/img/dist_access_copy.png" alt="Create Dist Access" class="" style="border: 1px solid steelblue; border-width: thin">
				</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
				<p class="lead"><span class="strong" style="font-weight: 900">Create a Distributor Access</span> link to a Salesforce Product Code to specify form access.<a class="see_project" href="{{ url('productaccess/create') }}" alt="Create Distributor Access">&nbsp;&nbsp;click here</a></p>
				<hr>
				<p class="categories_small"></p>
			</div>
		</div>
	</div>
</div>

@stop