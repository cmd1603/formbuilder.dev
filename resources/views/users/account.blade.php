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
					<li>Total Rules Created: {{ $user->rule_ids->count() }}</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container" style="margin-bottom: 40px">		
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#configurations">My Configurations</a></li>
			<li><a data-toggle="tab" href="#rules">My Rules</a></li>
			<li><a data-toggle="tab" href="#templates">My Templates</a></li>
		</ul>
		<div class="tab-content">
			<div id="configurations" class="tab-pane fade in active">
				<table class="table" id="configurations_table">
					<thead>
						<th class="text-center"><h3>Name</h3></th>
						<th class="text-center"><h3>Status</h3></th>
						<th class="text-center"><h3>Last Updated</h3></th>
						<th class="text-center"><h3>Actions</h3></th>
					</thead>
					<tbody>
						<tr>	
						@foreach($user->configurations as $configuration)
						@if($configuration->hidden == 0)
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
								<button type="submit" class="btn btn-success deactivate_config">Deactivate</button>
								@else
								<button type="button" class="btn btn-success disabled">Deactivate</button>
								@endif
								</form>
								{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteConfig', 'style' => 'display: inline-block','action' => ['ConfigurationsController@destroy', $configuration->id]]) !!}	
																
								{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_config btn btn-danger', 'style' => 'border-radius: 1px', 'data-id' => $configuration->id ] ) !!}
		               			{!! Form::close() !!}
		               		</td>
		               	@endif	
						</tr>
						@endforeach
					</tbody>				
					<script>
						$(".deactivate_config").on('click', function() {
						return confirm('Do you want to deactivate this configuration?');
						});

						$(".delete_config").on('click', function() {
						return confirm('Do you want to delete this configuration?');
						});
					</script>	
				</table>
			</div>	

			<div id="rules" class="tab-pane fade">
				<table class="table" id="rules_table">
					<thead>
						<th class="text-center"><h3>Name</h3></th>
						<th class="text-center"><h3>Last Updated</h3></th>
						<th class="text-center"><h3>Actions</h3></th>
					</thead>
					<tbodyS>
						<tr>
							@foreach($user->rule_ids as $rule_id)
							<td class="text-center"><a href="{{ action('RuleIdsController@edit', $rule_id->id) }}"><h3>{{ $rule_id->rule_name }}</h3></a></td>
							<td class="text-center">{{ $rule_id->updated_at }}</td>
							<td class="text-center">
								{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteRule', 'style' => 'display: inline-block','action' => ['RuleIdsController@destroy', $rule_id->id]]) !!}

								{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_rule btn btn-danger', 'style' => 'border-radius: 1px', 'data-id' => $rule_id->id ] ) !!}
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

			<div id="templates" class="tab-pane fade">
				<table class="table" id="templates_table">
					<thead>
						<th class="text-center"><h3>Name</h3></th>
						<th class="text-center"><h3>Last Updated</h3></th>
						<th class="text-center"><h3>Actions</h3></th>
					</thead>
					<tbodyS>
						<tr>
							@foreach($user->templates as $template)
							<td class="text-center"><a href="{{ action('TemplatesController@edit', $template->id) }}"><h3>{{ $template->directory_label }}</h3></a></td>
							<td class="text-center">{{ $template->updated_at }}</td>
							<td class="text-center">
								{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteRule', 'style' => 'display: inline-block','action' => ['TemplatesController@destroy', $template->id]]) !!}

								{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_rule btn btn-danger', 'style' => 'border-radius: 1px', 'data-id' => $template->id ] ) !!}
				       			{!! Form::close() !!}
							</td>
						</tr>
							@endforeach				
					</tbody>					
				</table>
			</div>			
		</div>		
	</div>
</div>
@stop 