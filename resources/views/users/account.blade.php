@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px">
		@if (session()->has('success_message'))
		<div class="alert alert-success">{{ session('success_message') }}</div>
		@endif
		<h1 class="text-center";>User Profile</h1>
		<div class="row userProfile">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<p class="lead text-center" style="font-size: x-large; font-weight: 500;">{{ $user->name }}</p>
				<ul style="list-style: none">
					<li>Member Since: {{ $user->created_at->format('F Y') }} </li>
					<li>Total Configurations Created: {{ $user->configurations->count() }}</li>
					<li>Total Rules Created: {{ $user->rules->count() }}</li>
				</ul>
				@if ($user->id === $logged_in_user->id)
					<form method="GET" action="{{ action('UserController@edit', $user->id) }}">
					{!! csrf_field() !!}
						<button type="submit" class="btn btn-warning">Edit Account</button>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="container">		
	<div class="row" style="margin-bottom: 40px">
		<h3 class="text-center";>My Configurations</h3>
		@include('partials.nothing_to_show')
		<table class="table table-bordered" id="configurations_table" style="-moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 10px 3px #ababab;">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Status</h3></th>
				<th class="text-center"><h3>Last Updated</h3></th>
				<th class="text-center"><h3>Actions</h3></th>
			</thead>
			<tbody>
				<tr>	
				@foreach($user->configurations as $configuration)
					<td class="text-center"><a href="{{ action('ConfigurationsController@edit', $configuration->id) }}"><h3>{{ $configuration->directory_label }}</h3></a></td>
					<td class="text-center">
					@if ($configuration->active == 0)
						<h4>Inactive</h4>
					@elseif ($configuration->active == 1)
						<h4>Active&nbsp<i class="fa fa-check" aria-hidden="true" style="color: green;"></i></h4>		
					</td>
					@endif	
					<td class="text-center">{{ $configuration->updated_at }}</td>
					<td class="text-center">
						<form  method="POST" action="{{ action('ConfigurationsController@deactivate', $configuration->id) }}" style="display: inline-block;">
							{!! csrf_field() !!}
						@if ($configuration->active == 1)
						<button type="submit" class="btn btn-success">Deactivate</button>
						@else
						<button type="button" class="btn btn-success disabled">Deactivate</button>
						@endif
						</form>

						{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteConfig', 'style' => 'display: inline-block','action' => ['ConfigurationsController@destroy', $configuration->id]]) !!}

						{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_config btn btn-danger','id' => 'btnDeleteProduct', 'style' => 'border-radius: 1px', 'data-id' => $configuration->id ] ) !!}
               			{!! Form::close() !!}
               		</td>
				</tr>
				@endforeach	
			</tbody>				
			<script>
				$(".delete_config").on('click', function() {
				return confirm('Do you want to delete this configuration?');
				});
			</script>	
		</table>
		<br>
		<h3 class="text-center">My Rules</h3>
		<table class="table table-bordered" id="rules_table" style="-moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 10px 3px #ababab;">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Last Updated</h3></th>
				<th class="text-center"><h3>Actions</h3></th>
			</thead>
			<tbody>
				<tr>
					@foreach($user->rules as $rule)
					<td class="text-center"><a href="{{ action('RulesController@edit', $rule->id) }}"><h3>{{ $rule->rule_name }}</h3></a></td>
					<td class="text-center">{{ $rule->updated_at }}</td>
					<td class="text-center">
						{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteRule', 'style' => 'display: inline-block','action' => ['RulesController@destroy', $rule->id]]) !!}

						{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_rule btn btn-danger','id' => 'btnDeleteProduct', 'style' => 'border-radius: 1px', 'data-id' => $rule->id ] ) !!}
		       			{!! Form::close() !!}
					</td>
				</tr>
					@endforeach				
			</tbody>
			<script>
				$(".delete_rule").on('click', function() {
				return confirm('Do you want to delete this rule?');
				});
			</script>						
		</table>
	</div>
</div>
@stop 