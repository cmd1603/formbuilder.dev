<?php

$servername = ""	

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Quote and Order Builder</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">		
		<link rel="stylesheet" type="text/css" href="/css/site.css">
		<style id="content-styles">
			.droppedElem {
				padding-left: 10px;
			}
			.form-horizontal .control-label {
			    float: left;
			    width: 160px;
			    padding-right: 5px;
			    text-align: right;
			}

			.form-horizontal .control-section {
			    float: left;
			    width: 160px;
			    padding-right: 5px;
			    text-align: right;
			}


			.control-label; {
			    padding-top: 5px;
			    vertical-align: baseline;
			    padding-right: 10px;
			}

			.decreaseSectPadding {
				padding: 1px 15px;
			}

			.droppedCategory, .droppedSect > input, select, button, .ctrl-textbox, .checkboxgroup, .selectmultiplelist, .radiogroup, .ctrl-number {
				margin-top: 10px;
				margin-bottom: 10px;
				margin-right: 10px;
			}

			.ctrl-select_one {
				width: 99%;
			}
			
			.modal-dialog {
			  position: relative;
			  display: table;
			  overflow-y: auto;
			  overflow-x: auto;
			  width: auto;
			  min-width: 500px;
			}

			.droppedElem .ctrl-selectmultiplelist {
				width: 450px;
			}

			.panel {
				margin-bottom: 10px;
			}
			.pb-sect {
				padding: 0px;
			}

			.panel-body {
				padding: 8px;
			}

			body {
				width: 90%;
			}
		</style>
	</head>	
	<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row ph-title text-center">
                <h1 id="header-title">Form Builder</h1> 
            </div>
        </div>
        <div class="container">
            <div class="row text-center">
              <div class="col-md-12">
                <button class="btn btn-default" id="serialize">Serialize</button>
                <button class="btn btn-default" id="retrieve">Retrieve</button>
                <button class="btn btn-success trigger_btns" id="trigger_cat">Drop Category</button>
                <button class="btn btn-warning trigger_btns" id="trigger_sect">Drop Section</button>
                <button class="btn btn-danger trigger_btns" id="trigger_combo">Drop Combo</button>
                <button class="btn btn-danger trigger_btns" id="trigger_radio">Drop Radio</button>
                <button class="btn btn-danger trigger_btns" id="trigger_mult">Drop Mult</button>
                <button class="btn btn-danger trigger_btns" id="trigger_number">Drop Number</button>
                <button class="btn btn-danger trigger_btns" id="trigger_ul">Drop Text</button>
              </div>  
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <!-- SIDE BAR -->
                <div class="col-md-3 ">
                    <div class="panel-group" id="sidebar">
                        <div class="panel panel-primary catField selectorField draggableField">
                            <div class="panel-heading"><h3 class="control-label ctrl-category text-uppercase">CATEGORY</h3></div>
                                <div class="panel-body"></div>
                        </div>
                        <div class="panel panel-default sectField sect_click selectorField draggableField">
                            <div class="panel-heading"><h4 class="control-label ctrl-section">Section</h4></div>
                                <div class="panel-body"></div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#section" data-toggle="collapse" data-parent="#section">Controls</a>
                                </h3>
                            </div>
                            <div id="section" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="tab-pane" id="multiple">
                                        <div class='elemField select_one_click selectorField draggableField'>
                                            <label class="control-label optional_label" style="vertical-align: top" placeholder="optional"></label>
                                            <select type="select-one" class="ctrl-select_one form-control group1" name="select_one" style="display: inline-block;">
                                                <option value="option1">Option 1</option>
                                                <option value="option2">Option 2</option>
                                                <option value="option3">Option 3</option>
                                            </select>
                                            <select class="form-control group2" style="display: none;">
                                                <option value="option1">Part#1</option>
                                                <option value="option2">Part#2</option>
                                                <option value="option3">Part#3</option>
                                            </select>
                                        </div>                                    
                                        <div class='elemField radiogroup_click selectorField draggableField'>
                                            <div class="ctrl-radiogroup" style="display: inline-block;">
                                                <label class="radio-inline reqField"><input class="required_radio" type="radio"  name="radioField" value="r()">Required</label>
                                                <label class="radio-inline optionField"><input class="optional_radio" type="radio" name="optionalField_" value="o()">Optional</label>
                                                <label class="radio-inline naField"><input class="na_radio" type="radio" name="naField_" value="n()" checked="checked">N/A&nbsp<b class="makeBold">Option</b></label>  
                                                <label class="radio-inline" style="display: none"><input class="placeHolderClass" type="radio" name="" value="">N/A&nbsp<b></b></label> 
                                            </div>
                                        </div>
                                        <div class='elemField selectmultiplelist_click selectorField draggableField'>
                                            <div style="display: inline-block;">
                                            	<label class="control-label optional_label_mult" style="vertical-align: top" placeholder="optional"></label>
                                                <select type="select-multiple" multiple="multiple" class="ctrl-selectmultiplelist form-control group3" name="selectMultiple">
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                </select>      
                                                <select class="form-control group4" name="" style="display: none;">
                                                  <option value="option1">Part#1</option>
                                                  <option value="option2">Part#2</option>
                                                  <option value="option3">Part#3</option>
                                                </select>                                                                
                                            </div>
                                        </div>
                                        <div class="elemField number_click selectorField draggableField">
                                                <div class="number_group">
                                                    <label class="radio-inline">
                                                    		<input type="number" class="ctrl-number form-control" name="number" min="0" max="0" step="0" style="max-width: 65px; display: inline-block">
                                                    		<b class="number_option">Option</b>
                                                    </label>
                                                </div>
                                        </div>
                                        <div class="elemField ul_click selectorField draggableField">
                                        	<div class="ctrl-unordered_list">
	                                        	<label class="radio-inline">
	                                        		<ul>
	                                        			<li class="ul_label"><b class="ul_txt">Text</b></li>
	                                        		</ul>
	                                        	</label>
	                                        </div>	
                                        </div> 
                                    </div>               	    
                                </div>
                            </div>
                    	</div>
                        <br>
                        <div>
                        	<textarea id="mock_database" class="form-control" rows="5"></textarea>
                        </div>
                    </div>    
                </div>           
                        

                <!-- WORK AREA -->
                <div class="col-md-8" id="qo-wrap">
                <!-- TITLE -->
                    <div class="row">
                        <div class="col-md-8 col-centered" id="form-title-div">
                            <div class="col-md-12 input-group">
                                <input type="text" class="form-control input-large text-center" placeholder="Type title here" id="form-title" required>
                            </div>
                            <div class="col-md-6 input-group col-centered">
                                <input type="text" class="form-control input-large text-center" placeholder="Salesforce product code" id="salesforce_code" required>
                            </div>                                  
                        </div>
                    </div>    

                <!-- COLUMNS FOR DROPPING FIELDS -->
                    <div class="row">
                        <div class="col-md-12 center-blocks" id="work-wrap">
                                <div id="work-area" class="col-md-11 well droppedFields"></div>
                        </div>   
                    </div>
                </div>

                <!-- CLEAR & SAVE BUTTONS -->
                <div class="btn-group" style="float: right; padding: 2%">
                        <button class="btn btn-default btn-lg" data-id="1" style="border-color: grey" onclick='delete_field()'>Clear</button>
                        <button class="btn btn-primary btn-lg" id="save" onclick='preview()'>Preview</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://rawgit.com/jquery/jquery-ui/1-11-stable/external/jquery-simulate/jquery.simulate.js"></script>
<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/libs/bililiteRange.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/libs/jquery.simulate.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.ext.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.drag-n-drop.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.key-sequence.js"></script>
<script type="text/javascript" src="/js/jquery-simulate-ext-master/src/jquery.simulate.key-combo.js"></script>


<script>

	/*  --------- JS FOR ClLEARING THE WORK AREA --------- */

	function delete_field() {
	    if(window.confirm("Are you sure you want to clear the work area?")) {
	        $('[id^="CTRL-DIV"]').remove();
	        model = {};
	        console.log("model", model);
	        console.log("FIELD CLEARED");
	    }
	}
	  
	/* --------- SIMULATE DRAG AND DROP METHODS --------- */

	  $(document).on('click', '.catField, #trigger_cat', function(e) {
	  	$('.catField').simulate("drag", {
	  		dragTarget: '.droppedFields',
	  	});
	  	$('.catField').simulate("drop");
	  });
	  	
	  $(document).on('click', '.sect_click, #trigger_sect', function(e) { 
	    $('.sectField').simulate("drag", {
	    	dragTarget: ".droppedCategory:last",
	    });
	    $('.sectField').simulate("drop");
	  });

	  $(document).on('click', '.select_one_click, #trigger_combo', function(e) {
	  	$('.ctrl-select_one').simulate("drag", {
	  		dragTarget: ".droppedSect .panel-body:last",
	  	});
	  	$('.ctrl-select_one').simulate("drop");
	  });

	  $(document).on('click', '.radiogroup_click, #trigger_radio', function(e) {
	  	$('.ctrl-radiogroup').simulate("drag", {
	  		dragTarget: ".droppedSect .panel-body:last",
	  	});
	  	$('.ctrl-radiogroup').simulate("drop");
	  });
	  
	  $(document).on('click', '.selectmultiplelist_click, #trigger_mult', function(e) {
	  	$('.ctrl-selectmultiplelist').simulate("drag", {
	  		dragTarget: ".droppedSect .panel-body:last",
	  	});
	  	$('.ctrl-selectmultiplelist').simulate("drop");
	  });

	  $(document).on('click', '.number_click, #trigger_number', function(e) {
	  	$('.ctrl-number').simulate("drag", {
	  		dragTarget: ".droppedSect .panel-body:last",
	  	});
	  	$('.ctrl-number').simulate("drop");
	  });	  	  	  

	  $(document).on('click', '.ul_click, #trigger_ul', function(e) {
	  	$('.ctrl-unordered_list').simulate("drag", {
	  		dragTarget: ".droppedSect .panel-body:last",
	  	});
	  	$('.ctrl-unordered_list').simulate("drop");
	  });

</script>

<!-- /////////////////////////// HANDLEBARS SCRIPTING FOR BOOTSTRAP MODAL EDITING ///////////////////////////////// -->

<script id="control-customize-template" type="text/x-handlebars-template">
			<div class="modal-body">
				<form id="theForm" class="form-horizontal">
					<input type="hidden" value="{{type}}" name="type">
					<input type="hidden" value="{{ctrl_ID}}" name="ctrl_ID">
					{{{content}}}
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
		<p><label class="control-section">Part Number</label><input class="form-control" type="text" name="submitted_name" style="width: 50%" required /></p>		
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
		console.log("model", model);
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

    	$('#select_one_required').prop('checked', model[div_ctrl.prop('id')].required_field);

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

    	form.find("[name=value]").val(trimText.replace(/\(|\)/g,''));
    	form.find("[name=submitted_name]").val(div_ctrl.attr('name'));
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

		deleteSpaces();
  	}

	/* Specific method to load values from a category control to the customization dialog */
	load_values.unordered_list = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#" + ctrl_id);
		var ctrl = div_ctrl.find("input")[0];
		form.find("[name=label]").val(div_ctrl.find('.ul_label').text());
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
	   	console.log(model);

	    if(checkBoxStatus == true) {
	      $dynamicSection.each(function() {
	        var $newName = $(this); 
	        var dynamicName = ($newName.parent().parent().parent().prop('id'));
	        $newName.attr("name", (values.label.replace(/\s/g,'')) + "__" + ((dynamicName.replace(/[^0-9]/g,'') - 3001)));
	      });    
	    } else {
	        (checkBoxStatus == false);
	        $dynamicSection.each(function() {
	        var $everyRadioBtn = $(this);
	          var dynamicName = ($everyRadioBtn.parent().parent().parent().prop('id'));
	        $everyRadioBtn.attr("name", ((values.label.replace(/\s/g,'')) + (dynamicName.replace(/[^0-9]/g,'') - 3001)) + "__" + ((dynamicName.replace(/[^0-9]/g,'') - 3001)));
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
			
	    });
	
		
		// model[div_ctrl.parent().parent().prop('id')].controls = [];
		// var new_config = {id: values.ctrl_ID, pairs: [], required_field: false, name: values.submitted_name};

		// div_ctrl.parent().parent().find('.droppedElem').find('.group1').each(function() {
		// 	model[div_ctrl.parent().parent().prop('id')].controls.push(new_config);
		// });
		

		// if (div_ctrl.find('.group1').find('option').length != 0) {
		// 			div_ctrl.find('.group1').find('option').each(function() {
		// 				var select_one_pairs = {
		// 					type: "pair",
		// 					n: $(this).text(),
		// 					v: $(this).attr("value").replace(/\(|\)/g, '')
		// 				};
		// 				new_config.pairs.push(select_one_pairs);
		// 			});
					
		// 		}	
		
		console.log(model);
	}
	 
	save_changes.radiogroup = function(values) {
		console.log(values);
	    var form = $("#theForm");
		var div_ctrl = $("#" + values.ctrl_ID);
	    div_ctrl.find('.makeBold').text(values.label);
	    values.submitted_name = div_ctrl.attr('name');

	    model[values.ctrl_ID].required_field = $('#radio_required').prop('checked');
	    console.log(model);
	   
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
	    
	    // var $create_select_one_id = div_ctrl.parent().find("select.ctrl-selectmultiplelist");
	    
	    // 	$create_select_one_id.each(function() {
	    // 		var $foo = $(this);
	    // 		if ($foo.hasClass('group3')) {
	    // 			if($foo.prev('.optional_label_mult').text() != "") {
	    // 				$foo.attr("name", $foo.prev('.optional_label_mult').text());
	    // 			}	
	    // 		}	
	    // 	});

	    
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
		values.submitted_name = div_ctrl.attr('name');
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


  	/* --------- METHODS FOR RETREIVING A SAVED CONFIGURATION ---------- */
	var globalFormObject = {is_retrieving: false};


  	$('#retrieve').click(function() {
  		
  		globalFormObject.is_retrieving = true;
  		var obj = JSON.parse($('#mock_database').val());
  		console.log(obj);
  		globalFormObject.obj = obj;
  		globalFormObject.sect_index;
  		globalFormObject.control_index;
  		globalFormObject.select_one__pairs_index;

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
	  				globalFormObject.sect_index = 0;
	  				$("#trigger_cat").click();

	  	/* WHERE I LEFT OFF - MUST RESET THE SECTION INDEX EVERYTIME A CATEGORY IS DROPPED */
	  				// var $new_area = $('#work-area').children().last();
	  				// $new_area.find('.ctrl-category').html($title);	  				
	  			}
		
	  			$.each(array_sects, function(index, sects_obj) {
		  			// console.log($(this).prop('id'));
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

						} else {
							($single_ctrl.prop('type') == "ctrl-unordered_list") 
							$("#trigger_ul").click();
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
  						title: $("#form-title").val(),
  						salesforce_product_code: $("#salesforce_code").val(), 
  						categories: []
  					};	

  		$('#work-area').children().each(function() {
  			addNode(config, this);
  		});

  		console.log(JSON.stringify(config, true, 3));
  		$("#mock_database").empty();
  		$("#mock_database").val(JSON.stringify(config,true, 2));
  	});

	function addNode(parent, node) {
		var ctrl = $(node).find("[class*=ctrl]")[0];

		var category_config = {
				 	type: $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
				 	label: $(node).find('.ctrl-category').text(),
				 	id: node.id, 
				 	sections: []
				};

		$(node).find('.droppedSect').each(function() {
			var $sects = $(this);
			console.log($(this).prop('id'));
			var ctrl2 = ($(node).find('.droppedSect').find("[class*=ctrl]")[0]);
			var section_config = {
							type: $.trim(ctrl2.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]),
							label: $sects.find('.ctrl-section').text(),
							// id: $sects.prop('id'),
							mutex: model[$sects.prop('id')].mutex,
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
										v: $(this).attr("value").replace(/\(|\)/g, '') //removes parentheses	
									};
								select_one_config.pairs.push($select_one_pairs);
						});	
					}

				} else if ($user_ctrls.find('.ctrl-radiogroup').length != 0) {
					// console.log($user_ctrls.attr('name'));
					var radiogroup_config = {
								type: "ctrl-ron",
								// name: $user_ctrls.attr('name'),
								label: $user_ctrls.find('.makeBold').text(),
								required_field: model[$user_ctrls.prop('id')].required_field,
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
								required_field: model[$user_ctrls.prop('id')].required_field,
								id: $user_ctrls.prop('id'),
								pairs: []
					};

					section_config.controls.push(select_multiple_config);
						$user_ctrls.find('.group3').find('option').each(function() {
							var $select_mult_pairs = {
										type: "pair", 
										n: $(this).text(), 
										v: $(this).attr("value").replace(/\(|\)/g, '') //removes parentheses	
								};
								select_multiple_config.pairs.push($select_mult_pairs);
						});

				} else if ($user_ctrls.find('.ctrl-number').length != 0) {
					var number_config = {
								type: "ctrl-number",
								name: $user_ctrls.find('.ctrl-number').attr('name'),
								label: $user_ctrls.find('.number_option').text(),
								required_field: model[$user_ctrls.prop('id')].required_field,							
								id: $user_ctrls.prop('id'),
								min: $user_ctrls.find('.ctrl-number').attr("min"),
								max: $user_ctrls.find('.ctrl-number').attr("max"),
								step: $user_ctrls.find('.ctrl-number').attr("step")
					};
					section_config.controls.push(number_config);
				} else {
					var ul_config = {
								type: "ctrl-unordered_list",
								label: $user_ctrls.find('.ul_txt').text(),
								required_field: model[$user_ctrls.prop('id')].required_field
					};						
					section_config.controls.push(ul_config);	
				}

			});
			
		});

	// console.log(model);
	parent.categories.push(category_config);
				

	}
		
</script>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js"></script>
<script src="https://cdn.rawgit.com/blowsie/Pure-JavaScript-HTML5-Parser/master/htmlparser.js"></script>
<script type="text/javascript">

// JS FOR PREVIEWING HTML ON ANOTHER TAB
function preview() {
    console.log('preview clicked');

    var selected_content = $("#qo-wrap").clone();
    selected_content.find("div").each(function(i,o) {
        var obj = $(o)
        obj.removeClass("draggableField ui-draggable well ui-droppable ui-sortable");
    });
    var legend_text = $("#form-title")[0].value;

    if(legend_text == "") {
        legend_text = "Form Builder Preview";
    }
    selected_content.find("#form-title-div").remove();

    var selected_content_html = selected_content.html();

  var dialogContent = '<!DOCTYPE HTML>\n<html lang="en-US">\n<head>\n<meta charset="UTF-8">\n<title></title>\n';
  dialogContent+= '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">\n';
  dialogContent+= '<style>\n'+$("#content-styles").html()+'\n</style>\n';
  dialogContent+= '</head>\n<body>\n<form>';
  dialogContent+= '<legend style="text-align:center; font-size:35px">'+legend_text+'</legend>';
  dialogContent+= selected_content_html;
  dialogContent+= '<div class="row">';
  dialogContent+= 	'<div class="col-md-4" style="margin-left: 15px">';
  dialogContent+= 		'<button type="submit" id="test-submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Test Submit</button>';
  dialogContent+=	'</div>';
  dialogContent+= '</div>';
  dialogContent+= '<br>';
  dialogContent+= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  dialogContent+= 	'<div class="modal-dialog">';
  dialogContent+=		'<div class="modal-content" style="width: 700px; height: 700px">';
  dialogContent+=			'<div class="modal-header">';
  dialogContent+=       		'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
  dialogContent+=					'<h4 class="modal-title" id="myModalLabel">User Selected Values</h4>';                
  dialogContent+=  			'</div>';
  dialogContent+=			'<div class="modal-body"><p class="p-body"></p></div>';
  dialogContent+=		'</div>';
  dialogContent+=	'</div>';
  dialogContent+= '</div>'; 
  dialogContent+= "<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\">";    
  dialogContent+= "</scr" + "ipt>";
  dialogContent+= "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\">";                
  dialogContent+= "</scr" + "ipt>";              
  dialogContent+= '<script>';
  dialogContent+= '$(\'input[type="radio"]\').click(function(e){\
                     \n var me = $(this);\
                     \n var name = me.prop(\'name\');\
                     \n   var value = me.val();\
                     \n   if(value.substr(0,1) == \'r\'){\
                     \n     var pos = name.indexOf(\'__\');\
                     \n     var pre = name.substr(0,pos)+\'__\';\
                     \n     $(\'input[type="radio"][name^="\'+pre+\'"][value^="r"]\').each(function(index){\
                     \n       if(this.checked){\
                     \n         if(!(me.is(this))){\
                     \n           alert("Only 1 can be Required.  Changing to Optional...");\
                     \n           $(\'input[type="radio"][name="\'+name+\'"][value^="o"]\').prop(\'checked\', true);\
                     \n         }\
                     \n       }\
                     \n     });\
                     \n  }\
                     \n });\
					 \n var infoModal = $("#myModal");\
                     \n	$("form").submit(function(event) {\
					 \n	 var values = ($(this).serializeArray());\
					 \n  console.log(JSON.stringify(values, true, 3));\
					 \n  infoModal.find(".p-body").html(JSON.stringify(values, true, 3));\
                     \n  event.preventDefault();\
                  	 \n });\
                  	 \n $(\'.group1\').prepend(\'<option value=\"\">Please make a selection</option>\').val(\'\');\
                  	 \n $(\'.group3\').prepend(\'<option value=\"\">Please make a selection</option>\').val(\'\');';                  	 
    dialogContent += "\n</scr" + "ipt>";
    dialogContent += '\n</form>'
    dialogContent += '\n</body></html>';

    var win = window.open("about:blank");
    win.document.write(dialogContent);

}

</script>
	<script type="text/javascript" src="/js/site.js"></script>
	</body>
</html>
