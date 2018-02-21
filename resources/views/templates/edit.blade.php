@extends('layouts.alt_master')

@section('content')
 <div class="container" id="main-container">
    <div class="row ph-title text-center">
    	<img class="img-responsive" src="/img/MultiCam.png">
    </div>
	<form method="POST" action="{{ action('TemplatesController@update', $template->id) }}" enctype="multipart/form-data">
	{{ method_field('PUT') }}
	{!! csrf_field() !!}
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
	                            <a href="#section" id="section-anchor" data-toggle="collapse" data-parent="#section">Controls</a>
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
      		        <!-- CLEAR & SAVE BUTTONS -->
			        <div class="btn-group"">
			                <button type="button" class="btn btn-default edit_btns" id="retrieve" style="display: none">Retrieve</button>
                      <button type="button" class="btn btn-default edit_btns" data-id="1" onclick='delete_field()' style="padding-left: 12px; padding-right: 12px">Clear</button>
			                <button type="button" class="btn btn-primary edit_btns" id="preview" style="">Preview</button>
                      <button type="submit" id="serialize" class="btn btn-primary edit_btns" style="background-color: blue; border-color: blue; padding-left: 15px; padding-right: 15px">Save</button>    
			        </div>
              <div id="checkbox_field" class="form-group" style="display: none; padding: 4px; border: 1px solid #ccc; margin-top: 10px">
                <label style="font-size: x-large; color: chartreuse; text-align: center; cursor: pointer;">Activate
                  <input type="checkbox" name="published" value="0">
                </label>
              </div> 		 	
			 	</div>		 	
			</div>
			<div class="col-md-9">
				<div class="row">
			 		<div class="col-md-6">
					 	{!! csrf_field() !!}
					 	<label class="input_labels">Directory Label</label>
						<input class="form-control" type="text" id="form_title" class="form-control" placeholder="Directory Label" name="directory_label" value="{{ $template->directory_label }}">
					</div>
					<div class="col-md-6">
					 	<label class="input_labels">Salesforce Product Code</label>
						<input type="text" class="form-control" placeholder="Salesforce Product Code" name="salesforce_product_code" value="{{ $template->salesforce_product_code }}">
					</div>
					<div>
						<textarea rows="5" id="mock_database" class="form-control" name="configuration" style="display: none;">{{ $template->configuration }}</textarea>
            <textarea rows="5" id="mdb_2" class="form-control" name="workarea_html" style="display: none;">{{ $template->workarea_html }}</textarea> 
            <textarea rows="5" id="mdb_3" class="form-control" name="submitted_names" style="display: none;">{{ $template->submitted_names }}</textarea>
            <textarea rows="5" id="mdb_4" class="form-control" name="part_numbers" style="display: none;">{{ $template->part_numbers }}</textarea>	
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
            <label class="radio-inline tech_group"><input class="" type="radio" name="cutting_technology" value="router" {{ $template->cutting_technology == 'router' ? 'checked' : '' }}>Router</label>
            <label class="radio-inline tech_group"><input class="" type="radio" name="cutting_technology" value="fabrication" {{ $template->cutting_technology == 'fabrication' ? 'checked' : '' }}>Fabrication</label>
            <label class="radio-inline tech_group"><input class="" type="radio" name="cutting_technology" value="digital_finishing" {{ $template->cutting_technology == 'digital_finishing' ? 'checked' : '' }}>Digital Finishing</label>
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

  <script type="text/javascript">
  // JS FOR PREVIEWING HTML ON ANOTHER TAB
      
  $('#preview').on('click', function() {
        console.log('preview clicked');
        $('#checkbox_field').show();
      var selected_content = $("#qo-wrap").clone();
      selected_content.find("div").each(function(i,o) {
          var obj = $(o);
          obj.removeClass("draggableField ui-draggable well ui-droppable ui-sortable");
      });
      var legend_text = $("#form_title")[0].value;
      if(legend_text == "") {
          legend_text = "Form Builder Preview";
      }
      selected_content.find("#form-title-div").remove();
      var selected_content_html = selected_content.html();
     var dialogContent = '<!DOCTYPE HTML>\n<html lang="en-US">\n<head>\n<meta charset="UTF-8">\n<title></title>\n';
  dialogContent+= "<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\">";    
  dialogContent+= "</scr" + "ipt>";
  dialogContent+= "<script src=\"http://code.jquery.com/ui/1.12.0/jquery-ui.min.js\">";
  dialogContent+= "</scr" + "ipt>";
  dialogContent+= '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">\n';
  dialogContent+= '<style>\n'+$("#content-styles").html()+'\n</style>\n';
  dialogContent+= '</head>\n<body>\n<form>';
  dialogContent+= '<legend id="form_header" style="text-align:center; font-size:35px">'+legend_text+'</legend>';
  dialogContent+= selected_content_html;
  dialogContent+= '<div class="row">';
  dialogContent+=   '<div class="col-md-6" style="text-align:right">';
  dialogContent+=     '<button type="button" id="test-submit" class="btn btn-success btn-lg">Test Submit</button>';
  dialogContent+=   '</div>';
  dialogContent+=   '<div class="col-md-6">';
  dialogContent+=     '<button type="button" id="close_window" class="btn btn-info btn-lg">Close Window</button>';
  dialogContent+=     '<input type="hidden" name="" value="">';  
  dialogContent+=   '</div>';
  dialogContent+= '</div>';
  dialogContent+= '</div>';
  dialogContent+= '<br>';
  dialogContent+= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
  dialogContent+=   '<div class="modal-dialog">';
  dialogContent+=   '<div class="modal-content" style="width: 700px; height: 700px">';
  dialogContent+=     '<div class="modal-header">';
  dialogContent+=           '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
  dialogContent+=         '<h4 class="modal-title" id="myModalLabel">User Selected Values</h4>';                
  dialogContent+=       '</div>';
  dialogContent+=     '<div class="modal-body"><p class="p-body"></p></div>';
  dialogContent+=   '</div>';
  dialogContent+= '</div>';
  dialogContent+= '</div>'; 
  dialogContent+= "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\">"               
  dialogContent+= "</scr" + "ipt>";              
  dialogContent+= '<script>';
  dialogContent+= 'function output(inp) {\
                     \n    document.body.appendChild(document.createElement("pre")).innerHTML = inp;\
                     \n    $("html, body").animate({\
                     \n      scrollTop: $("pre").offset().top\
                     \n        }, 500);\
                  }';
  dialogContent+= '\n $(\'input[type="radio"]\').click(function(e){\
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
                     \n\
                     \n $("#test-submit").on("click", function(event) {\
                     \n     var config_title = $("#form_header").text();\
                     \n     $.ajax({\
                     \n       type: "get",\
                     \n       url: "{!!URL::to("getRulesData")!!}",\
                     \n       data: {},\
                     \n       success:function(data) {\
                     \n         console.log(data);\
                     \n         $("#work-area").find("input[type=\'radio\']").each(function(i,o){\
                     \n           var btn = $(this);\
                     \n           var btn_name = $(this).attr("name");\
                     \n           $.each(data, function(index, rule) {\
                     \n             if(config_title == rule.directory_label && btn_name == rule.submitted_output) {\
                     \n               if(rule.input_1 == $(\'[name="\'+rule.submitted_name_1 + \'"]\').val()\
                     \n               && rule.input_2 == $(\'[name="\'+rule.submitted_name_2 + \'"]\').val()\
                     \n               && rule.input_3 == $(\'[name="\'+rule.submitted_name_3 + \'"]\').val()) {\
                     \n                 if(btn.hasClass("required_radio")) {\
                     \n                   btn.val("r(" + rule.output + ")");\
                     \n                 } else if (btn.hasClass("optional_radio")){ \
                     \n                   btn.val("o(" + rule.output + ")");\
                     \n                 } else if (btn.hasClass("na_radio")) {\
                     \n                   btn.val("n(" + rule.output + ")");\
                     \n                 } else {\
                     \n                   btn.val(rule.output);\
                     \n                 }\
                     \n               } else {\
                     \n                 console.log("rule not met");\
                     \n               }\
                     \n             }\
                     \n           });\
                     \n          });\
                     \n\
                     \n         var new_obj = {};\
                     \n         $.each($(\'form\').serializeArray(), function(i,obj) {\
                     \n           new_obj[obj.name] = obj.value\
                     \n         });\
                     \n         var str = (JSON.stringify(new_obj, undefined, 3));\
                     \n         if ($("pre").length > 0) {\
                     \n           $("pre").remove();\
                     \n           output(str);\
                     \n         } else {\
                     \n           output(str);\
                     \n         }\
                     \n\
                     \n       },\
                     \n       error:function(){\
                     \n       }\
                     \n     });\
                     \n });\
                     \n\
                     \n var selected_option = $("#preview_dropdown option:selected").text();\
                     \n $(".group1").on("change", function() {\
                     \n     if($(this).val() == "001733-SLVI-125-575-K"){console.log("works");\
                     \n       console.log($("#work-area").find("input[type=\'radio\']:checked").val());\
                     \n     }\
                     \n });\
                     \n $(\'.group1\').prepend(\'<option value=\"\">Please make a selection</option>\').val(\'\');\
                     \n $(\'.group3\').prepend(\'<option value=\"\">Please make a selection</option>\').val(\'\');\
                     \n $(\'#close_window\').click(function(){ window.close(); });';        
    dialogContent += "\n</scr" + "ipt>";
    dialogContent += '\n</form>'
    dialogContent += '\n</body></html>';
      var win = window.open("about:blank");
      win.document.write(dialogContent);
  });


  </script>

<script>
  $("document").ready(function() {
    setTimeout(function() {
      $("#retrieve").trigger('click');
    }, 100)
  }); 


</script>


@stop