
<script id="control-customize-template" type="text/x-handlebars-template">
			<div class="modal-body">
				<form id="theForm" class="form-horizontal">
					<input type="hidden" value="@{{type}}" name="type">
					<input type="hidden" value="@{{forCtrl}}" name="forCtrl">
					@{{{content}}}
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal" onclick='save_customize_changes()'>Save changes</button>
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
	      <input type="checkbox" id="checksExclusivity" name="selectedBox" value="someValue" checked>If checked, only 1 "Required" button can be selected in this section.
	    </label>
	</div>
	<br>
	<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></p>
</script>

<script id="radio-template" type="text/x-handlebars-template">
	<p><label class="control-section">Label</label><input class="form-control" type="text" name="label" value="" style="width: 50%"></input></p> 
	<p><label class="control-label">Part Number</label><input class="form-control dontAllowSpaces" id="getValue" type="text" name="value" placeholder="Part#" style="width: 50%"></p>
</script>

<script id="combobox-template" type="text/x-handlebars-template">
	<div class="row">
	  <p><label class="control-label">Label</label> <input class="form-control" type="text" name="label" value="" placeholder="optional" style="width: 50%"></p>
	</div>
	<div class="row">
	  <div class="col-md-6">
	    <p><label class="control-label">Option(s)</label>
	      <textarea class="form-control" id="textarea_option" name="options" rows="5" cols="40"></textarea>
	    </p>
	  </div>
	  <div class="col-md-6">
	    <p><label class="control-label" style="font-size: small; margin-left: 70px;">Part Number <b>(no spaces)</b></label>
	      <textarea class="form-control" id="textarea_part_number" name="value" rows="5" cols="40"></textarea>
	    </p>
	  </div>	
	</div>
</script>

<script id="selectmultiplelist-template" type="text/x-handlebars-template">
	<div class="row">
	  <p><label class="control-label">Label</label> <input class="form-control" type="text" name="label" value="" placeholder="optional" style="width: 50%"></p>
	</div>
	<div class="row">
	  <div class="col-md-6">
	    <p><label class="control-label">Option(s)</label>
	      <textarea class="form-control" name="options" rows="5" cols="40"></textarea>
	    </p>
	  </div>
	  <div class="col-md-6">
		<p><label class="control-label" style="font-size: small; margin-left: 70px;">Part Number <b>(no spaces)</b></label>
	      <textarea class="form-control" name="value" rows="5" cols="40"></textarea>
	    </p>
	  </div>	
	</div>
</script>

<script>
	// COMPILE THE TEMPLATES FOR USE

	function compileTemplates() {
		window.templates = {};
		window.templates.common = Handlebars.compile($("#control-customize-template").html());

		window.templates.category = Handlebars.compile($("#category-template").html());
    	window.templates.section = Handlebars.compile($("#section-template").html());
		window.templates.combobox = Handlebars.compile($("#combobox-template").html());
		window.templates.selectmultiplelist = Handlebars.compile($("#selectmultiplelist-template").html());
		window.templates.radiogroup = Handlebars.compile($("#radio-template").html());
		window.templates.number = Handlebars.compile($("#category-template").html());
	}
	// Object containing specific "Load/Save Values" method
	var save_changes = {};
	var load_values = {};
	
  	
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

		// var $radioName = div_ctrl.find("[type='radio']");
		// var dynamicName = $(this).find('.ctrl-section');

		// console.log(dynamicName);

		// $radioName.each(function() {
		// 	var $data = $(this);
		// 	$data.attr("name", ($(dynamicName).text()) + "__" + (ctrl_id - 2001));
		// })

	    $('#checksExclusivity').click(function() {
	      var check = $(this).prop('checked');
	      if(check == false) {
	        $(thisLabel).removeClass('required_radio');
	        $(thisLabel).addClass('mutuallyExclusive');
	        $('#checksExclusivity').prop('checked', false);
	      } else {
	        $(thisLabel).removeClass('mutuallyExclusive');
	        $(thisLabel).addClass('required_radio');       
	      }
	    }); 			

	}


	/* Specific method to load values from a combobox control to the customization modal */
	load_values.combobox = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("select")[0];
		form.find("[name=name]").val(ctrl.name);
    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
		var options = '';
    	var parts = '';
    	
		$(form).parent().parent().find(".modal-footer").append('<p class="col-md-2" id="add_break"><a>Add Break</a></p>');

		$("#add_break").click(function() {
			$("#textarea_option").val($('#textarea_option').val() + "\n" + "-----------");
			$("#textarea_part_number").val($('#textarea_part_number').val() + "\n" + "-----------");
		});
    
		$(ctrl).parent().find('#group1').children().each(function(i,o) { options += o.text + '\n'; });
		form.find("[name=options]").val($.trim(options));
    
    	$(ctrl).parent().find('#group2').children().each(function(i,o) { parts += o.text + '\n'; });
		form.find("[name=value]").val($.trim(parts));
    
	}

	/* Specific method to load values from a multiple select control to the customization modal */
	load_values.selectmultiplelist = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("select")[0];
		form.find("[name=name]").val(ctrl.name);
    	form.find("[name=label]").val(div_ctrl.find('.control-label').text());
		var options = '';
    	var parts = '';
    
		$(ctrl).parent().find('#group3').children().each(function(i,o) { options += o.text + '\n'; });
		form.find("[name=options]").val($.trim(options));
    
    	$(ctrl).parent().find('#group4').children().each(function(i,o) { parts += o.text + '\n'; });
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
    
    deleteSpaces();
  }

	/* Common method to save changes to a control - This also calls the specific methods */
	save_changes.common = function(values) {
		var div_ctrl = $("#" + values.forCtrl);
		div_ctrl.find('.control-label, .control-section').eq(0).text(values.label);

		// var $radios = div_ctrl.find('input[type=radio]');
		// var suffix = 0;
		// $radios.each(function() {
		// 	var $radio = $(this);
		// 	$radio.attr('id', values.label + '__' + suffix);
		// 	suffix++;
		// });

		var specific_save_method = save_changes[values.type];
		if(typeof(specific_save_method) != 'undefined') {
			specific_save_method(values);
		}
	}

	save_changes.category = function(values) {
		var div_ctrl = $("#" + values.forCtrl);
		var ctrl = div_ctrl.find("input")[0];
	}

   /* Specific method to save the Section name and logic that either gives radio button attribute names the section name or the name of the "option" label in its particular radio group */ 
  	save_changes.section = function(values) {
	    console.log(values);
			var div_ctrl = $("#" + values.forCtrl);
			var ctrl = div_ctrl.find("input")[0];
	    
	    var $dynamicSection = div_ctrl.find("[type='radio']");
	    var checkBoxStatus = values.selectedBox;
	    
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

 	save_changes.combobox = function(values) {
		console.log(values);
		var div_ctrl = $("#" + values.forCtrl);
		var ctrl = div_ctrl.find("select")[0];
	    var optionCount = 1;
	    var partNumberCount = 1;
		// ctrl.name = values.name;
    
		$(ctrl).empty();
   
		$(values.options.split('\n')).each(function(i,o) {
      		$(ctrl).append("<option>" + $.trim(o) + "</option>");
		});

    	$(ctrl).parent().find("select#group2").empty();

		$(values.value.split('\n')).each(function(i,o) {
			$(ctrl).parent().find("select#group2").append("<option>" + $.trim(o) + "</option>");
		});

	    ctrl.value = values.value; 
	 
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
	    
	    /* Assigning unique id's to the generated options */
	    var $individualOption = div_ctrl.find("option");        
	    $individualOption.each(function() {    
 
	      var $something = $(this);
	      if ($something.parent().is("select#group1")) {	      
		      $something.attr('id', 'option' + optionCount++);
		      $something.attr('class', 'generatedOptions');
		      $('option#option1').attr('value', '(' + partsArray[0] + ')');
		      $('option#option2').attr('value', '(' + partsArray[1] + ')');
		      $('option#option3').attr('value', '(' + partsArray[2] + ')');
		      $('option#option4').attr('value', '(' + partsArray[3] + ')');
		      $('option#option5').attr('value', '(' + partsArray[4] + ')');
		      $('option#option6').attr('value', '(' + partsArray[5] + ')');
		      $('option#option7').attr('value', '(' + partsArray[6] + ')');
		      $('option#option8').attr('value', '(' + partsArray[7] + ')');
	      }
	    });

	}
	
	save_changes.radiogroup = function(values) {
		console.log(values);
	    var form = $("#theForm");
			var div_ctrl = $("#" + values.forCtrl);
	    div_ctrl.find('.makeBold').text(values.label);
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

/* Specific method to save multiple list options and their corresponding part numbers */
 	save_changes.selectmultiplelist = function(values) {
		console.log(values);
		var div_ctrl = $("#" + values.forCtrl);
		var ctrl = div_ctrl.find("select")[0];
    	var optionCount = 1;
		// ctrl.name = values.name;
    
		$(ctrl).empty();
   
    /* Creates an Options Object with the values entered split on a new line */
		$(values.options.split('\n')).each(function(i,o) {
      		$(ctrl).parent().find("#group3").append("<option>" + $.trim(o) + "</option>");
		});
    
	/* Creates an Options Object with the values entered split on a new line */
			// $(values.value.split('\n')).each(function(i,o) {
			// $pseudoOption.children().append("<option>" + $.trim(o) + "</option>");
			// });
	    $(ctrl).parent().find("select#group4").empty();
	    
	    var data2 = $(values.value.split('\n'));
	    $.each(data2, function(key, value) {
	      $(ctrl).parent().find('select#group4')
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
	    // console.log(partsArray);  
	    
	    /* Assigning unique id's to the generated options and temporary method of linking the optionsArray and partsArray indices */
	    var $individualOption = div_ctrl.find("option");        
	      $.each(partsArray, function($index, value) {
	          var partsIndex = $index;
	          // console.log(partsIndex);
	     });
	    $individualOption.each(function() {    

	      var $something = $(this);
	      if ($something.parent().is("select#group3")) {
	        $something.attr('id', 'selectmult' + ' ' + optionCount++);
	        $something.attr('class', 'multiGroup');
	        $('option#option1').attr('value', '(' + partsArray[0] + ')');
	        $('option#option2').attr('value', '(' + partsArray[1] + ')');
	        $('option#option3').attr('value', '(' + partsArray[2] + ')');
	        $('option#option4').attr('value', '(' + partsArray[3] + ')');
	        $('option#option5').attr('value', '(' + partsArray[4] + ')');
	        $('option#option6').attr('value', '(' + partsArray[5] + ')');
	        $('option#option7').attr('value', '(' + partsArray[6] + ')');
	        $('option#option8').attr('value', '(' + partsArray[7] + ')');
	      }
    	});
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
			forCtrl: ctrl_id
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
			var ctrl_id = $("#theForm").find("[name=forCtrl]").val()
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

</script>