@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<a href="{{ url('configurations/create') }}"><h1>Create a Configuration</h1></a>
		<a href="{{ url('rules/create') }}"><h1>Create a Rule</h1></a>
	</div>	
</div>

@stop