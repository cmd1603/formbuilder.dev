@extends('layouts.master')
 
@section('content')
<div class="container" style="margin-bottom: 20px">
	<div class="row">
		<h1>Rules Generator</h1>
	</div>
	<form method="POST" action="{{ action('RulesController@store') }}" enctype="multipart/form-data">	
	{!! csrf_field() !!}
	<div class="row">		
        <div><h4>Configuration</h4>
			<select class="form-control" id="dynamic_dropdown" name="directory_label">
					<option value="">Please make a selection</option>		
				@foreach($configurations as $configuration)
					<option value="{{ $configuration->directory_label }}">{{$configuration->directory_label}}</option>
				@endforeach
			</select>
			<h4>Salesforce Product Code</h4>
			<select class="form-control" id="sf_dropdown" name="salesforce_product_code"></select>
        </div>
        <div><h4>Rule Name</h4>
			<input type="text" class="form-control" id="rule_name" name="rule_name">
        </div>	            
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 table-responsive">
		<table class="table table-bordered tab_logic" id="table_count_">
			<thead data-id="0">
				<tr>
					<th class="text-center">Submitted Name 1</th>
					<th class="text-center">Submitted Name 2</th>
					<th class="text-center">Submitted Name 3</th>
					<th class="text-center">Submitted Output</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr class="addr0" data-id="0">
					<td data-name="submitted_name_1">
						@include('partials.select_form', ['id' => '', 'field' => 'submitted_name_1[]', 'type' => 'select-one', 'class' => 'form-control sn1'])
					</td>	
					<td data-name="submitted_name_2">
						@include('partials.select_form', ['id' => '', 'field' => 'submitted_name_2[]', 'type' => 'select-one', 'class' => 'form-control sn2'])
					</td>	

					<td data-name="submitted_name_3">
						@include('partials.select_form', ['id' => '', 'field' => 'submitted_name_3[]', 'type' => 'select-one', 'class' => 'form-control sn3'])
					</td>	
					<td data-name="submitted_output">
						@include('partials.select_form', ['id' => '', 'field' => 'submitted_output[]', 'type' => 'select-one', 'class' => 'form-control s_output'])
					</td>
					<td data-name="action"></td>	
				</tr>
			</tbody>
			<thead data-id="0">
				<tr>
					<th class="text-center">Input 1</th>
					<th class="text-center">Input 2</th>
					<th class="text-center">Input 3</th>
					<th class="text-center">Output</th>
					<th style="padding: 2px; text-align: center;"><button style="margin-top: 1px" type="button" class="delete text-danger delete_row btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></th>
				</tr>
			</thead>
			<tbody id="tbody_2" data-id="0">
				<tr class="addr0" data-id="0">
					<td data-name="input_1">
						@include('partials.select_form', ['id' => '', 'field' => 'input_1[]', 'type' => 'select-one', 'class' => 'form-control inp1'])
					</td>	
					<td data-name="input_2">
						@include('partials.select_form', ['id' => '', 'field' => 'input_2[]', 'type' => 'select-one', 'class' => 'form-control inp2'])
					</td>
					<td data-name="input_3">
						@include('partials.select_form', ['id' => '', 'field' => 'input_3[]', 'type' => 'select-one', 'class' => 'form-control inp3'])
					</td>	
					<td data-name="output">
						@include('partials.form', ['id' => '', 'field' => 'output[]', 'type' => 'text', 'class' => 'form-control output'])
					</td>
					<td></td>
				</tr>
			</tbody>						
		</table>
		</div>
	</div>            
   	<div><button type="submit" class="btn btn-info" id="submit_rule">Submit</button><button type="button" class="btn btn-default" id="add_row" disabled>Add Row</button></div>
    </form>	 
</div>
	
</div>
<div>
	<textarea class="form-control" id="sn_field" style="display: none">{{ $configuration->submitted_names }}</textarea>
	<textarea class="form-control" id="pn_field" style="display: none">{{ $configuration->part_numbers }}</textarea>
</div>
<script type="text/javascript">


$(document).ready(function () {

	$("#dynamic_dropdown").on('change', function(e) {

		var cat_id = ($(this).find('option:selected').text());
		$('#add_row').prop('disabled', false);

		$.ajax({
			type: 'get',
			url: '{!!URL::to('findProductName')!!}',
			data: {'id':cat_id},
			success:function(data) {
				console.log('success');
				console.log($(this));
				var extracted_submitted_names = '';
				var extracted_part_numbers = '';
				$.each(data, function(index, item) {
					if ($(this).prop('directory_label') == cat_id) {						
						extracted_submitted_names += $(this).prop('submitted_names');
						extracted_part_numbers += $(this).prop('part_numbers');

						$('#sf_dropdown').empty();
						$('#sf_dropdown').append('<option value="'+ $(this).prop('salesforce_product_code') +'">' + $(this).prop('salesforce_product_code') + '</option>');
					}
				});

				$('#sn_field').empty();
				$('#pn_field').empty();
				$('#sn_field').val(extracted_submitted_names);
				$('#pn_field').val(extracted_part_numbers);

		  		var sn_list = JSON.parse($('#sn_field').val());
		  		var pn_list = JSON.parse($('#pn_field').val());

		  		$(".sn1, .sn2, .sn3, .s_output").empty();
		  		$(".sn1").append('<option value="">Please make a selection</option>');
		  		$(".sn2").append('<option value=""></option>');
		  		$(".sn3").append('<option value=""></option>');
		  		$(".s_output").append('<option value=""></option>');

		  		$(".inp1, .inp2, .inp3").empty();
		  		$(".inp1").append('<option value="">Please make a selection</option>');
		  		$(".inp2").append('<option value=""></option>');
		  		$(".inp3").append('<option value=""></option>');

		  		$(sn_list.split('\n')).each(function(i,o) {
		  			$(".sn1").append("<option>" + $.trim(o) + "</option>")
		  			$(".sn2").append("<option>" + $.trim(o) + "</option>")		
		  			$(".sn3").append("<option>" + $.trim(o) + "</option>")
		  			$(".s_output").append("<option>" + $.trim(o) + "</option>")
		  		});

		  		$(pn_list.split('\n')).each(function(i,o) {
		  			$(".inp1").append("<option>" + $.trim(o) + "</option>")
		  			$(".inp2").append("<option>" + $.trim(o) + "</option>")
		  			$(".inp3").append("<option>" + $.trim(o) + "</option>")
		  			// $(".otpt").append("<option>" + $.trim(o) + "</option>")
		  		});

		    	$('.sn1 option, .sn2 option:last-child, .sn3 option:last-child, .s_output option:last-child, .inp1 option:last-child, .inp2 option:last-child, .inp3 option:last-child').each(function() {
		    		if ($(this).text() == "") {
		    			$(this).remove();
		    		}
		    	});	
			},
			error:function(){

			}
		})
	});

	var count = 1;
    $("#add_row").on("click", function () {
    	count++;
    	console.log('clicked');
   //  	var newid = 0;
   //  	$.each($(".tab_logic tr"), function() {
   //  		if (parseInt($(this).data('id')) > newid) {	
   //  			newid = parseInt($(this).data('id'));
   //  		}
   //  	});

   //  	newid++;

   //  	var tr = $("<tr></tr>", {
   //  		class: "addr"+newid,
   //  		"data-id": newid
   //  	});

   //  	var tr_2 = $("<tr></tr>", {
   //  		class: "addr"+newid,
   //  		"data-id": newid
   //  	});    	

   //  	$.each($(".tab_logic tbody tr:nth(0) td"), function() {

   //  		var cur_td = $(this);
   //  		// console.log(cur_td);
   //  		var children = cur_td.children();
			// // console.log($(this));
   //  		if($(this).data('name') != undefined) {
   //  			var td = $("<td></td>", {
   //  				"data-name": $(cur_td).data('name')
   //  			});

   //  			var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val('');
   //  			console.log(c);
   //  			c.attr('name', $(cur_td).data('name') + newid);
   //  			console.log(td);
   //  			c.appendTo($(td));
   //  			console.log(tr);
   //  			td.appendTo($(tr));
   //  		} else {
   //  			var td = $('td></td>', {
   //  				'text': $('.tab_logic tr').length
   //  			}).appendTo($(tr));
   //  		}

   //  	});

   //  	$.each($(".tab_logic #tbody_2 tr:nth(0) td"), function() {
   //  		var cur_td = $(this);
   //  		// console.log(cur_td);
   //  		var children = cur_td.children();
			// // console.log($(this));
   //  		if($(this).data('name') != undefined) {
   //  			var td = $("<td></td>", {
   //  				"data-name": $(cur_td).data('name')
   //  			});

   //  			var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val('');
   //  			console.log(c);
   //  			c.attr('name', $(cur_td).data('name') + newid);
   //  			c.appendTo($(td));
   //  			td.appendTo($(tr_2));
   //  		} else {
   //  			var td = $('td></td>', {
   //  				'text': $('.tab_logic tr').length
   //  			}).appendTo($(tr_2));
   //  		}
   //  	});

    	// $(tr).appendTo($('.tab_logic'));
    	// $(tr_2).appendTo($('#tbody_2'));

    	// $(tr).find('td button.row-remove').on('click', function() {
    	// 	$(this).closest('tr').remove();
    	// });

    	var so_value = $(".table-responsive").find(".s_output:last").find(".s_output option:selected");
    	var dynmc_table = $(".tab_logic").last().clone();
    	$(".table-responsive").append(dynmc_table);
	});

	$(document).on("click", ".delete_row", function() {
		var tbody = $(this).closest("table");
		var buttons = $(".delete_row").length;
		if(count > 1) {
			tbody.remove();
			count--;
		} else {
			alert("You cannot delete this row");
		}
		
	});

});
</script>
@stop