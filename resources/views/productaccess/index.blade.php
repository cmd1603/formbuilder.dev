@extends('layouts.master')
@section('content')
	<div class="container">
		<div class="row" style="margin-top: 10px">
			@if (session()->has('success_message'))
			<div class="alert alert-success">{{ session('success_message') }}</div>
			@endif			
			<h1 class="text-center">Access</h1>
			<hr>
		</div>	
		<div class="row">
			<div class="col-md-5 text-center">		
				<label style="font-size: x-large;">Distributor</label>
				<select class="form-control" id="distributor_select" name="did">
					<option value=""></option>
					@foreach($distributors as $distributor)
						<option value="{{$distributor->id}}">{{$distributor->distributor}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-7 text-center">	
				<label style="font-size: x-large;">Product Code Access</label>
				<table class="table table-bordered" id="product_code_table">
					{!! csrf_field() !!}
					<thead style="font-size: medium;">
						<tr>
							<th class="text-center">Code</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-5 text-center">		
				<label style="font-size: x-large;">Salesforce Product Code</label>
				<select class="form-control" id="sfpc_select" name="did">
					<option value=""></option>
					@foreach($sfpcs as $sfpc)
						<option value="{{$sfpc->id}}">{{$sfpc->code}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-7 text-center">	
				<label style="font-size: x-large;">Distributor Access</label>
				<table class="table table-bordered" id="sfpc_table">
					{!! csrf_field() !!}
					<thead style="font-size: medium;">
						<tr>
							<th class="text-center">Distributor</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>				
		</div>
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

	// ------- LOADS ALL PRODUCT CODES FOR A PARTICULAR DISTRIBUTOR ON CHANGE OF SELECT INPUT -------- //
	$("#distributor_select").on("change", function () {
		var distributor_id = $(this).val();					
		$("#product_code_table").find('tbody').empty();
		$.ajax({
			type: 'get',
			url: '{!!URL::to('getDistributorData')!!}',
			data: {},
			success:function(data) {
				// console.log(data);
				$.each(data, function(index, product) {
					if(distributor_id != $(this).prop('did')) {
						console.log('no match');
					} else {
						console.log($(this).prop('code'));
						// $("#product_code_table").find('tbody').empty();
						$("#product_code_table").append(
							"<tr class='item" + $(this).prop("id") + "'>\
							 	<td class=\"tb_data\">"+ $(this).prop("code")+ "</td>\
							 	<td class=\"tb_data\" value='"+ $(this).prop("id")+ "'>\
							 		<button type=\"button\" class='delete-modal btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Delete</button>\
							 	</td>\
							</tr>");						
					}
				})
			}
		});
	});

	// ------- LOADS ALL DISTRIBUTORS ASSOCIATED WITH THE SELECTED PRODUCT CODE -------- //
	$("#sfpc_select").on("change", function () {
		var sfpc_text = $(this).find("option:selected").text();				
		$("#sfpc_table").find('tbody').empty();
		$.ajax({
			type: 'get',
			url: '{!!URL::to('getDistributorData')!!}',
			data: {},
			success:function(data) {
				// console.log(data);
				$.each(data, function(index, product) {
					$product = $(this);
					if(sfpc_text != $(this).prop('code')) {
						console.log('no match');
					} else {
						$.each(distributor_array, function(index, distributor) {
							if($product.prop('did') == distributor.id) {
								$("#sfpc_table").append(
									"<tr class='item" + distributor.id + "'>\
									 	<td class=\"tb_data\">"+ distributor.distributor + "</td>\
									 	<td class=\"tb_data\" value='"+ distributor.id + "'>\
									 	</td>\
									</tr>");	
							}
						});							
					}
				})
			}
		});
	});

	// ------- DELETES A DISTRIBUTORS ACCESS FOR A PARTICULAR ACCESS CODE -------- //
	$(document).on("click", ".delete-modal", function() {
		var c = confirm('Are you sure you want to delete this record?');
		var row_id = $(this).parent().attr('value');
		console.log(row_id);
		if (c == true) {
			$.ajax({
				type: "post",
				url: '{!!URL::to('deleteDistAccess')!!}',
				data: {
					"_token": $("input[name=_token]").val(),
					"id": row_id
				},
				success: function(data) {
					$('.item' + row_id).remove();
					console.log('Record deleted');
					
				}
			});
		} else {
			console.log("Record not deleted");
		}	
	});	

});

</script>

@stop