@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<h1 class="text-center">Active Digital Finishing</h1>
		<table class="table">
			<thead>
				<th class="text-center"><h4>Name</h4></th>
				<th class="text-center"><h4>Created By</h4></th>
				<th class="text-center"><h4>Last Updated</h4></th>	
			</thead>
			<tbody>
				<tr>
					@foreach($configurations as $configuration)
					@if($configuration->hidden == 0)					
						@if ($configuration->cutting_technology == 'digital_finishing' && $configuration->active == 1)
					<td class="text-center">
						<a href="{{ action('ConfigurationsController@show', $configuration->id) }}"><h3>{{ $configuration->directory_label }}</h3></a></td>
					</td>
					<td class="text-center"> {{ $configuration->user->name }}</td>
					<td class="text-center">{{ $configuration->updated_at }}</td>
						@endif
					@endif	
				</tr>
					@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop 