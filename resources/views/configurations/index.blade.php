@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row"> 		
		<h1 class="text-center">All Configurations</h1>
		<table class="table table-bordered" style="-moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 10px 3px #ababab;">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Status</h3></th>
				<th class="text-center"><h3>Created By</h3></th>
				<th class="text-center"><h3>Last Updated</h3></th>
			</thead>
			<tbody>
				<tr>
					@foreach($configurations as $configuration)
					<td class="text-center"><a href="{{ action('ConfigurationsController@show', $configuration->id) }}"><h3>{{ $configuration->directory_label }}</h3></a></td>
					<td class="text-center">
					@if ($configuration->active == 0)
						<h4>Inactive</h4>
					@elseif ($configuration->active == 1)
						<h4>Active&nbsp<i class="fa fa-check" aria-hidden="true" style="color: green;"></i></h4>		
					</td>
					@endif
					<td class="text-center"> {{ $configuration->user->name }}</td>
					<td class="text-center">{{ $configuration->updated_at }}</td>
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