@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px">
		@if (session()->has('success_message'))
			<div class="alert alert-success">{{ session('success_message') }}</div>
		@endif
		<h1 class="text-center">Rules</h1>
		<hr>
		<!-- <table class="table" id="rules_table">
			<thead>
				<th class="text-center"><h3>Name</h3></th>
				<th class="text-center"><h3>Created</h3></th>
				<th class="text-center"><h3>Created By</h3></th>
			</thead>
			<tbody
				<tr>
					@foreach($rule_ids as  $rule_id)
					<td class="text-center"><a href="{{ action('RuleIdsController@edit', ['id' => $rule_id->id]) }}"><h3>{{ $rule_id->rule_name }}</h3></a></td>
					<td class="text-center">{{ $rule_id->updated_at }}</td>
					<td class="text-center">{{ $rule_id->user->name }}</td>
				</tr>
					@endforeach
			</tbody>
		</table> -->
<!-- 		<div class="text-center">
			{!! $rule_ids->render() !!}
		</div> -->
	</div>
	<div class="row">
		<div class="col-md-5 text-center">
			<label style="font-size: x-large;">Configuration</label>
			<select class="form-control" id="config_dropdown" name="c_dropdown">
				<option value=""></option>
				@foreach($configurations as $configuration)
					<option value="{{$configuration->id}}">{{$configuration->directory_label}}</option>
				@endforeach	
			</select>
		</div>
		<div class="col-md-7 text-center">
			<label style="font-size: x-large;">Name</label>
			<table class="table table-bordered" id="rule_table">
				{!! csrf_field() !!}
				<tbody></tbody>
			</table>
		</div>	
	</div>	
</div>

<script type="text/javascript">
	$(document).ready(function() {	

		var rules_array = [];
		loadRules();

		function loadRules() {
			$.ajax({
				type: 'get',
				url: '{!!URL::to('fetchRuleIds')!!}',
				data: {},
				success:function(data) {
					console.log(data);
					$.each(data, function(index, rule) {
						rules_array.push(rule);
					});
				}
			});	
		}

		$("#config_dropdown").on("change" ,function() {
			var config_id = $("#config_dropdown option:selected").text();
			$("#rule_table").find('tbody').empty();
			$.each(rules_array, function (index, rule) {

				if($(this).prop('directory_label') == config_id) {
					$("#rule_table").append(
						"<tr class='item" + $(this).prop("id") + "'>\
									<td class=\"tb_data\"><a href=\"http://192.168.0.33/rule_ids/" +  $(this).prop("id") + "/edit\"><h3>" + $(this).prop("rule_name") + "</h3></a></td>\
						 </tr>");
				}	
			});

							
		});

	});
</script>
@stop