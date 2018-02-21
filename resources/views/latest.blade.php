@extends('layouts.master')
@section('content')
<div class="stable_img1">
        <div class="container">
            <div class="row ph-title text-center">
                <img class="center-block img-responsive" src="/img/MultiCam.png">
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
                                        <div class="elemField ul_click selectorField draggableField">@@
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
function preview() {
    console.log('preview clicked');
    var selected_content = $("#qo-wrap").clone();
    selected_content.find("div").each(function(i,o) {
        var obj = $(o);
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
  dialogContent+=   '<div class="col-md-4" style="margin-left: 15px">';
  dialogContent+=     '<button type="submit" id="test-submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Test Submit</button>';
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
                     \n $.fn.serializeObject = function() {\
                     \n     var o = {};\
                     \n     var a = this.serializeArray();\
                     \n     $.each(a, function() {\
                     \n         if(o[this.name] !== undefined) {\
                     \n             if(!o[this.name].push) {\
                     \n                 o[this.name] = [o[this.name]];\
                     \n             }\
                     \n                 o[this.name].push(this.value || "");\
                     \n         } else {\
                     \n                 o[this.name] = this.value || "";\
                     \n         }\
                     \n     });\
                     \n     return o;\
                     \n };\
                     \n var infoModal = $("#myModal");\
                     \n $("form").submit(function(event) {\
                     \n     var values = ( JSON.stringify($(this).serializeObject()) );\
                     \n   var data = (values.replace(/\,/g,",\\n"));\
                     \n   infoModal.find(".modal-body").html(data);\
                     \n     event.preventDefault();\
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
</div>
@endsection