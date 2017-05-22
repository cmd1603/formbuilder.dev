@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="container">
            <div class="row ph-title text-center">
                <h1 id="header-title">Form Builder</h1> 
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
                        <div class="panel panel-default sectField selectorField draggableField">
                            <div class="panel-heading decreaseSectPadding"><h4 class="control-label ctrl-section">Section</h4></div>
                                <div class="panel-body pb-sect"></div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#section" data-toggle="collapse" data-parent="accordion">Controls</a>
                                </h3>
                            </div>
                            <div id="section" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="tab-pane" id="multiple">
                                        <div class='elemField selectorField draggableField'>
                                            <label class="control-label" style="vertical-align: top" placeholder="optional"></label>
                                            <select class="ctrl-combobox form-control" id="group1" style="display: inline-block;">
                                                <option selected="" value=""></option>
                                                <option value="option1" class"dropdownOption">Option 1</option>
                                                <option value="option2" class"dropdownOption">Option 2</option>
                                                <option value="option3" class"dropdownOption">Option 3</option>
                                            </select>
                                            <select class="ctrl-combobox form-control" id="group2" style="display: none;">
                                                <option value="option1" id="part1" class"dropdownPartNumbers">Part# 1</option>
                                                <option value="option2" id="part2" class"dropdownPartNumbers">Part# 2</option>
                                                <option value="option3" id="part3" class"dropdownPartNumbers">Part# 3</option>
                                            </select>
                                        </div>                                    
                                        <div class='elemField selectorField draggableField'>
                                            <!-- <label class="control-label" style="vertical-align: top"></label> -->
                                            <div class="ctrl-radiogroup" style="display: inline-block;">
                                                <label class="radio-inline" id="reqField"><input class="required_radio" type="radio"  name="radioField_" value="r()">Required</label>
                                                <label class="radio-inline" id="optionField"><input class="optional_radio" type="radio" name="optionalField_" value="o()">Optional</label>
                                                <label class="radio-inline"><input class="na_radio" type="radio" name="naField_" value="n()" checked="checked">N/A&nbsp<b id="makeBold">Option</b></label>
                                                <label class="radio-inline" style="display: none"><input class="placeholderClass" type="radio" name="naField_" value="">N/A&nbsp<b id="testCase">Part#</b></label> 
                                            </div>
                                        </div>
                                        <div class='elemField selectorField draggableField'>
                                            <!-- <label class="control-label" style="vertical-align: top"></label> -->
                                            <div style="display: inline-block;">
                                                <select multiple="multiple" class="ctrl-selectmultiplelist form-control">
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                </select>                                                                    
                                            </div>
                                        </div>
                                        <div class="elemField selectorField draggableField">
                                            <!-- <label class="control-label radio-inline" style="vertical-align: top"></label> -->
                                                <div style="display: inline-block;">
                                                    <input type="number" class="ctrl-number form-control" style="width: 25%" name="number">&nbsp <b></b>
                                                </div>
                                        </div>                                                
                                    </div>                                      
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>            
                        

                <!-- WORK AREA -->
                <div class="col-md-8" id="qo-wrap">
                <!-- TITLE -->
                    <div class="row">
                        <div class="col-md-8 col-centered" id="form-title-div">
                            <div class="col-md-12 input-group">
                                <input type="text" class="form-control input-large" placeholder="Type title here" id="form-title">
                            </div>    
                        </div>
                    </div>    

                <!-- COLUMNS FOR DROPPING FIELDS -->
                    <div class="row">
                        <div class="col-md-12 center-blocks">
                                <div id="selected-column-1" class="col-md-11 well droppedFields"></div>
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

<script>
//  JS FOR ClLEARING THE WORK AREA
function delete_field() {
    if(window.confirm("Are you sure you want to clear the work area?")) {
        $('[id^="CTRL-DIV"]').remove();
        console.log("FIELD CLEARED")
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js"></script>
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
  dialogContent+= '</head>\n<body>';
  dialogContent+= '<legend>'+legend_text+'</legend>';
  dialogContent+= selected_content_html;
  dialogContent+= "<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\">";
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
                     \n });';
    dialogContent += "\n</scr" + "ipt>";
    dialogContent+= '\n</body></html>';

    var win = window.open("about:blank");
    win.document.write(dialogContent);
}

</script>

@endsection    


