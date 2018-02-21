@extends('layouts.master')
@section('content')
	<div class="container" style="margin-left: 20px; padding-top: 20px">
		<div class="row" style="margin-top: 10px; text-align: right">		
			<h1>Create Access by Distributor</h1>
		</div>
		<div class="row">
			<div class="col-md-3" style="top: 113px">
				<select class="form-control" id="distributor_select" name="did">
					<option value=""></option>
					@foreach($distributors as $distributor)
						<option value="{{$distributor->id}}">{{$distributor->distributor}}</option>
					@endforeach
				</select>
			</div>			
			<div class="col-md-9">
				<table class="table table-header-rotated">
				{!! csrf_field() !!}		
					<thead>
						<tr>
							<th></th> 
							@foreach($sfpcs as $sfpc)
							<th class="column criterion rotate-45" value="{{$sfpc->id}}"><div><span>{{$sfpc->code}}</span></div></th>
							@endforeach		
						</tr>
					</thead>
					<tbody>
					<tr id="checkbox_row">
<!-- 						<td id="blank_td"></td> -->
					</tr>						
					</tbody>
				</table>
			</div>	
		</div>			
	</div>

<script type="text/javascript">
	
$(document).ready(function() {

	$(".table-header-rotated").find('th').each(function(i, o) {
		var sfpc = ($(this).find('span').text());
		if($(this).attr('value') == undefined) {
			$('tbody').find('tr').append('<td id="empty_td" value="" name="'+sfpc+'"></td>');			
		} else {	
			$('tbody').find('tr').append('<td><input type="checkbox" value="" name="'+sfpc+'"></td>');
		}
	});

	// ------- LOADS ALL PRODUCT CODES FOR A PARTICULAR DISTRIBUTOR ON CHANGE OF SELECT INPUT -------- //
	$("#distributor_select").on("change", function () {
		$('input').prop('checked', false);
		$('td').css('background-color', 'white');
		var distributor_id = $(this).val();					
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
						//console.log($(this).prop('code'));
						$("#checkbox_row").find('td').each(function(i, o) {
							if($(this).find('input').attr('name') == product.code) {
								$(this).find('input').prop('checked' , true);
								$(this).find('input').val(product.id);
								$(this).css("background-color", 'cornflowerblue');
							}
						});
					}
				});
			}
		});
	});

	$('input[type="checkbox"]').on('click', function() {
		if($("#distributor_select option:selected").text() == '') {
			return;
		} else {
			var selected_checkbox = $(this);
			if($(this).prop('checked') == true) {
				$.ajax({
					type: 'post',
					url: '{!!URL::to('createDistAccessAjax')!!}',
					data: {
						"_token": $("input[name=_token]").val(),
						"did": $("#distributor_select option:selected").val(),
						"code": $(this).attr('name')
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