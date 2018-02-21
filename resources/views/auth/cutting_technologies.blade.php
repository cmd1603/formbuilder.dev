@extends('layouts.master')
@section('content')



<div id="ct_divs" class="full container-fluid">
	<div id="ct_div_1" class="row technologies">	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
			<a href="{{ url('router') }}"><h1 class="headers">ROUTER</h1></a>
		</div>	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
			<a href="{{ url('/router') }}" alt="Configuration">
				<img src="/img/apex3r.png" style="height: auto; width: 47%" alt="Create Home" class="">
			</a>			
		</div>		
	</div>
	<div id="ct_div_2" class="row technologies">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">	
			<a href="{{ url('fabrication') }}"><h1 class="headers">FABRICATION</h1></a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
			<a href="{{ url('/fabrication') }}" alt="Configuration">
				<img src="/img/arcos.png" style="height: auto; width: 47%" alt="Create Home" class="">
			</a>			
		</div>			
	</div>	
	<div id="ct_div_3" class="row technologies">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-center">
			<a href="{{ url('digital_finishing') }}"><h1 class="headers">DIGITAL FINISHING</h1></a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-lg-offset-1 col-xl-offset-1 text-center" style="margin-left: 0">
			<a href="{{ url('/digital_finishing') }}" alt="Configuration">
				<img src="/img/celero.png" style="height: auto; width: 47%" alt="Create Home" class="">
			</a>			
		</div>			
	</div>	
</div>
@stop