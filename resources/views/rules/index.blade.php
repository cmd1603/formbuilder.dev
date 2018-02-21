@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px">
		@if (session()->has('success_message'))
			<div class="alert alert-success">{{ session('success_message') }}</div>
		@endif
		<h1 class="text-center">All Rules</h1>
		<table class="table" id="configurations_table" style="-moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 10px 3px #ababab;">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Last Updated</h3></th>
				<th class="text-center"><h3>Created By</h3></th>
				<th class="text-center"><h3>Actions</h3></th>
			</thead>
			<tbody>
				<tr>
					@foreach($user->rule_ids as $rule_id)
					<td class="text-center"><a href="{{ action('RuleIdsController@edit', $rule_id->id) }}"><h3>{{ $rule_id->rule_name }}</h3></a></td>
					<td class="text-center">{{ $rule_id->updated_at }}</td>
					<td class="text-center">{{ $rule_id->user->name }}</td>
					<td class="text-center">

						{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteRule', 'style' => 'display: inline-block','action' => ['RuleIdsController@destroy', $rule->id]]) !!}

						{!! Form::button( '<span class="glyphicon glyphicon-trash"></span>', ['type' => 'submit', 'class' => 'delete text-danger delete_config btn btn-danger','id' => 'btnDeleteProduct', 'style' => 'border-radius: 1px', 'data-id' => $rule->id ] ) !!}
               			{!! Form::close() !!}
					</td>
				</tr>
					@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $rules->render() !!}
		</div>
	</div>
</div>
@stop