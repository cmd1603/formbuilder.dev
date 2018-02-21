@extends('layouts.master')
@section('content')
	<div class="container" style="padding-top: 20px">
		<div class="row">
			@if (session()->has('success_message'))
			<div class="alert alert-success">{{ session('success_message') }}</div>
			@endif			
			<h1 class="text-center">Create Access By Salesforce Product Code</h1>
		</div>
		<hr>
		<form method="POST" action="{{ action('ProductAccessController@store') }}" enctype="multipart/form-data">
		<div class="row">
			
			{!! csrf_field() !!}	
			<div class="col-md-4 form-group{{ $errors->has('code') ? ' has-error' : '' }}">	
				<label class="text-center">Salesforce Product Code</label>
				<select class="form-control" id="code_select" name="code">
					<option value=""></option>
					@foreach($sfpcs as $sfpc)
						<option>{{$sfpc->code}}</option>
					@endforeach
				</select>
				<small class="text-danger">{{ $errors->first('did') }}</small>
			</div>
			<div class="col-md-6 pane">
				<table class="table table-bordered" id="distributor_table">
					<thead>
						<tr>
							<th></th>
							<th class="text-center">Distributor</th>
						</tr>
						<tbody>
							@foreach($distributors as $distributor)
							<tr>
								<td class="text-center"><input type="checkbox" value="{{$distributor->id}}" name="{{$distributor->distributor}}"></td>
								<td class="text-center">{{$distributor->distributor}}</td>
							</tr>
							@endforeach
						</tbody>
					</thead>	
				</table>
			</div>	
		</div>
		</form>
	</div>

<script type="text/javascript">
	
$(document).ready(function() {

	// ------- LOADS DISTRIBUTOR DATA FROM DATABASE -------- //
	var distributor_array = [];
	$.ajax({
		type: 'get',
		url: '{!!URL::to('fetchDistributorData')!!}',
		data: {},
		success:function(data) {
			$.each(data, function(index, option) {
				distributor_array.push(option);
			});
		}
	});


	// ------- LOADS ALL DISTRIBUTORS ASSOCIATED WITH THE SELECTED PRODUCT CODE -------- //
	$("#code_select").on("change", function () {
		var sfpc_text = $(this).find("option:selected").text();	
		$('input').prop('checked', false);
		$('td').css('background-color', 'white');
		$.ajax({
			type: 'get',
			url: '{!!URL::to('getDistributorData')!!}',
			data: {},
			success:function(data) {
				$.each(data, function(index, product) {
					$product = $(this);
					if(sfpc_text != $(this).prop('code')) {
						console.log('no match');
					} else {
						$.each(distributor_array, function(index, distributor) {
							if($product.prop('did') == distributor.id) {
								$("#distributor_table").find('tr').each(function(i, o) {
									var me = $(this);
									if(me.find('input').attr('name') == distributor.distributor) {
										me.find('input').prop('checked' , true);
										me.find('input').parent().css('background-color', 'cornflowerblue');
									}
								});	
							}
						});							
					}
				})
			}
		});
	});

	$('input[type="checkbox"]').on('click', function() {
		if($("#code_select option:selected").text() == '') {
			return;
		} else {
			var selected_checkbox = $(this);
			if($(this).prop('checked') == true) {
				$.ajax({
					type: 'post',
					url: '{!!URL::to('createDistAccessAjax')!!}',
					data: {
						"_token": $("input[name=_token]").val(),
						"did": $(this).val(),
						"code": $("#code_select option:selected").text()
					},
					success: function(data) {
						console.log('Record created');
						selected_checkbox.parent().css('background-color', 'cornflowerblue');
						selected_checkbox.val(data.id);
					}
				});
			} else {	
				$.ajax({
					type: 'post',
					url: '{!!URL::to('deleteDistAccess')!!}',
					data: {
						"_token": $("input[name=_token]").val(),
						"id": selected_checkbox.val()
					},
					success: function(data) {
						selected_checkbox.parent().css('background-color', 'white');
						console.log('Record deleted');
					},
					error: function() {
						console.log("Error! Something went wrong.");
						selected_checkbox.prop('checked', true);
					}
				});			
			}
		}	
	})

});
</script>

@stop