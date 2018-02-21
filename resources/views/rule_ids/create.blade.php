@extends('layouts.master')
 
@section('content')
<div class="container" style="margin-bottom: 20px">
	<div class="row">
		<h1>Rule Generator</h1>
	</div>
	<form id="myForm" method="POST" action="{{ action('RuleIdsController@store') }}" enctype="multipart/form-data">	
	{!! csrf_field() !!}
	<div class="row">		
        <div><h4>Configuration</h4>
			<select class="form-control" id="dynamic_dropdown" name="directory_label">
					<option value="">Please make a selection</option>		
				@foreach($configurations as $configuration)
					<option value="{{ $configuration->directory_label }}">{{$configuration->directory_label}}</option>
				@endforeach
			</select>
        </div>
        <div><h4>Rule Name</h4>
			<input type="text" class="form-control" id="rule_name" name="rule_name" required>
        </div>	            
	</div>
	<div>
		<button type="button" class="btn btn-success"  id="add_by_modal" disabled>Add</button>
		<button type="submit" class="btn btn-primary" id="submit_rule">Create Rule</button>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 table-responsive">
		<table class="table table-bordered tab_logic" id="rule_record_table">
			<thead data-id="0">
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Submitted Name 1</th><th class="text-center">Input 1</th>
					<th class="text-center">Submitted Name 2</th><th class="text-center">Input 2</th>
					<th class="text-center">Submitted Name 3</th><th class="text-center">Input 3</th>
					<th class="text-center">Submitted Output</th><th class="text-center">Output</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>						
		</table>
		</div>
	</div>            
    </form>	 
</div>

<div id="rule_modal" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Record</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 1</label>
							<select class="form-control sn1" type="select-one" name="submitted_name_1"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 1</label>
								<select class="form-control inp1" type="select-one" name="input_1"></select>
						</p>	
					</div>						
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 2</label>
							<select class="form-control sn2" type="select-one" name="submitted_name_2"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 2</label>
								<select class="form-control inp2" type="select-one" name="input_2"></select>
						</p>	
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 3</label>
							<select class="form-control sn3" type="select-one" name="submitted_name_3"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 3</label>
								<select class="form-control inp3" type="select-one" name="input_3"></select>
						</p>	
					</div>						
				</div>	
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Output</label>
							<select class="form-control s_output" type="select-one" name="submitted_output"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Output</label>
								<input class="form-control output" type="text" name="output">
						</p>	
					</div>						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="save_record">
						<span class='glyphicon glyphicon-save'></span> Save Record
					</button>
					<button type="button" class="btn" data-dismiss="modal">
						<span class='glyphicon glyphicon-remove'></span> Close
					</button>
				</div>
			</div>
		</div>
  </div>
</div>
<div id="rule_modal2" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Record</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 1</label>
							<select class="form-control sn1_1" type="select-one" name="submitted_name_1"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 1</label>
								<select class="form-control inp1_1" type="select-one" name="input_1"></select>
						</p>	
					</div>						
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 2</label>
							<select class="form-control sn2_1" type="select-one" name="submitted_name_2"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 2</label>
								<select class="form-control inp2_1" type="select-one" name="input_2"></select>
						</p>	
					</div>						
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Name 3</label>
							<select class="form-control sn3_1" type="select-one" name="submitted_name_3"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Input 3</label>
								<select class="form-control inp3_1" type="select-one" name="input_3"></select>
						</p>	
					</div>						
				</div>	
				<div class="row">
					<div class="col-md-6">
						<p>
							<label>Submitted Output</label>
							<select class="form-control s_output_1" type="select-one" name="submitted_output"></select>
						</p>	
					</div>
					<div class="col-md-6">
						<p>
							<label>Output</label>
								<input class="form-control output_1" type="text" name="output">
						</p>	
					</div>						
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="save_edited_record">
						<span class='glyphicon glyphicon-save'></span> Save Record
					</button>
					<button type="button" class="btn" data-dismiss="modal">
						<span class='glyphicon glyphicon-remove'></span> Close
					</button>
				</div>
			</div>
		</div>
  	</div>
</div>  
	<textarea class="form-control" id="sn_field" style="display: none">{{ $configuration->submitted_names }}</textarea>
	<textarea class="form-control" id="pn_field" style="display: none">{{ $configuration->part_numbers }}</textarea>
</div>
<script type="text/javascript">


$(document).ready(function () {

	$(window).on("beforeunload", function() {
		return "Are you sure?";
	});

	$("#myForm").on("submit", function(e) {
		$(window).off("beforeunload");
		return true;
	});

	var extracted_submitted_names = '';
	var extracted_part_numbers = '';

	$("#dynamic_dropdown").on('change', function(e) {

		var cat_id = ($(this).find('option:selected').text());
		$('#add_by_modal').prop('disabled', false);

		loadNamesAndInputs();
	});

	$("#add_by_modal").on("click", function() {
		$('#rule_modal').modal('show')
					 .draggable({handle: ".modal-header" });
		$(".sn1 option:eq(0)").prop("selected", true); $(".sn2 option:eq(0)").prop("selected", true);
		$(".sn3 option:eq(0)").prop("selected", true); $(".inp1 option:eq(0)").prop("selected", true);
		$(".inp2 option:eq(0)").prop("selected", true); $(".inp3 option:eq(0)").prop("selected", true);
		$(".s_output option:eq(0)").prop("selected", true); $(".output").val('');
	});

	$(".modal-footer").on("click", "#save_record", function() {
		$.ajax({
			type: "post", 
			url: '{!!URL::to('storeByAjax')!!}',
			data: {
				"_token": $("input[name=_token]").val(),
				"directory_label": $("#dynamic_dropdown").val(),
				"rule_name": $("#rule_name").val(),
				"submitted_name_1": $('.sn1').val(),
				"submitted_name_2": $('.sn2').val(),
				"submitted_name_3": $('.sn3').val(),
				"submitted_output": $('.s_output').val(),
				"input_1": $('.inp1').val(),
				"input_2": $('.inp2').val(),
				"input_3": $('.inp3').val(),
				"output": $('.output').val()
			},
			success: function(data) {
				console.log("Record Saved to Database");
				$('#rule_record_table').append(
					"<tr class='item" + data.id + "'>\
						<td class=\"tb_data did\">" + data.id + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_1 + "</td>\
						<td class=\"tb_data\">" + data.input_1 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_2 + "</td>\
						<td class=\"tb_data\">" + data.input_2 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_3 + "</td>\
						<td class=\"tb_data\">" + data.input_3 + "</td>\
						<td class=\"tb_data\">" + data.submitted_output + "</td>\
						<td class=\"tb_data\">" + data.output + "</td>\
						<td class=\"tb_data\">\
							<button type=\"button\" class='edit-modal btn btn-info'>\
								<span class='glyphicon glyphicon-edit'></span> Edit\
							</button>\
							<button type=\"button\" class='duplicate btn btn-success'>\
								<span class='glyphicon glyphicon-repeat'></span> Duplicate\
							</button>\
							<button type=\"button\" class='delete-modal btn btn-danger'>\
								<span class='glyphicon glyphicon-trash'></span> Delete\
							</button>\
						</td>\
					</tr>");
			}
		}); 
	});

	// ------- DUPLICATES THE SELECTED RECORD AND ADDS TO TABLE -------- //
	$(document).on("click", ".duplicate", function() {
		var sub_name_1_txt = $(this).closest('tr').find('td').eq(1).text();
		var inp_1_txt = $(this).closest('tr').find('td').eq(2).text();
		var sub_name_2_txt = $(this).closest('tr').find('td').eq(3).text();
		var inp_2_txt = $(this).closest('tr').find('td').eq(4).text();
		var sub_name_3_txt = $(this).closest('tr').find('td').eq(5).text();
		var inp_3_txt = $(this).closest('tr').find('td').eq(6).text();
		var sub_output_txt = $(this).closest('tr').find('td').eq(7).text();
		var output_txt = $(this).closest('tr').find('td').eq(8).text();
		
		$.ajax({
			type: "post", 
			url: '{!!URL::to('storeByAjax')!!}',
			data: {
				"_token": $("input[name=_token]").val(),
				"directory_label": $("#dynamic_dropdown").val(),
				"rule_name": $("#rule_name").val(),
				"submitted_name_1": sub_name_1_txt,
				"submitted_name_2": sub_name_2_txt,
				"submitted_name_3": sub_name_3_txt,
				"submitted_output": sub_output_txt,
				"input_1": inp_1_txt,
				"input_2": inp_2_txt,
				"input_3": inp_3_txt,
				"output": output_txt
			},
			success: function(data) {
				console.log("Record Saved to Database");
				$('#rule_record_table').append(
					"<tr class='item" + data.id + "'>\
						<td class=\"tb_data did\">" + data.id + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_1 + "</td>\
						<td class=\"tb_data\">" + data.input_1 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_2 + "</td>\
						<td class=\"tb_data\">" + data.input_2 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_3 + "</td>\
						<td class=\"tb_data\">" + data.input_3 + "</td>\
						<td class=\"tb_data\">" + data.submitted_output + "</td>\
						<td class=\"tb_data\">" + data.output + "</td>\
						<td class=\"tb_data\">\
							<button type=\"button\" class='edit-modal btn btn-info'>\
								<span class='glyphicon glyphicon-edit'></span> Edit\
							</button>\
							<button type=\"button\" class='duplicate btn btn-success'>\
								<span class='glyphicon glyphicon-repeat'></span> Duplicate\
							</button>\
							<button type=\"button\" class='delete-modal btn btn-danger'>\
								<span class='glyphicon glyphicon-trash'></span> Delete\
							</button>\
						</td> \
					</tr>");
			}
		}); 
	});

	var get_id = "";
	var saved_s_name_1 = "";
	var saved_s_name_2 = "";
	var saved_s_name_3 = "";
	var saved_inp_1 = "";
	var saved_inp_2 = "";
	var saved_inp_3 = "";
	var saved_sub_otpt = ""

	$(document).on("click", ".edit-modal", function() {
		get_id = $(this).parent().parent().find('.did').text();
		saved_s_name_1 = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev('.tb_data').text();
		saved_inp_1 = $(this).parent().prev().prev().prev().prev().prev().prev().prev('.tb_data').text();
		saved_s_name_2 = $(this).parent().prev().prev().prev().prev().prev().prev('.tb_data').text();
		saved_inp_2 = $(this).parent().prev().prev().prev().prev().prev('.tb_data').text();
		saved_s_name_3 = $(this).parent().prev().prev().prev().prev('.tb_data').text();
		saved_inp_3 = $(this).parent().prev().prev().prev('.tb_data').text();		
		saved_sub_otpt = $(this).parent().prev().prev('.tb_data').text();
		$('#rule_modal2').modal('show')
						 .draggable({handle: ".modal-header" });

		// console.log(saved_inp_1);
		$(".sn1_1").children().each(function() {
			if($(this).text() == saved_s_name_1) {
				$(this).attr('selected', true);
			} 
		});

		$(".inp1_1").children().each(function() {
			if($(this).text() == saved_inp_1) {
				$(this).attr('selected', true);
			} else if ($(this).val() == "r(" && saved_inp_1 == "r(") {
				$(this).attr('selected', true);
			} else {
				$(this).attr('selected', false);
			}
		});

		$(".sn2_1").children().each(function() {
			if($(this).text() == saved_s_name_2) {
				$(this).attr('selected', true);
			}
		});	

		$(".inp2_1").children().each(function() {
			if($(this).text() == saved_inp_2) {
				$(this).attr('selected', true);
			} else {
				$(this).attr('selected', false);
			}
		});	

		$(".s_output_1").children().each(function() {
			if($(this).text() == saved_sub_otpt) {
				$(this).attr('selected', true);
			}
		});
		
		$(".output_1").val($(this).parent().prev('.tb_data').text());

	});

	// ------- LOADS SPECIFIC SUB NAMES/INPUTS TO MODAL ON PAGE LOAD -------- //
		function loadNamesAndInputs() {
			var dr_label = $("#dynamic_dropdown").val();
			var rule_name = $("#rule_name").val();

			$.ajax({
				type: 'get',
				url: '{!!URL::to('findProductName')!!}',
				data: {},
				success:function(data) {
					console.log('success');
					console.log(data);
					var sub_names_array = [];
					var input_names_array = [];
					var extracted_submitted_names = '';
					var extracted_part_numbers = '';
					$.each(data, function(index, item) {		
						if (item.directory_label == dr_label) {			
							extracted_submitted_names += $(this).prop('submitted_names');
							extracted_part_numbers += $(this).prop('part_numbers');
						}
					});
					sub_names_array.push(extracted_submitted_names);
					input_names_array.push(extracted_part_numbers);

			  		var sn_list = JSON.parse(sub_names_array);
			  		var pn_list = JSON.parse(input_names_array);

			  		$(".sn1, .sn1_1, .sn2, .sn2_1, .sn3, .sn3_1, .s_output, .s_output_1").empty();
			  		$(".output").val('');
			  		$(".sn1").append('<option value="">Please make a selection</option>');
			  		$(".sn1_1").append('<option value="">Please make a selection</option>');
			  		$(".sn2").append('<option value=""></option>');
			  		$(".sn2_1").append('<option value=""></option>');
			  		$(".sn3").append('<option value=""></option>');
			  		$(".sn3_1").append('<option value=""></option>');
			  		$(".s_output").append('<option value=""></option>');
			  		$(".s_output_1").append('<option value=""></option>');

			  		$(".inp1, .inp1_1, .inp2, .inp2_1, .inp3, .inp3_1").empty();
			  		$(".output_1").val('');
			  		$(".inp1").append('<option value="">Please make a selection</option>'  + '<option value="r(">' + "Required" + "</option>");
			  		$(".inp1_1").append('<option value="">Please make a selection</option>');
			  		$(".inp2").append('<option value=""></option>');
			  		$(".inp2_1").append('<option value=""></option>');
			  		$(".inp3").append('<option value=""></option>');
			  		$(".inp3_1").append('<option value=""></option>');

			  		$(sn_list.split('\n')).each(function(i,o) {
			  			$(".sn1").append("<option>" + $.trim(o) + "</option>")
			  			$(".sn1_1").append("<option>" + $.trim(o) + "</option>")
			  			$(".sn2").append("<option>" + $.trim(o) + "</option>")
			  			$(".sn2_1").append("<option>" + $.trim(o) + "</option>")		
			  			$(".sn3").append("<option>" + $.trim(o) + "</option>")
			  			$(".sn3_1").append("<option>" + $.trim(o) + "</option>")
			  			$(".s_output").append("<option>" + $.trim(o) + "</option>")
			  			$(".s_output_1").append("<option>" + $.trim(o) + "</option>")
			  		});

			  		$(pn_list.split('\n')).each(function(i,o) {
			  			$(".inp1").append("<option>" + $.trim(o) + "</option>")
			  			$(".inp1_1").append("<option>" + $.trim(o) + "</option>")
			  			$(".inp2").append("<option>" + $.trim(o) + "</option>")
			  			$(".inp2_1").append("<option>" + $.trim(o) + "</option>")
			  			$(".inp3").append("<option>" + $.trim(o) + "</option>")
			  			$(".inp3_1").append("<option>" + $.trim(o) + "</option>")
			  		});

			    	$('.sn1 option, .sn1_1 option, .sn2 option:last-child, .sn2_1 option:last-child, .sn3 option:last-child, .sn3_1 option:last-child, .s_output option:last-child,\
			    	   .s_output_1 option:last-child, .inp1 option:last-child, .inp1_1 option:last-child,  .inp2 option:last-child, .inp2_1 option:last-child, .inp3 option:last-child,\
			    	   .inp3_1 option:last-child').each(function() {
			    		if ($(this).text() == "") {
			    			$(this).remove();
			    		}
			    	});	
				},
				error:function(){

				}
			});
		}

	// ------- SAVES THE EDITED RECORDS TO THE EXISTING TABLE ON EDIT PAGE -------- //
	$(".modal-footer").on("click", "#save_edited_record", function() {
		console.log(get_id);
		$.ajax({
			type: "post", 
			url: '{!!URL::to('editItem')!!}',
			data: {
				"_token": $("input[name=_token]").val(),
				"id": get_id,
				"directory_label": $("#dynamic_dropdown").val(),
				"rule_name": $("#rule_name").val(),
				"submitted_name_1": $('.sn1_1').val(),
				"submitted_name_2": $('.sn2_1').val(),
				"submitted_name_3": $('.sn3_1').val(),
				"submitted_output": $('.s_output_1').val(),
				"input_1": $('.inp1_1').val(),
				"input_2": $('.inp2_1').val(),
				"input_3": $('.inp3_1').val(),
				"output": $('.output_1').val()
			},
			success: function(data) {
				console.log("Record updated");
				$('.item' + data.id).replaceWith(
					"<tr class='item" + data.id + "'>\
						<td class=\"tb_data did\">" + data.id + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_1 + "</td>\
						<td class=\"tb_data\">" + data.input_1 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_2 + "</td>\
						<td class=\"tb_data\">" + data.input_2 + "</td>\
						<td class=\"tb_data\">" + data.submitted_name_3 + "</td>\
						<td class=\"tb_data\">" + data.input_3 + "</td>\
						<td class=\"tb_data\">" + data.submitted_output + "</td>\
						<td class=\"tb_data\">" + data.output + "</td>\
						<td class=\"tb_data\">\
							<button type=\"button\" class='edit-modal btn btn-info'>\
								<span class='glyphicon glyphicon-edit'></span> Edit\
							</button>\
							<button type=\"button\" class='duplicate btn btn-success'>\
								<span class='glyphicon glyphicon-repeat'></span> Duplicate\
							</button>\
							<button type=\"button\" class='delete-modal btn btn-danger'>\
								<span class='glyphicon glyphicon-trash'></span> Delete\
							</button>\
						</td>\
					</tr>");
			}
		}); 
	});

	// ------- DELETES RULES FROM EDIT PAGE -------- //
	$(document).on("click", ".delete-modal", function() {
		var c = confirm('Are you sure you want to delete this record?');
		var row_id = $(this).parent().parent().find('.did').text();
		if (c == true) {
			$.ajax({
				type: "post",
				url: '{!!URL::to('deleteRecordAjax')!!}',
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