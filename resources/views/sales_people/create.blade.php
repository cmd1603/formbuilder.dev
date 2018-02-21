@extends('layouts.master')
@section('content')
	<div class="container">
		<div class="row" style="margin-top: 10px">
			@if (session()->has('success_message'))
			<div class="alert alert-success">{{ session('success_message') }}</div>
			@endif			
			<h1>Create Distributor/Salesperson</h1>
		</div>	
		<div class="row">
			<form method="POST" action="{{ action('SalesPersonController@store') }}" enctype="multipart/form-data">
			{!! csrf_field() !!}	
			<div class="col-md-6 form-group{{ $errors->has('did') ? ' has-error' : '' }}">		
				<label for="did">Distributor</label>
				<select class="form-control" id="distributor_select" name="did">
					<option value=""></option>
					@foreach($distributors as $distributor)
						<option value="{{$distributor->id}}">{{$distributor->distributor}}</option>
					@endforeach
				</select>
				<small class="text-danger">{{ $errors->first('did') }}</small>
			</div>
			<div class="col-md-6 form-group">	
				<label>Salesperson</label>
				<input class="form-control" type="text" name="sales_person">
				<small class="text-danger">{{ $errors->first('sales_person') }}</small>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function() {		
	});
</script>


@stop