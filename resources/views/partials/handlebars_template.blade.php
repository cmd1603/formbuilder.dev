
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
	</div>
	<br>
	<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
</script>

<script id="radio-template" type="text/x-handlebars-template">
	<div class="row">
		<input type="checkbox" id="radio_required" name="required_chkbox" style="margin-left: 20px; margin-right: 5px">Required?</p>
	</div>
	<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></input></p> 
	<p><label class="control-label">Part Number</label><input class="form-control dontAllowSpaces" id="getValue" type="text" name="value" placeholder="Part#" style="width: 50%"></p>
<!-- 	<p><label class="control-label">Submitted Name</label> <input class="form-control" type="text" name="submitted_name" value="" style="width: 50%" required /></p> -->
</script>

<script id="select-one-template" type="text/x-handlebars-template">
	<div class="row">
		<input type="checkbox" id="select_one_required" name="required_chkbox" style="margin-left: 20px; margin-right: 5px">Required?</p>
	</div>
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
		<input type="checkbox" id="select_mult_required" name="required" style="margin-left: 20px; margin-right: 5px">Required?</p>
	</div>
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
		<input type="checkbox" id="number_required" name="required" style="margin-left: 20px; margin-right: 5px">Required?</p>
	</div>
	<div class="row">
		<p><label class="control-section">Optional Label</label><input class="form-control" type="text" name="number_label" style="width: 50%"></p>
	</div>
	<div class="row">	
		<p><label class="control-section">Submitted Name</label><input class="form-control" type="text" name="submitted_name" style="width: 50%" required /></p>		
	</div>
	<div class="row">
		<div class="col-md-4">
			<p><label>Min</label><input class="form-control" type="number" name="min" min="0" value=""></p>
		</div>
		<div class="col-md-4">	
			<p><label>Max</label><input class="form-control" type="number" name="max" min="0" value=""></p>
		</div>
		<div class="col-md-4">	
			<p><label>Step</label><input class="form-control" type="number" name="step" min="0" value=""></p>
		</div>
	</div>
</script>

<script id="unordered_list-template" type="text/x-handlebars-template">
	<div class="row">
		<input type="checkbox" id="ul_required" name="required" style="margin-left: 20px; margin-right: 5px">Required?</p>
	</div>
	<p><label class="control-label">Text</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
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
	}


	/* Specific method to load values from a select_one control to the customization modal */
	load_values.select_one = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("select")[0];
		form.find("[name=name]").val(ctrl.name);
    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
    	form.find("[name=submitted_name]").val(div_ctrl.find('.group1').attr('name'));
    	$('#select_one_required').prop('checked', model[ctrl_id].required_field);

		var options = '';
    	var parts = '';
    	
		$(form).parent().parent().find(".modal-footer").append('<p class="col-md-2" id="add_break"><a>Add Break</a></p><br><p style="text-align:left"><b>Part numbers cannot contain spaces.</b></p><p style="color: red; text-align:left">Note: The first entry always defaults to "Please make a selection"</p>');

		$("#add_break").click(function() {
			$("#textarea_option").val($('#textarea_option').val() + "\n" + "-----------");
			$("#textarea_part_number").val($('#textarea_part_number').val() + "\n" + "-----------");
		});
    
		$(ctrl).parent().find('.group1').children().each(function(i,o) { options += o.text + '\n'; });
		form.find("[name=options]").val($.trim(options));
    
    	$(ctrl).parent().find('.group2:hidden').children().each(function(i,o) { parts += o.text + '\n'; });
		form.find("[name=value]").val($.trim(parts));
    
	}

	/* Specific method to load values from a multiple select control to the customization modal */
	load_values.selectmultiplelist = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("select")[0];
		form.find("[name=name]").val(ctrl.name);
    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
    	form.find("[name=submitted_name]").val(div_ctrl.find('.group3').attr('name'));
    	$('#select_mult_required').prop('checked', model[ctrl_id].required_field);

		var options = '';
    	var parts = '';
    	
		$(form).parent().parent().find(".modal-footer").append('<p class="col-md-2" id="add_break_mult"><a>Add Break</a></p><br><p style="text-align:left"><b>Part numbers cannot contain spaces.</b></p><p style="color: red; text-align:left">Note: The first entry always defaults to "Please make a selection"</p>');

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
    	console.log(trimText);
    	form.find("[name=value]").val(trimText.replace(/\(|\)/g,''));
    	$('#radio_required').prop('checked', model[ctrl_id].required_field);
    
    deleteSpaces();
  }

  	/* Specific method to load values from a radio button control to the customization modal */
  	load_values.number = function(ctrl_type, ctrl_id) {
  		var form = $('#theForm');
  		var div_ctrl = $("#" + ctrl_id);
		form.find("[name=number_label]").val(div_ctrl.find('.number_option').text());
		form.find("[name=submitted_name]").val(div_ctrl.find('.ctrl-number').attr('name'));
		form.find('[name=min]').val(div_ctrl.find('.ctrl-number').attr('min'));
		form.find("[name=max]").val(div_ctrl.find('.ctrl-number').attr('max'));
		form.find("[name=step]").val(div_ctrl.find('.ctrl-number').attr('step'));
		$('#number_required').prop('checked', model[ctrl_id].required_field);
  	}

	/* Specific method to load values from a category control to the customization dialog */
	load_values.unordered_list = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("input")[0];
		form.find("[name=label]").val(div_ctrl.find('.ctrl-unordered_list').text());
		$('#ul_required').prop('checked', model[ctrl_id].required_field);		
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

	    var $dynamicSection = div_ctrl.find("[type='radio']");
	    var checkBoxStatus = values.selectedBox;
	    model[values.ctrl_ID].mutex = $('#checksExclusivity').prop('checked');
	    
	    if(checkBoxStatus == true) {
	      $dynamicSection.each(function() {
	        var $newName = $(this); 
	        var dynamicID = ($newName.parent().parent().parent().prop('id'));
	        $newName.attr("name", (values.label.replace(/\s/g,'')) + "__" + ((dynamicID.replace(/[^0-9]/g,'') - 3001)));
	      });    
	    } else {
	        (checkBoxStatus == false);
	        var optionName = div_ctrl.find('.makeBold');
	        console.log(optionName);
	        $dynamicSection.each(function() {
	        var $labelName = $(this);
	          var dynamicID = ($labelName.parent().parent().parent().prop('id'));
	        $labelName.attr("name", (optionName.text()) + "__" + ((dynamicID.replace(/[^0-9]/g,'') - 3001)));
	        });
	    } 
	}

 	save_changes.select_one = function(values) {
		console.log(values);
		var div_ctrl = $("#" + values.ctrl_ID);
		var ctrl = div_ctrl.find("select")[0];
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
	    // console.log(partsArray);  
	    
	    var $create_select_one_id = div_ctrl.parent().find("select.ctrl-select_one");
	    
	    	$create_select_one_id.each(function() {
	    		var $foo = $(this);
	    		if ($foo.hasClass('group1')) {
	    			if($foo.prev('.optional_label').text() != "") {
	    				$foo.attr("name", $foo.prev('.optional_label').text());
	    			}	
	    		}	
	    	});


	    /* Assigning unique id's to the generated options */
	    var $individualOption = div_ctrl.find("option");        
		var optionCount = 1;

		$individualOption.each(function() {    
	      var $something = $(this);
	      if ($something.parent().is("select#1")) {	      
		      $something.attr('name', 'option' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="option1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="option2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="option3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="option4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="option5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="option6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="option7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="option8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="option9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="option10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#2")) {
		      $something.attr('name', 'option' + '-' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="option-1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="option-2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="option-3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="option-4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="option-5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="option-6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="option-7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="option-8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="option-9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="option-10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#3")) {
		      $something.attr('name', 'option' + '*' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="option*1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="option*2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="option*3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="option*4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="option*5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="option*6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="option*7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="option*8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="option*9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="option*10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#4")) {
		      $something.attr('name', 'opt' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="opt1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="opt2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="opt3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="opt4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="opt5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="opt6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="opt7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="opt8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="opt9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="opt10"]').attr('value', '(' + partsArray[9] + ')');
		  } else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'choice' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="choice1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="choice2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="choice3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="choice4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="choice5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="choice6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="choice7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="choice8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="choice9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="choice10"]').attr('value', '(' + partsArray[9] + ')');
		  } else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'choice' + '_' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="choice_1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="choice_2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="choice_3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="choice_4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="choice_5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="choice_6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="choice_7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="choice_8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="choice_9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="choice_10"]').attr('value', '(' + partsArray[9] + ')');
		  }  else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'choice' + "-" + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="choice-1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="choice-2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="choice-3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="choice-4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="choice-5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="choice-6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="choice-7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="choice-8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="choice-9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="choice-10"]').attr('value', '(' + partsArray[9] + ')');
		  }  else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'ch' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="ch1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="ch2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="ch3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="ch4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="ch5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="ch6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="ch7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="ch8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="ch9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="ch10"]').attr('value', '(' + partsArray[9] + ')');
		  }  else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'choices' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="choices1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="choices2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="choices3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="choices4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="choices5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="choices6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="choices7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="choices8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="choices9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="choices10"]').attr('value', '(' + partsArray[9] + ')');
		  }  else if ($something.parent().is("select#5")) {
		      $something.attr('name', 'ch_' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option[name="ch_1"]').attr('value', '(' + partsArray[0] + ')');
		      $('option[name="ch_2"]').attr('value', '(' + partsArray[1] + ')');
		      $('option[name="ch_3"]').attr('value', '(' + partsArray[2] + ')');
		      $('option[name="ch_4"]').attr('value', '(' + partsArray[3] + ')');
		      $('option[name="ch_5"]').attr('value', '(' + partsArray[4] + ')');
		      $('option[name="ch_6"]').attr('value', '(' + partsArray[5] + ')');
		      $('option[name="ch_7"]').attr('value', '(' + partsArray[6] + ')');
		      $('option[name="ch_8"]').attr('value', '(' + partsArray[7] + ')');
		      $('option[name="ch_9"]').attr('value', '(' + partsArray[8] + ')');
		      $('option[name="ch_10"]').attr('value', '(' + partsArray[9] + ')');
		  }          

	    });
	}
	
	save_changes.radiogroup = function(values) {
		console.log(values);
	    var form = $("#theForm");
			var div_ctrl = $("#" + values.ctrl_ID);
	    div_ctrl.find('.makeBold').text(values.label);
	    model[values.ctrl_ID].required_field = $('#radio_required').prop('checked');
	    // div_ctrl.find('.control-label').text(values.value);
	   
	    var $radioValues = div_ctrl.find("[type='radio']");
	    var generatedValue = values.value;
	    $radioValues.each(function() {
	      var $data = $(this);
	      
		      if($data.hasClass('required_radio')) {
		        $data.val(('r(' + generatedValue + ')'));
		      } else if ($data.hasClass('optional_radio')) {
		        $data.val(('o(' + generatedValue + ')'));   
		      } else if ($data.hasClass('na_radio')) {
		        $data.val(('n(' + generatedValue + ')'));              
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
	    model[values.ctrl_ID].required_field = $('#select_mult_required').prop('checked');

		// ctrl.name = values.name;
    
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
	    
	    var $create_select_one_id = div_ctrl.parent().find("select.ctrl-selectmultiplelist");
	    
	    	$create_select_one_id.each(function() {
	    		var $foo = $(this);
	    		if ($foo.hasClass('group3')) {
	    			if($foo.prev('.optional_label_mult').text() != "") {
	    				$foo.attr("name", $foo.prev('.optional_label_mult').text());
	    			}	
	    		}	
	    	});

	    
	    /* Assigning unique id's to the generated options and temporary method of linking the optionsArray and partsArray indices */
	    var $individualOption = div_ctrl.find("option");        
	    var optionCount = 1;  

	    $individualOption.each(function() {    
	      var $something = $(this);
	      if ($something.parent().is("select#select1")) {
	         $something.attr('name', 'selectmult' + optionCount++);
	         $something.attr('class', 'multiGroup');
	         $('option[name="selectmult1"]').attr('value', '(' + partsArray[0] + ')');
	         $('option[name="selectmult2"]').attr('value', '(' + partsArray[1] + ')');
	         $('option[name="selectmult3"]').attr('value', '(' + partsArray[2] + ')');
	         $('option[name="selectmult4"]').attr('value', '(' + partsArray[3] + ')');
	         $('option[name="selectmult5"]').attr('value', '(' + partsArray[4] + ')');
	         $('option[name="selectmult6"]').attr('value', '(' + partsArray[5] + ')');
	         $('option[name="selectmult7"]').attr('value', '(' + partsArray[6] + ')');
	         $('option[name="selectmult8"]').attr('value', '(' + partsArray[7] + ')');
	         $('option[name="selectmult9"]').attr('value', '(' + partsArray[8] + ')');
	         $('option[name="selectmult10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#select2")) {
	      	 $something.attr('name', 'selectmult' + '_' + optionCount++);
	         $something.attr('class', 'multiGroup');
	         $('option[name="selectmult_1"]').attr('value', '(' + partsArray[0] + ')');
	         $('option[name="selectmult_2"]').attr('value', '(' + partsArray[1] + ')');
	         $('option[name="selectmult_3"]').attr('value', '(' + partsArray[2] + ')');
	         $('option[name="selectmult_4"]').attr('value', '(' + partsArray[3] + ')');
	         $('option[name="selectmult_5"]').attr('value', '(' + partsArray[4] + ')');
	         $('option[name="selectmult_6"]').attr('value', '(' + partsArray[5] + ')');
	         $('option[name="selectmult_7"]').attr('value', '(' + partsArray[6] + ')');
	         $('option[name="selectmult_8"]').attr('value', '(' + partsArray[7] + ')');
	         $('option[name="selectmult_9"]').attr('value', '(' + partsArray[8] + ')');
	         $('option[name="selectmult_10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#select3")) {
	      	 $something.attr('name', 'selectmult' + '-' + optionCount++);
	         $something.attr('class', 'multiGroup');
	         $('option[name="selectmult-1"]').attr('value', '(' + partsArray[0] + ')');
	         $('option[name="selectmult-2"]').attr('value', '(' + partsArray[1] + ')');
	         $('option[name="selectmult-3"]').attr('value', '(' + partsArray[2] + ')');
	         $('option[name="selectmult-4"]').attr('value', '(' + partsArray[3] + ')');
	         $('option[name="selectmult-5"]').attr('value', '(' + partsArray[4] + ')');
	         $('option[name="selectmult-6"]').attr('value', '(' + partsArray[5] + ')');
	         $('option[name="selectmult-7"]').attr('value', '(' + partsArray[6] + ')');
	         $('option[name="selectmult-8"]').attr('value', '(' + partsArray[7] + ')');
	         $('option[name="selectmult-9"]').attr('value', '(' + partsArray[8] + ')');
	         $('option[name="selectmult-10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#select4")) {
	      	 $something.attr('name', 'selectchoice' + '-' + optionCount++);
	         $something.attr('class', 'multiGroup');
	         $('option[name="selectchoice-1"]').attr('value', '(' + partsArray[0] + ')');
	         $('option[name="selectchoice-2"]').attr('value', '(' + partsArray[1] + ')');
	         $('option[name="selectchoice-3"]').attr('value', '(' + partsArray[2] + ')');
	         $('option[name="selectchoice-4"]').attr('value', '(' + partsArray[3] + ')');
	         $('option[name="selectchoice-5"]').attr('value', '(' + partsArray[4] + ')');
	         $('option[name="selectchoice-6"]').attr('value', '(' + partsArray[5] + ')');
	         $('option[name="selectchoice-7"]').attr('value', '(' + partsArray[6] + ')');
	         $('option[name="selectchoice-8"]').attr('value', '(' + partsArray[7] + ')');
	         $('option[name="selectchoice-9"]').attr('value', '(' + partsArray[8] + ')');
	         $('option[name="selectchoice-10"]').attr('value', '(' + partsArray[9] + ')');
	      } else if ($something.parent().is("select#select5")) {
	      	 $something.attr('name', 'selectchoice' + '_' + optionCount++);
	         $something.attr('class', 'multiGroup');
	         $('option[name="selectchoice_1"]').attr('value', '(' + partsArray[0] + ')');
	         $('option[name="selectchoice_2"]').attr('value', '(' + partsArray[1] + ')');
	         $('option[name="selectchoice_3"]').attr('value', '(' + partsArray[2] + ')');
	         $('option[name="selectchoice_4"]').attr('value', '(' + partsArray[3] + ')');
	         $('option[name="selectchoice_5"]').attr('value', '(' + partsArray[4] + ')');
	         $('option[name="selectchoice_6"]').attr('value', '(' + partsArray[5] + ')');
	         $('option[name="selectchoice_7"]').attr('value', '(' + partsArray[6] + ')');
	         $('option[name="selectchoice_8"]').attr('value', '(' + partsArray[7] + ')');
	         $('option[name="selectchoice_9"]').attr('value', '(' + partsArray[8] + ')');
	         $('option[name="selectchoice_10"]').attr('value', '(' + partsArray[9] + ')');
	      }
    	});
    
	}

	save_changes.number = function(values) {
		console.log(values);
		var form = $('#theForm');
		var div_ctrl = $("#" + values.ctrl_ID);
		div_ctrl.find('.number_option').text(values.number_label);
		div_ctrl.find('.ctrl-number').attr('name', values.submitted_name);
		div_ctrl.find('.ctrl-number').attr('min', values.min);
		div_ctrl.find('.ctrl-number').attr('max', values.max);
		div_ctrl.find('.ctrl-number').attr('step', values.step);
	    model[values.ctrl_ID].required_field = $('#number_required').prop('checked');

	}

	save_changes.unordered_list = function(values) {
		var div_ctrl = $("#" + values.ctrl_ID);
		var ctrl = div_ctrl.find("input")[0];
		div_ctrl.find('.ul_txt').text(values.label);
		model[values.ctrl_ID].required_field = $('#ul_required').prop('checked');
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

		// var modal_header = $("#" + ctrl_id).find('.control-label').text();

		var template_params = {
			// header: modal_header,
			content: specific_template(ctrl_params),
			type: ctrl_type,
			ctrl_ID: ctrl_id
		}

		
		// Pass the parameters - along with the specific template content to the Base template
		var s = templates.common(template_params) + "";

		$("[name=customization_modal]").remove(); // Making sure that we just have one instance of the modal opened and not leaking
		$('<div class="modal fade" tabindex="-1" id="customization_modal" role="dialog" name="customization_modal"  />').append(s).modal('show');

		setTimeout(function() {
			//For some error in the code modal show event is not firing - applying a manual delay before load
			load_values.common(ctrl_type, ctrl_id);

		},300);

	}

		/* Delete the control from the form */
	function delete_ctrl() {
		if(window.confirm("Are you sure about this?")) {
			var ctrl_id = $("#theForm").find("[name=ctrl_ID]").val()
			console.log(ctrl_id + " " + "DELETED");
			$("#"+ctrl_id).remove();
		}
	}

    function deleteSpaces(event, ui) {
	    $('.dontAllowSpaces').keyup(function(e) {
	      	var partNumberValue = document.querySelectorAll('[id^="getValue"]');
	     	var s = partNumberValue[0].value;
	      
		    if(e.which === 32) {
		        alert('Part numbers cannot contain spaces. \nYour part number is now: \n' + s);
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


/* SERIALIZATION LOGIC */

	$('#serialize').click(function() {
		
		var config = {
						type: "configuration",
						title: $("#form-title").val(),
						salesforce_product_code: $("#salesforce_code").val(), 
						categories: []
					};		

		$('#work-area').children().each(function() {
			// console.log($(this).prop('id'));
			// $(this).children().each(function() {
			// 	console.log($(this).prop('id'));
			// 	$(this).children().each(function() {
			// 		console.log($(this).prop('id'));
			// 	});
			// });
			addNode(config, this);
		});
		console.log(JSON.stringify(config, true, 3));
		$("#mock_database").empty();
		$("#mock_database").val(JSON.stringify(config,true, 2));
	});

  	/* --------- METHODS FOR RETREIVING A SAVED CONFIGURATION ---------- */
	var globalFormObject = {is_retrieving: false};


  	$('#retrieve').click(function() {
  		
  		globalFormObject.is_retrieving = true;
  		var obj = JSON.parse($('#mock_database').val());
  		console.log(obj);
  		globalFormObject.obj = obj;
  		$('[id^="CTRL-DIV"]').remove();
  		model = {};

  		if (obj.type == "configuration" && obj.categories.length > 0) {
  			$("#form-title").val(obj.title);
  			$("#salesforce_code").val(obj.salesforce_product_code);

	  		$.each(obj.categories, function(index, cat_obj) {
	  			console.log($(this).prop('id'));
				$title = cat_obj.label;
				var array_sects = cat_obj.sections;

	  			if(cat_obj.type == "category") {
	  				$("#trigger_cat").click();
	  				// var $new_area = $('#work-area').children().last();
	  				// $new_area.find('.ctrl-category').html($title);	  				
	  			}
		
	  			$.each(array_sects, function(index, sects_obj) {
		  			// console.log($(this).prop('id'));
	  				$section = $(this);
	  				sect_controls = sects_obj.controls;

					if (($section.prop('type')) == "section") {
						$("#trigger_sect").click();
						// model[sects_obj.id] = {mutex: true};
						// console.log("model", model);		
						// $new_area.find('.droppedSect').find('.ctrl-section').last().html(sects_obj.label);
					}

					$.each(sect_controls, function(index, value) {
						$single_ctrl = $(this);

						if (($single_ctrl.prop('type')) == "ctrl-select-one") {
							$("#trigger_combo").click();
							console.log($single_ctrl.prop('id'));
							model[value.id] = {pairs: [], required_field: false};
							model[value.id].required_field = value.required_field;

							var options = '';
							var parts = '';

							var div_ctrl = $("#" + $new_area.find('.droppedElem').last().prop('id'));

							var ctrl = div_ctrl.find("select")[0];

							$.each($single_ctrl.prop('pairs'), function(i,o) { 
								options += $(this).prop('n') + '\n';
								parts += $(this).prop('v') + '\n'; 
							});

							var opt_pairs = {n: options, v: parts};
							// value.id = model[value.id];

							// model[$single_ctrl.prop('id')].pairs.push(opt_pairs);				
							// console.log("model", model);

							$new_area.find('.optional_label').last().html($single_ctrl.prop('label'));
							$new_area.find('.group1').last().attr('name', $single_ctrl.prop('name'));

							$(ctrl).empty();

							$(options.split('\n')).each(function(i,o) {
								$(ctrl).append("<option>" + $.trim(o) + "</option>");
							});

							$(ctrl).parent().find("select.group2").empty();

							$(parts.split('\n')).each(function(i,o) {
								$(ctrl).parent().find("select.group2").append("<option>" + $.trim(o) + "</option>");
							});

						    //Objects containing the part numbers
						    var partsObject = $(parts.split('\n'));
						    
						    //Conversion of the parts Object to an array
						    var partsArray = $.map(partsObject, function(value, index) {
						      return [value];
						    });
						    var $create_select_one_id = div_ctrl.parent().find("select.ctrl-select_one");
				    
						    	$create_select_one_id.each(function() {
						    		var $foo = $(this);
						    		if ($foo.hasClass('group1')) {
						    			if(value.label != "") {
						    				$foo.attr("name", value.label);
						    			}	
						    		}	
						    	});

					    var $individualOption = div_ctrl.find("option");        
						var optionCount = 1;

					    $individualOption.each(function() {    
					      var $something = $(this);
					      if ($something.parent().is("select#1")) {	      
						      $something.attr('name', 'option' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="option1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="option2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="option3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="option4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="option5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="option6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="option7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="option8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="option9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="option10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="option11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="option12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="option13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="option14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="option15"]').attr('value', '(' + partsArray[14] + ')');
					      } else if ($something.parent().is("select#2")) {
						      $something.attr('name', 'option' + '-' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="option-1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="option-2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="option-3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="option-4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="option-5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="option-6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="option-7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="option-8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="option-9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="option-10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="option-11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="option-12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="option-13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="option-14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="option-15"]').attr('value', '(' + partsArray[14] + ')');		      
					      } else if ($something.parent().is("select#3")) {
						      $something.attr('name', 'option' + '*' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="option*1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="option*2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="option*3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="option*4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="option*5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="option*6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="option*7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="option*8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="option*9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="option*10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="option*11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="option*12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="option*13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="option*14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="option*15"]').attr('value', '(' + partsArray[14] + ')');		      
					      } else if ($something.parent().is("select#4")) {
						      $something.attr('name', 'opt' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="opt1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="opt2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="opt3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="opt4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="opt5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="opt6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="opt7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="opt8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="opt9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="opt10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="opt11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="opt12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="opt13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="opt14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="opt15"]').attr('value', '(' + partsArray[14] + ')');		      
						  } else if ($something.parent().is("select#5")) {
						      $something.attr('name', 'choice' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="choice1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="choice2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="choice3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="choice4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="choice5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="choice6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="choice7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="choice8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="choice9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="choice10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="choice11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="choice12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="choice13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="choice14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="choice15"]').attr('value', '(' + partsArray[14] + ')');
						  } else if ($something.parent().is("select#6")) {
						      $something.attr('name', 'choice' + '_' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="choice_1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="choice_2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="choice_3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="choice_4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="choice_5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="choice_6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="choice_7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="choice_8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="choice_9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="choice_10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="choice_11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="choice_12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="choice_13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="choice_14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="choice_15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#7")) {
						      $something.attr('name', 'choice' + "-" + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="choice-1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="choice-2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="choice-3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="choice-4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="choice-5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="choice-6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="choice-7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="choice-8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="choice-9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="choice-10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="choice-11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="choice-12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="choice-13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="choice-14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="choice-15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#8")) {
						      $something.attr('name', 'ch' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="ch1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="ch2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="ch3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="ch4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="ch5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="ch6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="ch7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="ch8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="ch9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="ch10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="ch11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="ch12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="ch13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="ch14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="ch15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#9")) {
						      $something.attr('name', 'choices' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="choices1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="choices2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="choices3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="choices4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="choices5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="choices6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="choices7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="choices8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="choices9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="choices10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="choices11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="choices12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="choices13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="choices14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="choices15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#10")) {
						      $something.attr('name', 'sel' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="sel1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="sel2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="sel3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="sel4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="sel5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="sel6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="sel7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="sel8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="sel9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="sel10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="sel11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="sel12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="sel13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="sel14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="sel15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#11")) {
						      $something.attr('name', 'sel-' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="sel-1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="sel-2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="sel-3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="sel-4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="sel-5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="sel-6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="sel-7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="sel-8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="sel-9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="sel-10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="sel-11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="sel-12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="sel-13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="sel-14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="sel-15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#12")) {
						      $something.attr('name', 'select' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="select1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="select2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="select3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="select4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="select5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="select6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="select7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="select8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="select9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="select10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="select11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="select12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="select13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="select14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="select15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#13")) {
						      $something.attr('name', 'select_' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="select_1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="select_2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="select_3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="select_4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="select_5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="select_6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="select_7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="select_8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="select_9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="select_10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="select_11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="select_12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="select_13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="select_14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="select_15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#14")) {
						      $something.attr('name', 'select-' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="select-1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="select-2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="select-3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="select-4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="select-5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="select-6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="select-7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="select-8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="select-9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="select-10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="select-11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="select-12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="select-13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="select-14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="select-15"]').attr('value', '(' + partsArray[14] + ')');
						  }  else if ($something.parent().is("select#15")) {
						      $something.attr('name', 's' + optionCount++);
						      $something.attr('class', 'generatedOptions');
						      $('option[name="s1"]').attr('value', '(' + partsArray[0] + ')');
						      $('option[name="s2"]').attr('value', '(' + partsArray[1] + ')');
						      $('option[name="s3"]').attr('value', '(' + partsArray[2] + ')');
						      $('option[name="s4"]').attr('value', '(' + partsArray[3] + ')');
						      $('option[name="s5"]').attr('value', '(' + partsArray[4] + ')');
						      $('option[name="s6"]').attr('value', '(' + partsArray[5] + ')');
						      $('option[name="s7"]').attr('value', '(' + partsArray[6] + ')');
						      $('option[name="s8"]').attr('value', '(' + partsArray[7] + ')');
						      $('option[name="s9"]').attr('value', '(' + partsArray[8] + ')');
						      $('option[name="s10"]').attr('value', '(' + partsArray[9] + ')');
						      $('option[name="s11"]').attr('value', '(' + partsArray[10] + ')');
						      $('option[name="s12"]').attr('value', '(' + partsArray[11] + ')');
						      $('option[name="s13"]').attr('value', '(' + partsArray[12] + ')');
						      $('option[name="s14"]').attr('value', '(' + partsArray[13] + ')');
						      $('option[name="s15"]').attr('value', '(' + partsArray[14] + ')');
						  } 

								$('.group1 option').each(function() {
									if ($(this).text() == "") {
										$(this).remove();
									}
								});

							});
				    
						} else if (($single_ctrl.prop('type')) == "ctrl-ron") {
							$("#trigger_radio").click();
							console.log(value.id);
							model[value.id] = {type: "ctrl-ron", required_field: false, name: $single_ctrl.prop('name')};
							model[value.id].required_field = value.required_field;

							$new_area.find('.makeBold').last().html($single_ctrl.prop('label'));
							$new_area.find('.required_radio').last().attr('value', "r(" + value.pairs[0].v + ")");
							$new_area.find('.optional_radio').last().attr('value', "o(" + value.pairs[0].v + ")");
							$new_area.find('.na_radio').last().attr('value', "n(" + value.pairs[0].v + ")");
							$new_area.find('.placeHolderClass').last().attr('value', value.pairs[0].v);

						} else if (($single_ctrl.prop('type')) == "ctrl-select-multiple") {
							$("#trigger_mult").click();
							console.log($single_ctrl.prop('id'));
							var options = '';
							var parts = '';

							model[value.id] = {required_field: false};
							model[value.id].required_field = value.required_field;

							var div_ctrl = $("#" + $new_area.find('.droppedElem').last().prop('id'));

							$new_area.find('.optional_label_mult').last().html($single_ctrl.prop('label'));
							$new_area.find('.group3').last().attr('name', $single_ctrl.prop('name'));

							var ctrl = div_ctrl.find("select")[0];

							$.each($single_ctrl.prop('pairs'), function(i,o) {
								options += $(this).prop('n') + '\n';
								parts += $(this).prop('v') + '\n'; 
							});

							var opt_pairs = {n: options, v: parts};

							$(ctrl).empty();

							$(options.split('\n')).each(function(i,o) {
								$(ctrl).parent().find("select.group3").append("<option>" + $.trim(o) + "</option>");
							});

							$(ctrl).parent().find("select.group4").empty();

							$(parts.split('\n')).each(function(i,o) {
								$(ctrl).parent().find("select.group4").append("<option>" + $.trim(o) + "</option>");
							});

						    //Objects containing the part numbers
						    var partsObject = $(parts.split('\n'));
						    
						    //Conversion of the parts Object to an array
						    var partsArray = $.map(partsObject, function(value, index) {
						      return [value];
						    });
						    var $create_select_one_id = div_ctrl.parent().find("select.ctrl-selectmultiplelist");
				    
						    	$create_select_one_id.each(function() {
						    		var $foo = $(this);
						    		if ($foo.hasClass('group3')) {
						    			if(value.label != "") {
						    				$foo.attr("name", value.label);
						    			}	
						    		}	
						    	});

					    	var $individualOption = div_ctrl.find("option");        
							var optionCount = 1;

						    $individualOption.each(function() {    
						      var $something = $(this);
						      if ($something.parent().is("select#select1")) {
						         $something.attr('name', 'selectmult' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="selectmult1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="selectmult2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="selectmult3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="selectmult4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="selectmult5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="selectmult6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="selectmult7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="selectmult8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="selectmult9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="selectmult10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="selectmult11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="selectmult12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="selectmult13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="selectmult14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="selectmult15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select2")) {
						      	 $something.attr('name', 'selectmult' + '_' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="selectmult_1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="selectmult_2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="selectmult_3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="selectmult_4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="selectmult_5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="selectmult_6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="selectmult_7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="selectmult_8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="selectmult_9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="selectmult_10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="selectmult_11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="selectmult_12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="selectmult_13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="selectmult_14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="selectmult_15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select3")) {
						      	 $something.attr('name', 'selectmult' + '-' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="selectmult-1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="selectmult-2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="selectmult-3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="selectmult-4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="selectmult-5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="selectmult-6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="selectmult-7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="selectmult-8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="selectmult-9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="selectmult-10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="selectmult-11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="selectmult-12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="selectmult-13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="selectmult-14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="selectmult-15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select4")) {
						      	 $something.attr('name', 'selectchoice' + '-' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="selectchoice-1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="selectchoice-2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="selectchoice-3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="selectchoice-4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="selectchoice-5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="selectchoice-6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="selectchoice-7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="selectchoice-8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="selectchoice-9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="selectchoice-10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="selectchoice-11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="selectchoice-12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="selectchoice-13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="selectchoice-14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="selectchoice-15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select5")) {
						      	 $something.attr('name', 'mult' + '_' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="mult_1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="mult_2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="mult_3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="mult_4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="mult_5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="mult_6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="mult_7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="mult_8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="mult_9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="mult_10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="mult_11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="mult_12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="mult_13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="mult_14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="mult_15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select6")) {
						      	 $something.attr('name', 'mult' + '-' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="mult-1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="mult-2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="mult-3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="mult-4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="mult-5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="mult-6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="mult-7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="mult-8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="mult-9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="mult-10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="mult-11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="mult-12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="mult-13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="mult-14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="mult-15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select7")) {
						      	 $something.attr('name', 'mult' + '' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="mult1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="mult2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="mult3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="mult4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="mult5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="mult6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="mult7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="mult8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="mult9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="mult10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="mult11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="mult12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="mult13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="mult14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="mult15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select8")) {
						      	 $something.attr('name', 'sm' + '_' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="sm_1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="sm_2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="sm_3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="sm_4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="sm_5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="sm_6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="sm_7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="sm_8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="sm_9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="sm_10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="sm_11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="sm_12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="sm_13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="sm_14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="sm_15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select9")) {
						      	 $something.attr('name', 'sm' + '' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="sm1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="sm2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="sm3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="sm4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="sm5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="sm6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="sm7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="sm8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="sm9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="sm10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="sm11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="sm12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="sm13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="sm14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="sm15"]').attr('value', '(' + partsArray[14] + ')');
						      } else if ($something.parent().is("select#select10")) {
						      	 $something.attr('name', 'sm' + '-' + optionCount++);
						         $something.attr('class', 'multiGroup');
						         $('option[name="sm-1"]').attr('value', '(' + partsArray[0] + ')');
						         $('option[name="sm-2"]').attr('value', '(' + partsArray[1] + ')');
						         $('option[name="sm-3"]').attr('value', '(' + partsArray[2] + ')');
						         $('option[name="sm-4"]').attr('value', '(' + partsArray[3] + ')');
						         $('option[name="sm-5"]').attr('value', '(' + partsArray[4] + ')');
						         $('option[name="sm-6"]').attr('value', '(' + partsArray[5] + ')');
						         $('option[name="sm-7"]').attr('value', '(' + partsArray[6] + ')');
						         $('option[name="sm-8"]').attr('value', '(' + partsArray[7] + ')');
						         $('option[name="sm-9"]').attr('value', '(' + partsArray[8] + ')');
						         $('option[name="sm-10"]').attr('value', '(' + partsArray[9] + ')');
						         $('option[name="sm-11"]').attr('value', '(' + partsArray[10] + ')');
						         $('option[name="sm-12"]').attr('value', '(' + partsArray[11] + ')');
						         $('option[name="sm-13"]').attr('value', '(' + partsArray[12] + ')');
						         $('option[name="sm-14"]').attr('value', '(' + partsArray[13] + ')');
						         $('option[name="sm-15"]').attr('value', '(' + partsArray[14] + ')');
						      }

								$('.group3 option').each(function() {
									if ($(this).text() == "") {
										$(this).remove();
									}
								});

					    	});
					    														
						} else if ($single_ctrl.prop('type') == "ctrl-number") {
							$("#trigger_number").click();
							console.log($single_ctrl.prop('id'));

							model[value.id] = {required_field: false};
							model[value.id].required_field = value.required_field;							
							$new_area.find('.number_option').last().html($single_ctrl.prop('label'));
							$new_area.find('.ctrl-number').last().attr('name', $single_ctrl.prop('name'));
							$new_area.find('.ctrl-number').last().attr('min', $single_ctrl.prop('min'));
							$new_area.find('.ctrl-number').last().attr('max', $single_ctrl.prop('max'));
							$new_area.find('.ctrl-number').last().attr('step', $single_ctrl.prop('step'));

						} else {
							($single_ctrl.prop('type') == "ctrl-unordered_list") 
							$("#trigger_ul").click();
							console.log($single_ctrl.prop('id'));
							$new_area.find('.ul_txt').last().html($single_ctrl.prop('label'));
							model[value.id] = {required_field: false};
							model[value.id].required_field = value.required_field;
						}

					});

	  			});

	  		});
	  			
  		} else {
	  		alert('Invalid Configuration');
	  	}
	  	globalFormObject.is_retrieving = false;
  	});
	

	function addNode(parent, node) {
			// parent = the object containing {categories: [], title: ""}
			// node = all the dropped category divs
  		var ctrl = $(node).find("[class*=ctrl]")[0];
		var category_config = {
					 	type: $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
					 	label: $(node).find('.ctrl-category').text(),
					 	id: node.id, 
					 	sections: []
					};


		// var pop = $(node).find('.droppedSect').find("[class*=ctrl]")[0];

			$(node).find('.droppedSect').each(function() {
				var $sects = $(this);
				console.log($(this).prop('id'));
				var ctrl2 = ($(node).find('.droppedSect').find("[class*=ctrl]")[0]);
				var section_config = {
								type: $.trim(ctrl2.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
								label: $sects.find('.ctrl-section').text(),
								mutex: model[$sects.prop('id')].mutex,
								id: $sects.prop('id'),
								controls: []
							};
				category_config.sections.push(section_config);

				$sects.find('.droppedElem').each(function() {
					var $user_ctrls = $(this);
					console.log($(this).prop('id'));
					var select_one_config = {
									type: "ctrl-select-one",
									name: $user_ctrls.find('group1').attr('name'),
									label: $user_ctrls.find('.optional_label').text(),
									required_field: model[$user_ctrls.prop('id')].required_field,
									id: $user_ctrls.prop('id'),
									pairs: []
								};	

					var radiogroup_config = {
							type: "ctrl-ron",
							label: $user_ctrls.find('.makeBold').text(),
							required_field: model[$user_ctrls.prop('id')].required_field,
							id: $user_ctrls.prop('id'),
							pairs: []
						};												

					var select_multiple_config = {
							type: "ctrl-select-multiple",
							name: $user_ctrls.find('.group3').attr('name'),
							label: $user_ctrls.find('.optional_label_mult').text(),
							required_field: model[$user_ctrls.prop('id')].required_field,							
							id: $user_ctrls.prop('id'),
							pairs: []
						};

					var number_config = {
							type: "ctrl-number",
							name: $user_ctrls.find('.ctrl-number').attr('name'),
							label: $user_ctrls.find('.number_option').text(),
							required_field: model[$user_ctrls.prop('id')].required_field,							
							id: $user_ctrls.prop('id'),
							min: $user_ctrls.find('.ctrl-number').attr("min"),
							max: $user_ctrls.find('.ctrl-number').attr("max"),
							step: $user_ctrls.find('.ctrl-number').attr("step")
						}	

					var ul_config = {
									type: "ctrl-unordered_list",
									label: $user_ctrls.find('.ul_txt').text(),
									required_field: model[$user_ctrls.prop('id')].required_field,
									id: $user_ctrls.prop('id')
								}

					if($user_ctrls.find('.ctrl-select_one').length != 0) {
						section_config.controls.push(select_one_config);
						if($user_ctrls.find('.group1').find('option').length != 0) {
							var $something = $user_ctrls.find('.group1').find('option').each(function() {
								var $select_one_pairs = {
											type: "pair", 
											n: $(this).text(), 
											v: $(this).attr("value").replace(/\(|\)/g, '') //removes parentheses	
										};
									select_one_config.pairs.push($select_one_pairs);
							});	
						}

					} else if ($user_ctrls.find('.ctrl-radiogroup').length != 0) {
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
						section_config.controls.push(select_multiple_config);
							var $something = $user_ctrls.find('.group3').find('option').each(function() {
								var $select_mult_pairs = {
											type: "pair", 
											n: $(this).text(), 
											v: $(this).attr("value").replace(/\(|\)/g, '') //removes parentheses	
										};
									select_multiple_config.pairs.push($select_mult_pairs);
							});	

					} else if ($user_ctrls.find('.ctrl-number').length != 0) {
						section_config.controls.push(number_config);

					} else {
						section_config.controls.push(ul_config);	
					}

				});
			});



		parent.categories.push(category_config);
		
	}

</script>