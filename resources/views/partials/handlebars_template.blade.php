	<!-- /////////////////////////// HANDLEBARS SCRIPTING FOR BOOTSTRAP MODAL EDITING ///////////////////////////////// -->

	<script id="control-customize-template" type="text/x-handlebars-template">
				<div class="modal-body">
					<form id="theForm" class="form-horizontal">
						<input type="hidden" value="@{{type}}" name="type">
						<input type="hidden" value="@{{ctrl_ID}}" name="ctrl_ID">
						@{{{content}}}
					</form>
				</div>
				<div class="modal-footer">
						<button class="btn btn-primary" type="submit" data-dismiss="modal" onclick='save_customize_changes()'>Save changes</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick='delete_ctrl()'>Delete</button>
				</div>	
	</script>

	<script id="category-template" type="text/x-handlebars-template">
		<p><label class="control-label">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
	</script>

	<script id="section-template" type="text/x-handlebars-template">
		<div class="checkbox">
		    <label>
		      <input type="checkbox" id="checksExclusivity" name="selectedBox" value="" checked>If checked, only 1 "Required" button can be selected in this section.
		    </label>
		    <label>
		      <input type="checkbox" id="oneRequired" name="min_one_required" value="">At least 1 "Required" button will be checked.
		    </label>
		    <label>
		      <input type="checkbox" id="hideChildren" name="hide_children" value="">Hide controls for this section.
		    </label>			    		    
		</div>
		<br>
		<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
	</script>

	<script id="radio-template" type="text/x-handlebars-template">
		<div class="row" style="padding-bottom: 5px">
			<div class="col-md-6"><input type="checkbox" id="radio_required" name="required_chkbox" style="margin-left: 20px; margin-right: 5px">Required by Default</div>
		</div>
		<div class="row" style="padding-bottom: 5px">
			<div class="col-md-6"><input type="checkbox" id="hide_btns" name="hide_chkbox" style="margin-left: 20px; margin-right: 5px">Required Only</div>
		</div>
				<div class="row" style="padding-bottom: 10px">
			<div class="col-md-6"><input type="checkbox" id="hide_optional" name="hide_opt" style="margin-left: 20px; margin-right: 5px">Hide Optional</div>
		</div>
		<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p> 
		<p id="part_number_tag"><label class="control-label">Part Number</label><input class="form-control dontAllowSpaces" id="getValue" type="text" name="value" placeholder="(Part#)" style="width: 50%"></p>
		<p><label class="control-label">Submitted Name</label><input class="form-control dontAllowSpaces" id="ron_sn" type="text" name="radio_name" style="width: 50%">
		</p>		
	</script>

	<script id="select-one-template" type="text/x-handlebars-template">
		<div class="row">
			<input type="checkbox" id="select_one_required" name="dropdown_required_chkbox" style="margin-left: 20px; margin-right: 5px">Required?</p>
		</div>
		<div class="row">
		  <p>
		  	<label class="control-label">Optional Label</label> <input class="form-control col-md-8" type="text" name="label" value="" placeholder="optional" style="width: 50%">
		  </p>
		</div>
		<div class="row">  
		  <p><label class="control-label">Submitted Name</label> 
		  		<input id="dropdown_input" type="text" list="sub_name_options" name="submitted_name" class="col-md-8" style="width: 50%">
		  		<p class="col-md-2" id="clear_input"><a>clear</a></p>
		  		<datalist id="sub_name_options">
		  			<option value="Machine Model">
		  			<option value="Machine Electrical">
		  			<option value="Head 1">
		  			<option value="Head 2">
		  			<option value="Head 3">
		  			<option value="Pump Electrical">
		  			<option value="Table Surface">
		  			<option value="Vacuum Pump">
		  			<option value="Vacuum Pump 2">
		  		</datalist>
		   </p> 
		</div>
		<div class="row">
		  <div class="col-md-6">
		    <p><label class="control-label">Option(s)</label>
		      <textarea class="form-control" id="textarea_option" name="options" rows="5" cols="40"></textarea>
		    </p>
		  </div>
		  <div class="col-md-6">
		    <p><label class="control-label" style="font-size: small; margin-left: 70px;">Part Number(s)</label>
		      <textarea class="form-control" id="textarea_part_number" name="value" rows="5" cols="40"></textarea>
		    </p>
		  </div>	
		</div>
	</script>

	<script id="selectmultiplelist-template" type="text/x-handlebars-template">
		<div class="row">
		  <p>
		  	<label class="control-label">Optional Label</label> <input class="form-control col-md-8" type="text" name="label" value="" placeholder="optional" style="width: 50%">
		  </p>
		</div>
		<div class="row">  
		  <p><label class="control-label">Submitted Name</label> <input class="form-control" type="text" name="submitted_name" value="" style="width: 50%" required /></p>	  
		</div>
		<div class="row">
		  <div class="col-md-6">
		    <p><label class="control-label">Option(s)</label>
		      <textarea class="form-control" id="textarea_option_mult" name="options" rows="5" cols="40"></textarea>
		    </p>
		  </div>
		  <div class="col-md-6">
		    <p><label class="control-label" style="font-size: small; margin-left: 70px;">Part Number(s)</label>
		      <textarea class="form-control" id="textarea_part_number_mult" name="value" rows="5" cols="40"></textarea>
		    </p>
		  </div>	
		</div>
	</script>

	<script id="number-template" type="text/x-handlebars-template">
		<div class="row">
			<p><label class="control-section">Optional Label</label><input class="form-control" type="text" name="number_label" style="width: 50%"></p>
		</div>
		<div class="row">	
			<p><label class="control-section">Name</label><input class="form-control" type="text" name="submitted_name" style="width: 50%" required /></p>		
		</div>
		<div class="row">
			<div class="col-md-3">
				<p><label>Default</label><input class="form-control" type="number" name="default" min="0" value=""></p>
			</div>			
			<div class="col-md-3">
				<p><label>Min</label><input class="form-control" type="number" name="min" min="0" value=""></p>
			</div>
			<div class="col-md-3">	
				<p><label>Max</label><input class="form-control" type="number" name="max" min="0" value=""></p>
			</div>
			<div class="col-md-3">	
				<p><label>Step</label><input class="form-control" type="number" name="step" min="0" value=""></p>
			</div>
		</div>
	</script>

	<script id="unordered_list-template" type="text/x-handlebars-template">
		<p><label class="control-label">Text</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
	</script>

	<script id="button-template" type="text/x-handlebars-template">
		<div class="row">
			<p><label class="control-section">Label</label><input class="form-control" type="text" name="button_label" placeholder="Docs" style="width: 50%"></p>
		</div>
		<div class="row"> 
			<p><label class="control-label">Style</label></p>
				<div class="button_group" role="group">
					<a value="default" type="button" class="btn-xs btn btn-default type_btns">Default</a>
					<a value="danger" type="button" class="btn-xs btn btn-danger type_btns">Danger</a>
					<a value="info" type="button" class="btn-xs btn btn-info type_btns">Info</a>
					<a value="primary" type="button" class="btn-xs btn btn-primary type_btns">Primary</a>
					<a value="success" type="button" class="btn-xs btn btn-success type_btns">Success</a>
					<a value="warning" type="button" class="btn-xs btn btn-warning type_btns">Warning</a>
				</div>
		</div>
		<div class="row" style="margin-top: 15px">		
			<p><label class="control-label">File Path</label><input class="form-control" type="text" name="file" placeholder="Docs" style="width: 50%"></p>
		</div>	
	</script>

	<script>
		// COMPILE THE TEMPLATES FOR USE

		function compileTemplates() {
			window.templates = {};
			window.templates.common = Handlebars.compile($("#control-customize-template").html());

			window.templates.category = Handlebars.compile($("#category-template").html());
	    	window.templates.section = Handlebars.compile($("#section-template").html());
			window.templates.select_one = Handlebars.compile($("#select-one-template").html());
			window.templates.selectmultiplelist = Handlebars.compile($("#selectmultiplelist-template").html());
			window.templates.radiogroup = Handlebars.compile($("#radio-template").html());
			window.templates.number = Handlebars.compile($("#number-template").html());
			window.templates.unordered_list = Handlebars.compile($("#unordered_list-template").html());
			window.templates.button = Handlebars.compile($("#button-template").html());			
		}

		// Object containing specific "Load/Save Values" method
		var save_changes = {};
		var load_values = {};
		var model = {};

		/* Common method for all controls with Label and Name */
		load_values.common = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#"+ctrl_id);
			form.find("[name=label]").val(div_ctrl.find('.control-label, .control-section').eq(0).text())
			var specific_load_method = load_values[ctrl_type];
			if(typeof(specific_load_method)!='undefined') {
				specific_load_method(ctrl_type, ctrl_id);
			}
		}

		/* Specific method to load values from a category control to the customization dialog */
		load_values.category = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
			var ctrl = div_ctrl.find("input")[0];		
		}

	  /* Specific method to load values from a section control to the customization modal */
	  	load_values.section = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
	  		var thisLabel = (div_ctrl.find('.required_radio'));		
			var ctrl = div_ctrl.find("input")[0];
			$("#checksExclusivity").prop('checked', model[ctrl_id].mutex);
			$("#oneRequired").prop('checked', model[ctrl_id].one_required);	
			$("#hideChildren").prop('checked', model[ctrl_id].hide_children);		
		}


		/* Specific method to load values from a select_one control to the customization modal */
		load_values.select_one = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
			var ctrl = div_ctrl.find("select")[0];
			form.find("[name=name]").val(ctrl.name);
	    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
	    	form.find("[name=submitted_name]").val(div_ctrl.find('.group1').attr('name'));
	    	$('#select_one_required').prop('checked', model[div_ctrl.prop('id')].required_field);

			var options = '';
	    	var parts = '';


			$(form).parent().parent().find(".modal-footer").append('<p class="col-md-2" id="add_break"><a>Add Break</a></p><br><p style="text-align:left"><b>Part numbers cannot contain spaces.</b><br><b>Part numbers must be wrapped in parentheses.</b></p><p style="color: red; text-align:left">Note: The first entry always defaults to "Please make a selection"</p>');

			$("#add_break").click(function() {
				$("#textarea_option").val($('#textarea_option').val() + "\n" + "-----------");
				$("#textarea_part_number").val($('#textarea_part_number').val() + "\n" + "-----------");
			});

			$(ctrl).parent().find('.group1').children().each(function(i,o) { options += o.text + '\n'; });
			form.find("[name=options]").val($.trim(options));

	    	$(ctrl).parent().find('.group2:hidden').children().each(function(i,o) { parts += o.text + '\n'; });
			form.find("[name=value]").val($.trim(parts));
			
		  	$('#clear_input').on('click', function(e) {
		  		$('#dropdown_input').val('');
		  	});	
		}

		/* Specific method to load values from a multiple select control to the customization modal */
		load_values.selectmultiplelist = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
			var ctrl = div_ctrl.find("select")[0];
			form.find("[name=name]").val(ctrl.name);
	    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
	    	form.find("[name=submitted_name]").val(div_ctrl.find('.group3').attr('name'));

			var options = '';
	    	var parts = '';
	    	
			$(form).parent().parent().find(".modal-footer").append('<p class="col-md-2" id="add_break"><a>Add Break</a></p><br><p style="text-align:left"><b>Part numbers cannot contain spaces.</b><br><b>Part numbers must be wrapped in parentheses.</b></p><p style="color: red; text-align:left">Note: The first entry always defaults to "Please make a selection"</p>');

	    	$("#add_break_mult").click(function() {
				$("#textarea_option_mult").val($('#textarea_option_mult').val() + "\n" + "-----------");
				$("#textarea_part_number_mult").val($('#textarea_part_number_mult').val() + "\n" + "-----------");
			});

			$(ctrl).parent().find('.group3').children().each(function(i,o) { options += o.text + '\n'; });
			form.find("[name=options]").val($.trim(options));
	    
	    	$(ctrl).parent().find('.group4:hidden').children().each(function(i,o) { parts += o.text + '\n'; });
			form.find("[name=value]").val($.trim(parts));
		}


	  	/* Specific method to load values from a radio button control to the customization modal */
		load_values.radiogroup = function(ctrl_type, ctrl_id) {
			var form = $("#theForm"); 
			var div_ctrl = $("#" + ctrl_id);
			form.find("[name=label]").val(div_ctrl.find('.makeBold').text().trim());
	    	var trimText = (div_ctrl.find('.placeHolderClass').attr('value'));

			$(form).parent().parent().find(".modal-footer").append('<p class="col-md-6"><b>Part numbers must be wrapped in parentheses.</b></p>');	    	

	    	form.find("[name=value]").val(trimText);
	    	var sub_name = div_ctrl.find('.required_radio').attr('name');
	    	var afterUnderScore = sub_name.substr(sub_name.indexOf("__") + 2);
	    	
	    	if (div_ctrl.find('.required_radio').attr('name') == "radioField") {
	    		form.find("[name=radio_name]").val('');
	    	} else {
	    		form.find("[name=radio_name]").val(afterUnderScore);
	    	}

	    	console.log(model);
	    	$('#radio_required').prop('checked', model[ctrl_id].required_field);
	    	$('#hide_btns').prop('checked', model[ctrl_id].required_only);
	    	$('#hide_optional').prop('checked', model[ctrl_id].hide_optional);
	    	deleteSpaces();
	  	}

	  	/* Specific method to load values from a radio button control to the customization modal */
	  	load_values.number = function(ctrl_type, ctrl_id) {
	  		var form = $('#theForm');
	  		var div_ctrl = $("#" + ctrl_id);
			form.find("[name=number_label]").val(div_ctrl.find('.number_option').text());
			form.find("[name=submitted_name]").val(div_ctrl.find('.ctrl-number').attr('name'));
			form.find("[name=default]").val(div_ctrl.find('.ctrl-number').attr('value'));
			form.find('[name=min]').val(div_ctrl.find('.ctrl-number').attr('min'));
			form.find("[name=max]").val(div_ctrl.find('.ctrl-number').attr('max'));
			form.find("[name=step]").val(div_ctrl.find('.ctrl-number').attr('step'));

			deleteSpaces();
	  	}

	/* Specific method to load values from a category control to the customization dialog */
		load_values.unordered_list = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
			var ctrl = div_ctrl.find("input")[0];
			form.find("[name=label]").val(div_ctrl.find('.ul_label').text());		
		}

		load_values.button = function(ctrl_type, ctrl_id) {
			var form = $("#theForm");
			var div_ctrl = $("#" + ctrl_id);
	    	form.find("[name=button_label]").val(div_ctrl.find('a').text());
	    	var str = div_ctrl.find('a').attr('href');
	    	if(str != undefined) {
	    		var post_dl_string = str.substr(str.indexOf("/") + 1);
	    		form.find("[name=file]").val(post_dl_string);
	    	}
	    	
	    	

	    	$(".type_btns").on("click", function() {
	    		if($(this).hasClass('btn-default')) {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-default');
	    		} else if ($(this).hasClass('btn-danger')) {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-danger');
	    		} else if ($(this).hasClass('btn-info')) {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-info');
	    		} else if ($(this).hasClass('btn-primary')) {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-primary');
	    		} else if ($(this).hasClass('btn-success')) {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-success');
	    		} else {
	    			div_ctrl.find('a').removeClass();
	    			div_ctrl.find('a').addClass('btn btn-warning');
	    		}
	    	});
	  	}

		/* Common method to save changes to a control - This also calls the specific methods */
		save_changes.common = function(values) {
			var div_ctrl = $("#" + values.ctrl_ID);
			div_ctrl.find('.control-label, .control-section').eq(0).text(values.label);

			var specific_save_method = save_changes[values.type];
			if(typeof(specific_save_method) != 'undefined') {
				specific_save_method(values);
			}
		}

		save_changes.category = function(values) {
			var div_ctrl = $("#" + values.ctrl_ID);
			var ctrl = div_ctrl.find("input")[0];
		}

	   /* Specific method to save the Section name and logic that either gives radio button attribute names the section name or the name of the "option" label in its particular radio group */ 
	  	save_changes.section = function(values) {
		    console.log(values);
				var div_ctrl = $("#" + values.ctrl_ID);
				var ctrl = div_ctrl.find("input")[0];

		    var $radio_buttons = div_ctrl.find("[type='radio']");
		    var checkBoxStatus = values.selectedBox;
		    var min_one_required_status = values.min_one_required;


		   	model[values.ctrl_ID].mutex = $('#checksExclusivity').prop('checked');
		   	model[values.ctrl_ID].one_required = $('#oneRequired').prop('checked');
		   	model[values.ctrl_ID].hide_children = $('#hideChildren').prop('checked');

		   	console.log(model);

		    if(checkBoxStatus == true) {
			    $.each(div_ctrl.find(".panel-body").children(), function(index, section_child) {
			    	var parent = $(this).prop('id');
			    	console.log(parent);
			    	if($(this).children().hasClass('ctrl-radiogroup')) {
				    	var prefix = $(this).find('input[type="radio"]').attr('name').split("__")[0];
				    	var suffix = $(this).find('input').attr('name').split("__")[1];
				    	$(this).find('input').attr('name', prefix.replace($(this).find('input').attr('name').split("__")[0], values.label.replace(/\s/g,'') + "__" + suffix));
			    	}
			    });   
		    } else {
		        $.each(div_ctrl.find(".panel-body").children(), function(index, section_child) {
		          var id_number = ($(this).prop('id'));
  			    	if($(this).children().hasClass('ctrl-radiogroup')) {
				    	var prefix = $(this).find('input[type="radio"]').attr('name').split("__")[0];
				    	var suffix = $(this).find('input').attr('name').split("__")[1];
				    	$(this).find('input').attr('name', (id_number.replace(/[^0-9]/g,'') - 3001) + prefix.replace($(this).find('input').attr('name').split("__")[0], values.label.replace(/\s/g,'') + "__" + suffix));
			    	}
		        });	
		    }

		    if(min_one_required_status == true) {
		    	div_ctrl.addClass('require_one');
		    } else {
		    	div_ctrl.removeClass('require_one');
		    }

		    if(values.hide_children == true) {
		    	div_ctrl.find('.section-body').children().hide();
		    } else {
		    	div_ctrl.find('.section-body').children().show();
		    }
		}

	 	save_changes.select_one = function(values) {
			console.log(values);
			var div_ctrl = $("#" + values.ctrl_ID);
			var ctrl = div_ctrl.find("select")[0];
			values.submitted_name = $("[name=submitted_name]").val();
		    div_ctrl.find('.group1').attr('name', values.submitted_name);
		    ctrl.value = values.value;

		    model[values.ctrl_ID].required_field = $('#select_one_required').prop('checked');

		/**
		* Clear the option(s) textarea and append the newly entered values
		**/

			$(ctrl).empty();
	   
			$(values.options.split('\n')).each(function(i,o) {
	      		$(ctrl).append("<option>" + $.trim(o) + "</option>");
			});

		/**
		* Clear the part number(s) textarea and append the newly entered values
		**/

	    	$(ctrl).parent().find("select.group2").empty();

			$(values.value.split('\n')).each(function(i,o) {
				$(ctrl).parent().find("select.group2").append("<option>" + $.trim(o) + "</option>");
			});		

			var index_number = (values.ctrl_ID.replace(/\D/g,'') - 3001);

			// delete model[div_ctrl.parent().parent().prop('id')].controls[index_number].pairs;

		    //Objects containing the saved options and part numbers
		    var optionsObject = $(values.options.split('\n'));
		    var partsObject = $(values.value.split('\n'));
		    
		    //Conversion of the options Object to an array
		    var optionsArray = $.map(optionsObject, function(value, index) {
		      return [value];
		    });
		    //Conversion of the parts Object to an array
		    var partsArray = $.map(partsObject, function(value, index) {
		      return [value];
		    });

		    /* Assigning unique id's to the generated options */
		    var $individualOption = div_ctrl.find("option");        
			var optionCount = 0;  
		    $individualOption.each(function() {
		      	if ($(this).parent().is(".group1")) {	      
			      $(this).attr('class', 'generatedOptions');
				  $(this).attr('value', partsArray[optionCount]);
		      	}       
				optionCount++;	
		    });		
			
			if(values.dropdown_required_chkbox == true) {
				div_ctrl.find('.group1').addClass('required');
			} else {
				div_ctrl.find('.group1').removeClass('required');
			}
		}
		 
		save_changes.radiogroup = function(values) {
			console.log(values);
		    var form = $("#theForm");
			var div_ctrl = $("#" + values.ctrl_ID);
			var parent_text = div_ctrl.parent().parent().find('.ctrl-section').text();
		    div_ctrl.find('.makeBold').text(values.label);
			div_ctrl.find('.required_radio, .optional_radio, .na_radio, .placeHolderClass').attr('name', parent_text.replace(/\s/g,'') + "__" + values.radio_name);

		    model[values.ctrl_ID].required_field = $('#radio_required').prop('checked');
		    model[values.ctrl_ID].required_only = $('#hide_btns').prop('checked');
		    model[values.ctrl_ID].hide_optional = $('#hide_optional').prop('checked');

		    if(values.required_chkbox == true) {
		    	$("#" + values.ctrl_ID).find('.na_radio').attr('checked', false);
		    	$("#" + values.ctrl_ID).find('.required_radio').attr('checked', true);
		    } else {
		    	$("#" + values.ctrl_ID).find('.na_radio').attr('checked', true);
		    	$("#" + values.ctrl_ID).find('.required_radio').attr('checked', false);		    	
		    }

		    if(values.hide_chkbox == true) {
		    	$(div_ctrl).find(".optionField").hide();
		    	$(div_ctrl).find(".naField").hide();
		    } else if (values.hide_opt == true) {
		    	$(div_ctrl).find(".optionField").hide();
		    	$(div_ctrl).find(".naField").show();
			} else {
		    	$(div_ctrl).find(".optionField").show();
		    	$(div_ctrl).find(".naField").show();
		    }
		   
		    var $radioValues = div_ctrl.find("[type='radio']");
		    var generatedValue = values.value;
			    $radioValues.each(function() {
			      var $data = $(this);
			      
				      if($data.hasClass('required_radio')) {
				        $data.val('r' + generatedValue);
				      } else if ($data.hasClass('optional_radio')) {
				        $data.val('o' + generatedValue);   
				      } else if ($data.hasClass('na_radio')) {
				        $data.val('n' + generatedValue);              
				      } else {
				        $data.val(generatedValue);
				      }

				});  
		} 

	/* Specific method to save Options and their corresponding Part Numbers */
	 	save_changes.selectmultiplelist = function(values) {
			console.log(values);
			var div_ctrl = $("#" + values.ctrl_ID);
			var ctrl = div_ctrl.find("select")[0];
			div_ctrl.find('.group3').attr('name', values.submitted_name);
	    
			$(ctrl).empty();
	   
	    /* Creates an Options Object with the values entered split on a new line */
			$(values.options.split('\n')).each(function(i,o) {
	      		$(ctrl).parent().find(".group3").append("<option>" + $.trim(o) + "</option>");
			});
	    
		/* Creates an Options Object with the values entered split on a new line */
		    $(ctrl).parent().find("select.group4").empty();
		    
		    var data2 = $(values.value.split('\n'));
		    $.each(data2, function(key, value) {
		      $(ctrl).parent().find('select.group4')
		        .append($("<option></option>")
		                .attr("value", key)
		                .text(value));
		    });
		     ctrl.value = values.value;
		    
		    /* Objects containing the saved options and part numbers */
		    var optionsObject = $(values.options.split('\n'));
		    var partsObject = $(values.value.split('\n'));
		    
		    /* Conversion of the Options Object to an array */
		    var optionsArray = $.map(optionsObject, function(value, index) {
		      return [value];
		    });
		    
		    /* Conversion of the parts Object to an array */
		    var partsArray = $.map(partsObject, function(value, index) {
		      return [value];
		    });
		    
		    
		    /* Assigning unique id's to the generated options and temporary method of linking the optionsArray and partsArray indices */
		    var $individualOption = div_ctrl.find("option");        
			var optionCount = 0;  
		    	$individualOption.each(function() {
		   	  
			      	if ($(this).parent().is(".group3")) {	      
				      $(this).attr('class', 'generatedOptions');
					  $(this).attr('value', '(' + partsArray[optionCount] + ')');
			      	}       
					optionCount++;	
			    });
	    
		}

		save_changes.number = function(values) {
			console.log(values);
			var form = $('#theForm');
			var div_ctrl = $("#" + values.ctrl_ID);
			div_ctrl.find('.number_option').text(values.number_label);
			div_ctrl.find('.ctrl-number').attr('name', values.submitted_name);
			div_ctrl.find('.ctrl-number').attr('value', values.default);
			div_ctrl.find('.ctrl-number').attr('min', values.min);
			div_ctrl.find('.ctrl-number').attr('max', values.max);
			div_ctrl.find('.ctrl-number').attr('step', values.step);

		}

		save_changes.unordered_list = function(values) {
			var div_ctrl = $("#" + values.ctrl_ID);
			var ctrl = div_ctrl.find("input")[0];
			div_ctrl.find('.ul_txt').text(values.label);
			values.submitted_name = div_ctrl.attr('name');
		}

		save_changes.button = function(values) {
			console.log(values);
			var div_ctrl = $("#" + values.ctrl_ID);
			var ctrl = div_ctrl.find("input")[0];
			div_ctrl.find('a').text(values.button_label);
			div_ctrl.find('a').attr('href', "dl/" + values.file);
		}


		function save_customize_changes(e, obj) {
			console.log('save clicked', arguments);
			var formValues = {};
			var val = null;
			$("#theForm").find("input, textarea, select, span").each(function(i,o) {
				if(o.type == "checkbox"){
					val = o.checked;
				} else {
					val = o.value;
				}
				formValues[o.name] = val;
			});

			save_changes.common(formValues);
		}

		/*
			Opens the customization modal for this
		*/ 

		function customize_ctrl(ctrl_type, ctrl_id) {
			console.log(ctrl_type);
			var ctrl_params = {};

			/* load the specific template */
			var specific_template = templates[ctrl_type];

			if(typeof(specific_template) == 'undefined') {
				specific_template = function() {return ''; };
			}

			var template_params = {
				// header: modal_header,
				content: specific_template(ctrl_params),
				type: ctrl_type,
				ctrl_ID: ctrl_id
			}

			// Pass the parameters - along with the specific template content to the Base template
			var s = templates.common(template_params) + "";

			$("[name=customization_modal]").remove(); // Making sure that we just have one instance of the modal opened and not leaking
			$('<div class="modal fade" tabindex="-1" id="customization_modal" role="dialog" name="customization_modal" style="position: fixed;" />').append(s).modal('show').draggable({handle: ".modal-body"});

			$('#customization_modal').find('#theForm');

			setTimeout(function() {
				//For some error in the code modal show event is not firing - applying a manual delay before load
				load_values.common(ctrl_type, ctrl_id);

			},300);

		}

			/* Delete the control from the form */
		function delete_ctrl() {
			if(window.confirm("Are you sure about this?")) {
				var ctrl_id = $("#theForm").find("[name=ctrl_ID]").val();
				console.log(ctrl_id + " " + "DELETED");

				for (key in model) {
					if (key == ctrl_id) {
						delete model[key];
					}	
				}

				console.log("model", model);
				$("#"+ctrl_id).remove();
			}
		}

	    function deleteSpaces(event, ui) {
		    $('.dontAllowSpaces').keyup(function(e) {
		      	var partNumberValue = document.querySelectorAll('[id^="getValue"]');
		     	var s = partNumberValue[0].value;
		      
			    if(e.which === 32) {
			        alert('This input cannot contain spaces.');
			        var str = $(this).val();
			        str = str.replace(/\s/g,'');
			        $(this).val(str);
			    }
			    
		    }).blur(function() {
		      var str = $(this).val();
		      str = str.replace(/\s/g,'');
		      $(this).val(str);
		    });
	  	}
	  	

	  	/* --------- METHODS FOR RETREIVING A SAVED CONFIGURATION ---------- */
		var globalFormObject = {is_retrieving: false};
		var _cat_index = 1001;
		var _sect_index = 2001;
		var _ctrl_index = 3001;

	  	$('#retrieve').click(function() {

			if(($('#mock_database')).val() == '') {
	  			alert("Invalid Configuration");
	  			return globalFormObject.is_retrieving = false;
	  		}

	  		globalFormObject.is_retrieving = true;
	  		var obj = JSON.parse($('#mock_database').val());
	  		console.log(obj);
	  		globalFormObject.obj = obj;
	  		globalFormObject.cat_index = 0;
	  		globalFormObject.sect_index;
	  		globalFormObject.control_index;
	  		globalFormObject.select_one__pairs_index;

	  		$('[id^="CTRL-DIV"]').remove();
	  		model = {};
			_cat_index = 1001;
			_sect_index = 2001;
			_ctrl_index = 3001;

	  		if (obj.type == "configuration" && obj.categories.length > 0) {
	  			$("#form-title").val(obj.title);
	  			$("#sfpc").val(obj.salesforce_product_code);
	  			$("#image_filename").val(obj.machine_image);

		  		$.each(obj.categories, function(index, cat_obj) {
					$title = cat_obj.label;
					var array_sects = cat_obj.sections;

		  			if(cat_obj.type == "category") {
		  				globalFormObject.sect_index = 0;
		  				$("#trigger_cat").click();				
		  			}
			
		  			$.each(array_sects, function(index, sects_obj) {
		  				$section = $(this);
		  				sect_controls = sects_obj.controls;

						if (($section.prop('type')) == "section") {
							globalFormObject.control_index = 0;
							$("#trigger_sect").click();
						}

						$.each(sect_controls, function(index, value) {
							$single_ctrl = $(this);
							if (($single_ctrl.prop('type')) == "ctrl-select-one") {
								globalFormObject.select_one_pairs_index = 0;
								$("#trigger_combo").click();
	
							} else if (($single_ctrl.prop('type')) == "ctrl-ron") {
								$("#trigger_radio").click();

							} else if (($single_ctrl.prop('type')) == "ctrl-select-multiple") {
								$("#trigger_mult").click();
												
							} else if ($single_ctrl.prop('type') == "ctrl-number") {
								$("#trigger_number").click();

							} else if ($single_ctrl.prop('type') == "ctrl-unordered_list") {
								$("#trigger_ul").click();

							} else {
								($single_ctrl.prop('type') == "ctrl-button")
								$("#trigger_btn").click();								
							}

						});

		  			});

		  		});
		  			
	  		} else {
		  		alert('Invalid Configuration');
		  	}
		  	globalFormObject.is_retrieving = false;
	  	});

	  	/* --------- METHODS FOR SERIALIZING THE WORK CONFIGURATION ---------- */

	  	$('#serialize').click(function() {
	  		
	  		var config = {
	  						type: "configuration",
	  						directory_label: $("#form_title").val(),
	  						salesforce_product_code: $("#sfpc").val(),
	  						machine_image: $("#image_filename").val(),
	  						cutting_technology: $('[name="cutting_technology"]:checked').val(),
	  						categories: []
	  					};	

	  		$('#work-area').children().each(function() {
	  			addNode(config, this);
	  		});

	  		// $(ctrl).parent().find('.group1').children().each(function(i,o) { options += o.text + '\n'; });
	    	var submitted_name_array = $('#work-area').find('.group1, .group3, .required_radio');
	    	var rules = '';
	    	submitted_name_array.each(function(i, o) {
	    		rules += $(this).attr('name') + '\n';
	    	});

	    	var part_numbers_array = $('#work-area').find('.group1 option, .group3 option');
	    	var rules2 = '';
	    	part_numbers_array.each(function(i, o) {
	    		rules2 += $(this).val() + '\n';
	    	});

	        var selected_content = $("#inner_wrap").clone();
	        selected_content.find("div").each(function(i,o) {
	          var obj = $(o);
	          obj.removeClass("draggableField droppedElem ui-draggable well ui-droppable ui-sortable");
	        });

		    var str = (selected_content.prop('outerHTML'));    	

	  		console.log(JSON.stringify(config, true, 3));
	  		$("#mock_database").empty();
	  		$("#mock_database").val(JSON.stringify(config,true, 2));
	  		$("#mdb_2").empty();
	  		$("#mdb_2").val(str);
	  		$("#mdb_3").empty();
	  		$("#mdb_3").val(JSON.stringify(rules));
	  		$("#mdb_4").empty();
	  		$("#mdb_4").val(JSON.stringify(rules2));
	  	});

		function addNode(parent, node) {

			var ctrl = $(node).find("[class*=ctrl]")[0];

			var category_config = {
					 	type: $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
					 	label: $(node).find('.ctrl-category').text(),
					 	id: node.id, 
					 	sections: []
			}

			$(node).find('.droppedSect').each(function() {
				var $sects = $(this);
				console.log($(this).prop('id'));
				var ctrl2 = ($(node).find('.droppedSect').find("[class*=ctrl]")[0]);
				var section_config = {
								type: $.trim(ctrl2.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
								label: $sects.find('.ctrl-section').text(),
								// id: $sects.prop('id'),
								mutex: model[$sects.prop('id')].mutex,
								one_required: model[$sects.prop('id')].one_required,
								hide_children: model[$sects.prop('id')].hide_children,
								controls: []
							};

				category_config.sections.push(section_config);

				$sects.find('.droppedElem').each(function() {
					var $user_ctrls = $(this);

					console.log($(this).prop('id'));						
					if ($user_ctrls.find('.ctrl-select_one').length != 0) {
						var select_one_config = {
							type: "ctrl-select-one",
							name: $user_ctrls.find('.group1').attr('name'),
							label: $user_ctrls.find('.optional_label').text(),
							id: $user_ctrls.prop('id'),
							required_field: model[$user_ctrls.prop('id')].required_field,
							pairs: []
						};	

						section_config.controls.push(select_one_config);
						if($user_ctrls.find('.group1').find('option').length != 0) {
							$user_ctrls.find('.group1').find('option').each(function() {
								var $select_one_pairs = {
											type: "pair", 
											n: $(this).text(), 
											v: $(this).attr("value")
										};
									select_one_config.pairs.push($select_one_pairs);
							});	
						}

					} else if ($user_ctrls.find('.ctrl-radiogroup').length != 0) {
						// console.log($user_ctrls.attr('name'));
						var radiogroup_config = {
									type: "ctrl-ron",
									label: $user_ctrls.find('.makeBold').text(),
									required_field: model[$user_ctrls.prop('id')].required_field,
									required_only: model[$user_ctrls.prop('id')].required_only,
									hide_optional: model[$user_ctrls.prop('id')].hide_optional,
									id: $user_ctrls.prop('id'),
									pairs: []
						};		

						section_config.controls.push(radiogroup_config);
						var $radioValues = $user_ctrls.find("[type='radio']");
							$radioValues.each(function() {
								var $data = $(this);
								if($data.hasClass('placeHolderClass')) {
									var $radio_attr = {
											type: "pair", 
											n: $data.attr('name'), 
											v: $data.attr('value')
										};
									radiogroup_config.pairs.push($radio_attr);	
								}
							});

					} else if ($user_ctrls.find('.group3').find('option').length != 0) {
						var select_multiple_config = {
									type: "ctrl-select-multiple",
									name: $user_ctrls.find('.group3').attr('name'),
									label: $user_ctrls.find('.optional_label_mult').text(),
									id: $user_ctrls.prop('id'),
									pairs: []
						};

						section_config.controls.push(select_multiple_config);
							$user_ctrls.find('.group3').find('option').each(function() {
								var $select_mult_pairs = {
											type: "pair", 
											n: $(this).text(), 
											v: $(this).attr("value")	
									};
									select_multiple_config.pairs.push($select_mult_pairs);
							});

					} else if ($user_ctrls.find('.ctrl-number').length != 0) {
						var number_config = {
									type: "ctrl-number",
									name: $user_ctrls.find('.ctrl-number').attr('name'),
									label: $user_ctrls.find('.number_option').text(),
									id: $user_ctrls.prop('id'),
									default: $user_ctrls.find('.ctrl-number').val(),
									min: $user_ctrls.find('.ctrl-number').attr("min"),
									max: $user_ctrls.find('.ctrl-number').attr("max"),
									step: $user_ctrls.find('.ctrl-number').attr("step")
						};
						section_config.controls.push(number_config);
					} else if ($user_ctrls.find('.ctrl-unordered_list').length != 0) {
						var ul_config = {
									type: "ctrl-unordered_list",
									label: $user_ctrls.find('.ul_txt').text()
						};						
						section_config.controls.push(ul_config);	
					} else {
						var button_config = {
									type: "ctrl-button",
									label: $user_ctrls.find('a').text(),
									class: $user_ctrls.find('a').attr('class'),
									url: $user_ctrls.find('a').attr('href')
						};						
						section_config.controls.push(button_config);							
					}

				});
				
			});

		// console.log(model);
		parent.categories.push(category_config);
					
		}

</script>