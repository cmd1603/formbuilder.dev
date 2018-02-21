@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row"> 		
		<h1 class="text-center">Configurations</h1>
		<hr>
		<table class="table">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Status</h3></th>
				<th class="text-center"><h3>Created By</h3></th>
				<th class="text-center"><h3>Last Updated</h3></th>
			</thead>
			<tbody>
				<tr>
					@foreach($configurations as $configuration)
					@if($configuration->hidden == 0)
							<td class="text-center">
								<a href="{{ action('ConfigurationsController@edit', $configuration->id) }}"><h3>{{ $configuration->directory_label }}</h3></a>
							</td>
						@if ($configuration->active == 0)
							<td class="text-center"><h4>Inactive</h4></td>
						@else ($configuration->active == 1)	
							<td class="text-center"><h4>Active&nbsp<i class="fa fa-check" aria-hidden="true" style="color: green;"></i></h4></td>
						@endif
					<td class="text-center"> {{ $configuration->user->name }}</td>
					<td class="text-center">{{ $configuration->updated_at }}</td>
					@endif
				</tr>
					@endforeach
			</tbody>	
		</table>
		<div class="text-center">
		{!! $configurations->render() !!}
		</div>
	</div>		
</div>
@stop