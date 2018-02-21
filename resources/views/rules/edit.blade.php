@extends('layouts.master')
 
@section('content')

<div class="container" style="margin-bottom: 20px">
	<div class="row">
		<h1>Edit Rule</h1>
	</div>
	<div class="row">
		<form method="POST" action="{{ action('RulesController@update', $rule->id) }}" enctype="multipart/form-data">
		{{ method_field('PUT') }}
		{!! csrf_field() !!}
		<div class="row">		
	        <div><h4>Configuration</h4>
				<input class="form-control" id="dynamic_dropdown" name="directory_label" value="{{ $rule->directory_label}}" readonly>	
				<h4>Salesforce Product Code</h4>
				<input class="form-control" id="sf_dropdown" name="salesforce_product_code" value="{{ $rule->salesforce_product_code}}" readonly>
	        </div>
	        <div><h4>Rule Name</h4>
				<input class="form-control" id="rule_name" name="rule_name" value="{{ $rule->rule_name}}">
	        </div>	            
		</div>
		<br>
		<div class="row" id="table_wrappers">
		</div> 
	   	<div><button type="button" class="btn btn-warning" id="add_row_edit">Add Row</button></div>   				
		</form>
	</div>	
</div>

<script type="text/javascript">
$(document).ready(function () {

var name_of_rule = $("#rule_name").val();
var table_count;	
$.ajax({
			type: 'get',
			url: '{!!URL::to('getRulesData')!!}',
			data: {},
			success:function(data) {
				console.log('success');
				console.log(data);
				$.each(data, function(index, rule) {
					if($(this).prop("rule_name") == name_of_rule) {
						$("#table_wrappers").append(
							'<div class="col-md-12 table-responsive db_records">\
								<table class="table table-bordered" id="tab_logic">\
								\
									<thead>\
										<tr>\
											<th class="text-center">Submitted Name 1</th>\
											<th class="text-center">Submitted Name 2</th>\
											<th class="text-center">Submitted Name 3</th>\
											<th class="text-center">Submitted Output</th>\
											<th class="text-center">Action</th>\
										</tr>\
									</thead>\
									<tbody>\
										<tr>\
											<td><input type="text"  class="form-control" name="submitted_name_1[]" value="'+ $(this).prop("submitted_name_1") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="submitted_name_2[]" value="'+ $(this).prop("submitted_name_2") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="submitted_name_3[]" value="'+ $(this).prop("submitted_name_3") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="submitted_output[]" value="'+ $(this).prop("submitted_output") +'" readonly></td>\
											<td></td>\
										</tr>\
									</tbody>\
									<thead>\
										<tr>\
											<th class="text-center">Input 1</th>\
											<th class="text-center">Input 2</th>\
											<th class="text-center">Input 3</th>\
											<th class="text-center">Output</th>\
											<th style="padding: 2px; text-align: center;"><span class="hidden did" value="'+ $(this).prop("id") +'"></span><button style="margin-top: 1px" type="button" class="delete text-danger delete_row btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></th>\
										</tr>\
									</thead>\
									<tbody>\
										<tr>\
											<td><input type="text"  class="form-control" name="input_1[]" value="'+ $(this).prop("input_1") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="input_2[]" value="'+ $(this).prop("input_2") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="input_3[]" value="'+ $(this).prop("input_3") +'" readonly></td>\
											<td><input type="text"  class="form-control" name="output[]" value="'+ $(this).prop("output") +'" readonly></td>\
											<td></td>\
										</tr>\
									</tbody>\
								</table>\
							</div>')
						console.log($(this).prop("rule_name"));
					}
				});
				table_count = $(".table-responsive").length;
				console.log(table_count);
			},
			error:function(){

			}
		});


	$("#add_row_edit").on("click", function () {
		table_count++;
		$("#table_wrappers").append(
			'<div class="col-md-12 table-responsive">\
				<table class="table table-bordered" id="tab_logic">\
					<thead data-id="0">\
						<tr>\
							<th class="text-center">Submitted Name 1</th>\
							<th class="text-center">Submitted Name 2</th>\
							<th class="text-center">Submitted Name 3</th>\
							<th class="text-center">Submitted Output</th>\
							<th class="text-center">Action</th>\
						</tr>\
					</thead>\
					<tbody>\
						<tr>\
							<td><select class="form-control sn1" name="submitted_name_1" value=""></select></td>\
							<td><select class="form-control sn2" name="submitted_name_2" value=""></select></td>\
							<td><select class="form-control sn3" name="submitted_name_3" value=""></select></td>\
							<td><select class="form-control s_output" name="submitted_output" value=""></select></td>\
							<td style="padding-top: 15px; text-align: center;"><button style="margin-top: 1px" type="button" class="save save_row btn btn-primary"><span class="glyphicon glyphicon-save"></span></button></td>\
						</tr>\
					</tbody>\
					<thead>\
						<tr>\
							<th class="text-center">Input 1</th>\
							<th class="text-center">Input 2</th>\
							<th class="text-center">Input 3</th>\
							<th class="text-center">Output</th>\
							<th></th>\
						</tr>\
					</thead>\
					<tbody>\
						<tr>\
							<td><select class="form-control inp1" name="input_1" value=""></select></td>\
							<td><select class="form-control inp2" name="input_2" value=""></select></td>\
							<td><select class="form-control inp3" name="input_3" value=""></select></td>\
							<td><input type="text" class="form-control output" name="output" value=""></td>\
							<td style="padding-top: 15px; text-align: center;"><button style="margin-top: 1px" type="button" class="delete text-danger delete_row btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>\
						</tr>\
					</tbody>\
				</table>\
			</div>');


		var config_name = $("#dynamic_dropdown").val();

		$.ajax({
			type: 'get',
			url: '{!!URL::to('findProductName')!!}',
			data: {},
			success: function(data) {
				console.log('success');
				console.log(data);		
				var sub_names_array = [];
				var input_names_array = [];
				var extracted_submitted_names = '';
				var extracted_part_numbers = '';				
				$.each(data, function(index, item) {
					if ($(this).prop('directory_label') == config_name) {						
						extracted_submitted_names += $(this).prop('submitted_names');
						extracted_part_numbers += $(this).prop('part_numbers');
					}
				});
				sub_names_array.push(extracted_submitted_names);
				input_names_array.push(extracted_part_numbers);

		  		var sn_list = JSON.parse(sub_names_array);
		  		var pn_list = JSON.parse(input_names_array);

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
			error: function() {

			}
		});
	});



	// $(document).on("click", ".delete_row", function() {
	// 	var tbody = $(this).closest("table").parent();
	// 	var buttons = $(".delete_row").length;
	// 	if(table_count > 1) {
	// 		tbody.remove();
	// 		table_count--;
	// 	} else {
	// 		alert("You cannot delete this row");
	// 	}
		
	// });

	$(document).on("click", ".delete_row", function() {
		var c = confirm('Are you sure you want to delete this record?');
		var tbody = $(this).closest("table").parent();
		if (c == true) {
			$.ajax({
				type: "post",
				url: '{!!URL::to('deleteRecordAjax')!!}',
				data: {
					"_token": $("input[name=_token]").val(),
					"id": $(this).parent().find('.did').attr('value')
				},
				success: function(data) {
					console.log('Record deleted');
					tbody.remove();
				}
			});
		} else {
			console.log("Record not deleted");
		}	
	});

	$(document).on("click", ".save_row", function() {
		var delete_btn = $(this);
		console.log(delete_btn);
		$.ajax({
			type: "post", 
			url: '{!!URL::to('updateThroughAjax')!!}',
			data: {
				"_token": $("input[name=_token]").val(),
				"directory_label": $("#dynamic_dropdown").val(),
				"salesforce_product_code": $("#sf_dropdown").val(),
				"rule_name": $("#rule_name").val(),
				"submitted_name_1": $(this).parent().parent().find('.sn1').val(),
				"submitted_name_2": $(this).parent().parent().find('.sn2').val(),
				"submitted_name_3": $(this).parent().parent().find('.sn3').val(),
				"submitted_output": $(this).parent().parent().find('.s_output').val(),
				"input_1": $(this).parent().parent().parent().parent().find('.inp1').val(),
				"input_2": $(this).parent().parent().parent().parent().find('.inp2').val(),
				"input_3": $(this).parent().parent().parent().parent().find('.inp3').val(),
				"output": $(this).parent().parent().parent().parent().find('.output').val()
			},
			success: function(data) {
				alert("Record Saved to Database");
				$(delete_btn).parent().parent().parent().parent().find(".sn1, .sn2, .sn3, .s_output, .inp1, .inp2, .inp3").prop("disabled", true);
				$(delete_btn).parent().parent().parent().parent().find(".output").prop("readonly", true);
				 
			}
		}); 
	});

});

</script>
@stop
