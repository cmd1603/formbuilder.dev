@extends('layouts.alt_master')
 
 @section('content')
 <div class="container" id="main-container">
    <div class="row ph-title text-center">
    	<img class="img-responsive" src="/img/MultiCam.png">
    </div>
	<form method="POST" action="{{ action('TemplatesController@store') }}" enctype="multipart/form-data">
    <div class="container">
	 	<div class="row">
		 	<div class="col-md-3" style="margin-top: 5px">
		        <!-- SIDE BAR -->
	            <div class="panel-group" id="sidebar" style="margin-bottom: 0px">
	                <div class="panel panel-primary catField selectorField draggableField">
	                    <div class="panel-heading"><h3 class="control-label ctrl-category text-uppercase">CATEGORY</h3></div>
	                        <div class="panel-body category-body"></div>
	                </div>
	                <div class="panel panel-default sectField sect_click selectorField draggableField">
	                    <div class="panel-heading"><h4 class="control-label ctrl-section">Section</h4></div>
	                        <div class="panel-body section-body"></div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h3 class="panel-title">
	                            <a href="#section" id="section-anchor" data-parent="#section">Controls</a>
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
	              	<textarea rows="5" id="mock_database" class="form-control" name="configuration">{{ old('configuration') }}</textarea>
	              	<textarea rows="5" id="mdb_2" class="form-control" name="workarea_html" style="display: none;">{{ old('workarea_html') }}</textarea>
	              	<textarea rows="5" id="mdb_3" class="form-control" name="submitted_names" style="display: none;">{{ old('submitted_names') }}</textarea>
	              	<textarea rows="5" id="mdb_4" class="form-control" name="part_numbers" style="display: none;">{{ old('part_numbers') }}</textarea>
      		        <!-- CLEAR & SAVE BUTTONS -->
			        <div class="btn-group"">
			        		<button type="button" class="btn btn-default" id="retrieve" style="margin-right: 0px; background-color: darkgray">Retrieve</button>
			                <button type="button" class="btn btn-default" data-id="1" style="margin-right: 0px" onclick='delete_field()'>Clear</button>
			                <button type="submit" id="serialize" class="btn btn-primary" style="background-color: blue; border-color: blue; margin-right: 0px">Save</button>
			        </div> 		 	
			 	</div>		 	
			</div>
			<div class="col-md-9">
				<div class="row">
			 		<div class="col-md-6">
					 	{!! csrf_field() !!}
					 	<label class="input_labels">Directory Label</label>
					 		@include('partials.form', ['class' => 'form-control', 'id' => 'form_title', 'field' => 'directory_label', 'label' => 'Directory Label', 'type' => 'text', 'placeholder' => 'Directory Label'])
					</div>
					<div class="col-md-6">
					 	<label class="input_labels">Salesforce Product Code</label>	
					 		@include('partials.form', ['class' => 'form-control', 'id' => 'sfpc', 'field' => 'salesforce_product_code', 'label' => 'Salesforce Product Code', 'type' => 'text', 'placeholder' => 'Salesforce Product Code'])
					</div>
				</div>		
				<div class="row text-center" style="margin-bottom: 10px">
			      <div class="col-md-12">
			        <button type="button" class="btn btn-success trigger_btns" id="trigger_cat">Drop Category</button>
			        <button type="button" class="btn btn-warning trigger_btns" id="trigger_sect">Drop Section</button>
			        <button type="button" class="btn btn-danger trigger_btns" id="trigger_combo">Drop Combo</button>
			        <button type="button" class="btn btn-danger trigger_btns" id="trigger_radio">Drop Radio</button>
			        <button type="button" class="btn btn-danger trigger_btns" id="trigger_mult">Drop Mult</button>
			        <button type="button" class="btn btn-danger trigger_btns" id="trigger_number">Drop Number</button>
			        <button type="button" class="btn btn-danger trigger_btns" id="trigger_ul">Drop Text</button>
			      </div>
			    </div>  
			    <div class="row">  
			      <div class="col-md-12">
			      	<label class="input_labels">Cutting Technology</label>
		      		<label class="radio-inline tech_group"><input class="" type="radio"  name="cutting_technology" value="router">Router</label>
		      		<label class="radio-inline tech_group"><input class="" type="radio"  name="cutting_technology" value="fabrication">Fabrication</label>
		      		<label class="radio-inline tech_group"><input class="" type="radio"  name="cutting_technology" value="digital_finishing">Digital Finishing</label>
			      </div>  
			    </div>
		        <!-- WORK AREA -->
		        <div id="qo-wrap">  

		        <!-- COLUMNS FOR DROPPING FIELDS -->
		            <div class="row" id="inner_wrap">
		                <div class="col-md-12 center-blocks" id="work-wrap" style="margin-left: 15px">
		                        <div id="work-area" class="col-md-11 well droppedFields"></div>
		                </div>   
		            </div>
		        </div>			      
			</div> 
		</div>
	</form>
	</div>			

  <script>
    /* --------- SIMULATE DRAG AND DROP METHODS --------- */
      $(document).on('click', '.catField, #trigger_cat', function(e) {
        $('.catField').simulate("drag", {
          dragTarget: '.droppedFields',
        });
        $('.catField').simulate("drop");
      });
        
      $(document).on('click', '.sect_click, #trigger_sect', function(e) { 
        $('.sectField').simulate("drag", {
          dragTarget: ".droppedCategory .panel-body:last",
        });
        $('.sectField').simulate("drop");
      });

      $(document).on('click', '.select_one_click, #trigger_combo', function(e) {
        $('.ctrl-select_one').simulate("drag", {
          dragTarget: ".droppedSect .section-body:last",
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
  //  JS FOR ClLEARING THE WORK AREA
    function delete_field() {
        if(window.confirm("Are you sure you want to clear the work area?")) {
            $('[id^="CTRL-DIV"]').remove();
            model = {};
            console.log("model", model);
            console.log("FIELD CLEARED");
        }
    }


  </script>

 @stop 