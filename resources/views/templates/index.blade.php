@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row"> 		
		<h1 class="text-center">Configuration Templates</h1>
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
					@foreach($templates as $template)
					@if($template->hidden == 0)	
					<td class="text-center">
						<a href="{{ action('TemplatesController@edit', $template->id) }}"><h3>{{ $template->directory_label }}</h3></a>
					</td>
					<td class="text-center">
						@if ($template->active == 0)
						<h4>Inactive</h4>
						@elseif ($template->active == 1)
						<h4>Active&nbsp<i class="fa fa-check" aria-hidden="true" style="color: green;"></i></h4>	
					</td>
						@endif
					<td class="text-center"> {{ $template->user->name }}</td>
					<td class="text-center">{{ $template->updated_at }}</td>
					@endif
				</tr>
					@endforeach
			</tbody>	
		</table>
		<div class="text-center">
		{!! $templates->render() !!}
		</div>
	</div>		
</div>
@stop